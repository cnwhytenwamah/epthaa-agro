@extends('front-pages.layouts.app')

@section('title', 'My Profile')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">My Profile</h1>
            <p class="text-gray-600 mt-2">View and manage your account information</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">

                    <!-- Avatar -->
                    <div class="text-center mb-6">
                        <div class="relative inline-block">
                            <img src="{{ $user->avatar_url }}"
                                alt="{{ $user->name }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-primary">

                            <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-4 border-white"></div>
                        </div>

                        <h2 class="mt-4 text-2xl font-bold text-gray-900">
                            {{ $user->name }}
                        </h2>

                        <p class="text-gray-500">
                            @{{ $user->username }}
                        </p>

                        <p class="text-gray-600">
                            {{ $user->email }}
                        </p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="space-y-3 py-6 border-t border-b">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Member since</span>
                            <span class="font-semibold text-gray-900">
                                {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Account Status</span>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                    </div>


                    <!-- Navigation -->
                    <div class="mt-6 space-y-2">

                        <!-- Edit Profile -->
                        <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 w-full px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition">

                            <!-- Pencil icon -->
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536M9 11l6.732-6.732
                                        a2.5 2.5 0 113.536 3.536L12.536
                                        14.536a2 2 0 01-.828.485l-4.172
                                        1.044 1.044-4.172a2 2 0 01.485-.828z"/>
                            </svg>

                            <span>Edit Profile</span>
                        </a>


                        <!-- My Bookings -->
                        <a href="{{ route('bookings.my-bookings') }}"
                        class="flex items-center gap-3 w-full px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition">

                            <!-- Calendar icon -->
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3M16 7V3M4 11h16M5 21h14a2
                                        2 0 002-2V7a2 2 0 00-2-2H5a2
                                        2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            <span>My Bookings</span>
                        </a>


                        <!-- My Orders -->
                        <a href="{{ route('orders.my-orders') }}"
                        class="flex items-center gap-3 w-full px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition">

                            <!-- Shopping bag icon -->
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 8h14l-1.5 11.25a2 2 0
                                        01-2 1.75H8.5a2 2 0
                                        01-2-1.75L5 8z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 8V6a3 3 0 016 0v2" />
                            </svg>

                            <span>My Orders</span>
                        </a>


                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-3 text-left text-red-600 hover:bg-red-50 rounded-lg transition">

                                <!-- Logout icon -->
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4
                                            4H7"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 21h9a2 2 0 002-2V5a2
                                            2 0 00-2-2H3" />
                                </svg>

                                <span>Logout</span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>


            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Personal Information</h3>
                        <a href="{{ route('profile.edit') }}"
                           class="text-primary hover:text-secondary font-medium text-sm">
                            Edit →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->name }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->username }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email Address</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Phone Number</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->phone_number ?? 'Not provided' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Date of Birth</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->date_of_birth 
                                    ? \Carbon\Carbon::parse($user->date_of_birth)->format('d M Y') 
                                    : 'Not provided' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->address ?? 'Not provided' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Bio</label>
                            <p class="text-gray-900 font-semibold">
                                {{ $user->bio ?? 'Not provided' }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Account Security -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Account Security</h3>

                    <div class="space-y-4">

                        <!-- Password -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900">Password</p>
                                <p class="text-sm text-gray-600">
                                    Last changed {{ $user->updated_at->diffForHumans() }}
                                </p>
                            </div>

                            <a href="{{ route('profile.edit') }}#password-section"
                               class="text-primary hover:text-secondary font-medium text-sm">
                                Change
                            </a>
                        </div>

                        <!-- Email Verification -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-semibold text-gray-900">Email Verification</p>
                                <p class="text-sm">
                                    @if($user->email_verified_at)
                                        <span class="text-green-600">Verified</span>
                                    @else
                                        <span class="text-yellow-600">Not verified</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        Quick Actions
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Book Service -->
                        <a href="{{ route('bookings.create') }}"
                        class="group flex items-center p-4 border-2 border-gray-200 rounded-lg
                                hover:border-primary hover:bg-gray-50 transition">

                            <!-- Calendar Icon -->
                            <svg class="w-8 h-8 mr-4 text-primary group-hover:scale-110 transition"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3M16 7V3M4 11h16M5 21h14a2
                                        2 0 002-2V7a2 2 0 00-2-2H5a2
                                        2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            <div>
                                <p class="font-semibold text-gray-900">
                                    Book Service
                                </p>
                                <p class="text-sm text-gray-600">
                                    Schedule a veterinary visit
                                </p>
                            </div>
                        </a>


                        <!-- Shop Products -->
                        <a href="{{ route('shop.index') }}"
                        class="group flex items-center p-4 border-2 border-gray-200 rounded-lg
                                hover:border-primary hover:bg-gray-50 transition">

                            <!-- Shopping Cart Icon -->
                            <svg class="w-8 h-8 mr-4 text-primary group-hover:scale-110 transition"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7
                                        13l-1.35 2.7A1 1 0
                                        006.5 17H19m-12 0a1
                                        1 0 102 0m8 0a1
                                        1 0 102 0" />
                            </svg>

                            <div>
                                <p class="font-semibold text-gray-900">
                                    Shop Products
                                </p>
                                <p class="text-sm text-gray-600">
                                    Browse our catalog
                                </p>
                            </div>
                        </a>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
@endsection
