<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!-- Display Validation Errors -->
        <x-validation-errors class="mb-4" />

        <!-- Password Reset Form -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Hidden Token Input -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $email)" required autofocus autocomplete="username" />
            </div>

            <!-- Password Input -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password Input -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Reset Password Button -->
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
