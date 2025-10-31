<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelHasRole;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'integer'],
        ]);

        // Simpan data user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Simpan model_has_role
        $modelHasRoler = new ModelHasRole([
            'model_id' => $user->id, // Menggunakan id user yang baru dibuat
            'role_id' => $validatedData['role'], // Menggunakan role_id yang dipilih dari form
        ]);
        $modelHasRoler->save();

        return redirect('admin')->with('added', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'role' => ['required', 'integer'],
        ]);

        // Ambil user yang akan diupdate
        $user = User::findOrFail($id);

        // Perbarui data pengguna
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Simpan perubahan pengguna
        $user->save();

        // Perbarui role_id
        $user->roles()->sync([$validatedData['role']]);

        return redirect('admin')->with('updated', 'User berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('admin')->with('deleted', 'User berhasil dihapus!');
    }
}
