@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 8A6 6 0 006 8c0 3.207-1.845 5.216-3.757 6.33C1.431 15.514 1 16.162 1 17a1 1 0 001 1h16a1 1 0 001-1c0-.838-.431-1.486-1.243-1.67C13.845 13.216 12 11.207 12 8zM8 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">
                {{ __('Benvenuto di nuovo') }}
            </h2>
            <p class="text-neutral-600 dark:text-neutral-400">
                {{ __('Accedi al tuo account FishTideLog') }}
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white dark:bg-neutral-800 rounded-3xl shadow-soft dark:shadow-strong border border-neutral-200 dark:border-neutral-700 p-8">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 bg-secondary-50 dark:bg-secondary-900/30 border border-secondary-200 dark:border-secondary-700 text-secondary-800 dark:text-secondary-200 px-4 py-3 rounded-2xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="email" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200" 
                                     type="email" 
                                     name="email" 
                                     :value="old('email')" 
                                     required 
                                     autofocus 
                                     autocomplete="username" 
                                     placeholder="{{ __('Inserisci la tua email') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-neutral-700 dark:text-neutral-300 font-medium" />
                    <div class="mt-2">
                        <x-text-input id="password" 
                                     class="block w-full px-4 py-3 border border-neutral-300 dark:border-neutral-600 rounded-2xl bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                     type="password"
                                     name="password"
                                     required 
                                     autocomplete="current-password" 
                                     placeholder="{{ __('Inserisci la tua password') }}" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-neutral-300 dark:border-neutral-600 text-primary-600 dark:text-primary-400 shadow-sm focus:ring-primary-500 dark:focus:ring-primary-400 bg-white dark:bg-neutral-700" 
                               name="remember">
                        <span class="ms-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('Ricordami') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 transition-colors duration-200" href="{{ route('password.request') }}">
                            {{ __('Password dimenticata?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full justify-center py-3 px-6 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold rounded-2xl shadow-soft hover:shadow-medium transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Accedi') }}
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
                        <span class="px-2 bg-white dark:bg-neutral-800 text-neutral-500 dark:text-neutral-400">{{ __('Non hai ancora un account?') }}</span>
                    </div>
                </div>
            </div>

            <!-- Register Link -->
            <div class="mt-6">
                <a href="{{ route('register') }}" 
                   class="w-full flex justify-center py-3 px-6 border border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 font-semibold rounded-2xl hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-all duration-200">
                    {{ __('Crea un nuovo account') }}
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
