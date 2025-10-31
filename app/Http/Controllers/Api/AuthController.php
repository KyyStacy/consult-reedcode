<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelHasRole;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.simple')->except(['login', 'register']);
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password tidak sesuai.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            // Generate simple token
            $token = base64_encode($user->id . ':' . $user->email . ':' . time());

            // Get user roles
            $roles = $user->roles()->get()->map(function($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'roles' => $roles
                    ]
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Untuk token-based auth sederhana, kita hanya perlu mengembalikan sukses
            // Token akan dihapus di sisi client
            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal logout: ' . $th->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ]
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                if ($errors->has('email') && str_contains($errors->first('email'), 'has already been taken')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email sudah digunakan oleh pengguna lain'
                    ], 422);
                }
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::find(auth()->id());
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            // Generate token baru dengan email yang baru
            $token = base64_encode($user->id . ':' . $user->email . ':' . time());

            return response()->json([
                'status' => true,
                'message' => 'Profil berhasil diperbarui',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|different:current_password',
                'confirm_password' => 'required|same:new_password'
            ], [
                'new_password.min' => 'Password minimal 8 karakter',
                'new_password.different' => 'Password baru harus berbeda dengan password saat ini',
                'confirm_password.same' => 'Konfirmasi password tidak sesuai',
                'current_password.required' => 'Password saat ini harus diisi',
                'new_password.required' => 'Password baru harus diisi',
                'confirm_password.required' => 'Konfirmasi password harus diisi'
            ]);

            if($validateUser->fails()){
                $errors = $validateUser->errors();
                return response()->json([
                    'status' => false,
                    'message' => $errors->first(),
                ], 422);
            }

            $user = User::find(auth()->id());

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password saat ini tidak sesuai'
                ], 422);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password berhasil diubah'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'password' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Password harus diisi',
                ], 401);
            }

            $user = User::find(auth()->id());
            
            // Validasi password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password tidak sesuai'
                ], 401);
            }

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Akun berhasil dihapus'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $validatePhoto = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if($validatePhoto->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validatePhoto->errors()
                ], 401);
            }

            $user = User::find(auth()->id());

            // Hapus foto lama jika ada
            if($user->photo && Storage::disk('public')->exists('photos/' . $user->photo)) {
                Storage::disk('public')->delete('photos/' . $user->photo);
            }

            // Upload foto baru
            $photo = $request->file('photo');
            $photoName = $user->id . '-' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $photoName);

            // Log untuk debug
            Log::info('Photo uploaded', [
                'name' => $photoName,
                'path' => 'storage/photos/' . $photoName,
                'full_url' => asset('storage/photos/' . $photoName)
            ]);

            // Update database
            $user->photo = $photoName;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Foto profil berhasil diperbarui',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $photoName,
                        'photo_url' => asset('storage/photos/' . $photoName)
                    ]
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $modelHasRole = new ModelHasRole([
                'model_id' => $user->id,
                'role_id' => 3,
                'model_type' => 'App\\Models\\User'
            ]);
            $modelHasRole->save();

            // Generate token
            $token = base64_encode($user->id . ':' . $user->email . ':' . time());

            // Get user roles
            $roles = $user->roles()->get()->map(function($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name
                ];
            });

            return response()->json([
                'status' => true,
                'message' => 'Registrasi berhasil',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'photo' => $user->photo,
                        'roles' => $roles
                    ]
                ]
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function getPsychologists()
    {
        try {
            Log::info('Attempting to fetch psychologists data');
            
            $psychologists = User::role('psikolog')
                ->select('users.id', 'users.name', 'users.photo', 'users.last_seen')
                ->join('detail_psikolog', 'users.id', '=', 'detail_psikolog.id_psikolog')
                ->whereNotNull('detail_psikolog.bio')
                ->whereNotNull('detail_psikolog.harga')
                ->where('detail_psikolog.bio', '!=', '')
                ->where('detail_psikolog.harga', '>', 0)
                ->with(['detailPsikolog' => function($query) {
                    $query->select('id_psikolog', 'bio', 'harga');
                }])
                ->get();

            Log::info('Successfully fetched psychologists data', ['count' => $psychologists->count()]);

            return response()->json([
                'success' => true,
                'message' => 'Data psikolog berhasil diambil',
                'psychologists' => $psychologists
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching psychologists data: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 