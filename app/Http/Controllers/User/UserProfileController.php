<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;

class UserProfileController extends BaseController
{
    public function __construct(){}

    public function show()
    {
        $user = auth()->user();
        return view('users.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'username'       => 'required|string|max:50|alpha_dash|unique:users,username,' . $user->id,
            'email'          => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number'  => 'nullable|string|max:20',
            'bio'            => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'address'       => 'nullable|string|max:255',
            'avatar'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {

            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()
            ->route('user.profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect'
            ]);
        }

        // Save new password
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()
            ->route('user.profile')
            ->with('success', 'Password updated successfully!');
    }

    public function deleteAvatar()
    {
        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);

            $user->update([
                'avatar' => null
            ]);
        }

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Avatar deleted successfully!');
    }
}
