@extends('front-pages.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Edit Profile</h1>
            <p class="text-gray-600 mt-2">Update your account information</p>
        </div>
        <a href="{{ route('user.profile') }}" class="text-gray-600 hover:text-gray-900">✕</a>
    </div>

    <!-- Profile Picture -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Profile Picture</h3>

        <div class="flex items-center space-x-6">
            <img src="{{ $user->avatar_url }}" 
                 alt="{{ $user->name }}"
                 class="w-24 h-24 rounded-full border-4 border-gray-200 object-cover">

            <div class="flex-1">
                <form action="{{ route('profile.update') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      id="avatar-form">
                    @csrf
                    @method('PUT')

                    {{-- Hidden fields required for update --}}
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="username" value="{{ $user->username }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">

                    <input type="file" 
                           name="avatar" 
                           id="avatar-input"
                           accept="image/*" 
                           class="hidden"
                           onchange="document.getElementById('avatar-form').submit()">

                    <div class="flex gap-3">
                        <button type="button"
                                onclick="document.getElementById('avatar-input').click()"
                                class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg">
                            Upload New Photo
                        </button>

                        @if($user->avatar)
                        <form action="{{ route('profile.avatar.delete') }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete your profile picture?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                                Remove
                            </button>
                        </form>
                        @endif
                    </div>
                </form>

                <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF — max 2MB</p>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Personal Information</h3>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>
                    <label class="block text-sm font-medium mb-1">Full Name *</label>
                    <input type="text" name="name" required
                        value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 border rounded-lg @error('name') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Username *</label>
                    <input type="text" name="username" required
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 border rounded-lg @error('username') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email *</label>
                    <input type="email" name="email" required
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border rounded-lg @error('email') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="tel" name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}"
                        class="w-full px-4 py-3 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth"
                        value="{{ old('date_of_birth', $user->date_of_birth) }}"
                        class="w-full px-4 py-3 border rounded-lg">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full px-4 py-3 border rounded-lg">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full px-4 py-3 border rounded-lg">{{ old('bio', $user->bio) }}</textarea>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-[#10b981] hover:bg-[#059669] text-white px-8 py-3 rounded-lg">
                    Save Changes
                </button>
                <a href="{{ route('user.profile') }}" class="px-8 py-3 border rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-xl shadow-md p-6" id="password-section">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Change Password</h3>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6 mb-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Current Password *</label>
                    <input type="password" name="current_password" required
                        class="w-full px-4 py-3 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">New Password *</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password *</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border rounded-lg">
                </div>
            </div>

            <button type="submit"
                    class="bg-[#10b981] hover:bg-[#059669] text-white px-8 py-3 rounded-lg">
                Update Password
            </button>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mt-6">
        <h3 class="text-xl font-bold text-red-900 mb-4">Danger Zone</h3>
        <p class="text-red-700 mb-4">This feature is not available yet.</p>
        <button
            onclick="alert('Account deletion will be implemented soon')"
            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
            Delete Account
        </button>
    </div>

</div>
</section>
@endsection