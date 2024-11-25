<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Carbon\Carbon;
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

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:1024'],
        ]);

        $user = $request->user();

        if ($user->foto_profil) {
            Storage::delete($user->foto_profil);
        }

        // Generate custom file name: username-iduser-date.extension
        $name = $user->name; // Adjust if the username is stored in a different attribute
        $userId = $user->id;
        $date = Carbon::now()->format('Ymd'); // Use the format you prefer
        $extension = $request->file('photo')->getClientOriginalExtension();
        $fileName = "{$name}-{$userId}-{$date}.{$extension}";

        // Store the file with the custom name
        $path = $request->file('photo')->storeAs('profile-photos', $fileName, 'public');
        $user->foto_profil = $path;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-photo-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
