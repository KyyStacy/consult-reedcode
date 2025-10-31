<?php

namespace App\Http\Controllers;

use App\Models\DetailPsikolog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $user = $request->user();

        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $user->save();

        if ($user->hasRole('psikolog')) {
            $validatedData = $request->validate([
                'bio' => 'required|string|max:255',
                'harga' => 'required|integer|min:0',
            ]);

            $detailPsikolog = $user->detailPsikolog;

            if (!$detailPsikolog) {
                $detailPsikolog = new DetailPsikolog();
                $detailPsikolog->id_psikolog = $user->id;
            }

            $detailPsikolog->bio = $validatedData['bio'];
            $detailPsikolog->harga = $validatedData['harga'];
            $detailPsikolog->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = $user->name . '-' . $user->id . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $photoName);

            // Hapus foto lama jika ada
            if ($user->photo && $user->photo !== $photoName) {
                Storage::delete('public/photos/' . $user->photo);
            }

            $user->photo = $photoName;
            $user->save();

            return back()->with('status', 'Profile photo updated successfully.');
        }

        return back()->with('error', 'No photo selected.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
