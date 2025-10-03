@extends('layouts.app')

@section('content')


    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Update Profile Info -->
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="border-b px-6 py-4 bg-green-50">
                    <h3 class="text-lg font-semibold text-green-700">👤 Update Profile Information</h3>
                    <p class="text-sm text-gray-500">Manage your personal details and account information.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="border-b px-6 py-4 bg-orange-50">
                    <h3 class="text-lg font-semibold text-orange-600">🔒 Update Password</h3>
                    <p class="text-sm text-gray-500">Ensure your account is using a strong password to stay secure.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="border-b px-6 py-4 bg-red-50">
                    <h3 class="text-lg font-semibold text-red-600">⚠️ Delete Account</h3>
                    <p class="text-sm text-gray-500">Permanently remove your account and all associated data.</p>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
    @endsection

