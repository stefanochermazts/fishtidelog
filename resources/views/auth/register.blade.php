@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">
                {{ __('auth.create_your_account') }}
            </h2>
            <p class="text-neutral-600 dark:text-neutral-400">
                {{ __('auth.start_tracking') }}
            </p>
        </div>

        <!-- Register Form -->
        <div class="bg-white dark:bg-neutral-800 rounded-3xl shadow-soft dark:shadow-strong border border-neutral-200 dark:border-neutral-700 p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('auth.name')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="name" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" 
                                     type="text" 
                                     name="name" 
                                     :value="old('name')" 
                                     required 
                                     autofocus 
                                     autocomplete="name" 
                                     placeholder="{{ __('auth.enter_name') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('auth.email')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="email" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" 
                                     type="email" 
                                     name="email" 
                                     :value="old('email')" 
                                     required 
                                     autocomplete="username" 
                                     placeholder="{{ __('auth.enter_email') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password with Validator -->
                <div>
                    <x-input-label for="password" :value="__('auth.password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="password" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                     type="password"
                                     name="password"
                                     required 
                                     autocomplete="new-password" 
                                     placeholder="{{ __('auth.create_secure_password') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    
                    <!-- Password Validator -->
                    <div class="mt-3">
                        <x-password-validator />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('auth.confirm_password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="password_confirmation" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                     type="password"
                                     name="password_confirmation"
                                     required 
                                     autocomplete="new-password" 
                                     placeholder="{{ __('auth.confirm_new_password') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" 
                               name="terms" 
                               type="checkbox" 
                               class="w-4 h-4 border border-neutral-300 dark:border-neutral-600 rounded bg-white dark:bg-neutral-700 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 dark:ring-offset-neutral-800" 
                               required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-neutral-600 dark:text-neutral-400">
                            {{ __('auth.accept_terms') }} 
                            <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 underline">
                                {{ __('auth.terms_conditions') }}
                            </a> 
                            {{ __('auth.and') }}
                            <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 underline">
                                {{ __('auth.privacy_policy') }}
                            </a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full justify-center py-3 px-6 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold rounded-2xl shadow-soft hover:shadow-medium transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('auth.register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-neutral-300 dark:border-neutral-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-neutral-800 text-neutral-500 dark:text-neutral-400">{{ __('auth.already_registered') }}</span>
                    </div>
                </div>
            </div>

            <!-- Login Link -->
            <div class="mt-6">
                <a href="{{ route('login') }}" 
                   class="w-full flex justify-center py-3 px-6 border border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 font-semibold rounded-2xl hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-all duration-200">
                    {{ __('auth.login_to_account') }}
                </a>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="text-center space-y-4">
            <div class="flex justify-center space-x-6 text-sm">
                <a href="{{ route('home') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('features') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('Funzionalità') }}
                </a>
                <a href="{{ route('contact') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('Contatti') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
