@extends('layouts.app')

@section('title', __('auth.confirm_password_title'))

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">
                {{ __('auth.confirm_password_title') }}
            </h2>
            <p class="text-neutral-600 dark:text-neutral-400">
                {{ __('auth.confirm_password_message') }}
            </p>
        </div>

        <!-- Confirm Password Form -->
        <div class="bg-white dark:bg-neutral-800 rounded-3xl shadow-soft dark:shadow-strong border border-neutral-200 dark:border-neutral-700 p-8">
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('auth.password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="password" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                     type="password"
                                     name="password"
                                     required 
                                     autocomplete="current-password" 
                                     placeholder="{{ __('auth.enter_password') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full justify-center py-3 px-6 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold rounded-2xl shadow-soft hover:shadow-medium transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ __('auth.confirm') }}
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
                        <span class="px-2 bg-white dark:bg-neutral-800 text-neutral-500 dark:text-neutral-400">{{ __('auth.back_to_dashboard') }}</span>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard -->
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" 
                   class="w-full flex justify-center py-3 px-6 border border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 font-semibold rounded-2xl hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-all duration-200">
                    {{ __('auth.go_to_dashboard') }}
                </a>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="text-center space-y-4">
            <div class="flex justify-center space-x-6 text-sm">
                <a href="{{ route('home') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('auth.home') }}
                </a>
                <a href="{{ route('features') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('auth.features') }}
                </a>
                <a href="{{ route('contact') }}" class="text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                    {{ __('auth.contact') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
