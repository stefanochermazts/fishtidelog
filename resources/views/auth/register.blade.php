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
                    
                    <!-- Password Strength Indicator -->
                    <div id="password-strength" class="mt-3 hidden">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">Forza password</span>
                            <span id="strength-text" class="text-sm font-semibold text-neutral-500"></span>
                        </div>
                        <div class="w-full bg-neutral-200 dark:bg-neutral-700 rounded-full h-2">
                            <div id="strength-bar" class="h-2 rounded-full transition-all duration-300 bg-neutral-300" style="width: 0%"></div>
                        </div>
                        
                        <!-- Requirements List -->
                        <div class="mt-3 space-y-1 text-xs">
                            <div id="req-length" class="flex items-center space-x-2 text-neutral-500">
                                <span class="req-icon">○</span>
                                <span>Almeno 10 caratteri</span>
                            </div>
                            <div id="req-upper" class="flex items-center space-x-2 text-neutral-500">
                                <span class="req-icon">○</span>
                                <span>Una lettera maiuscola</span>
                            </div>
                            <div id="req-lower" class="flex items-center space-x-2 text-neutral-500">
                                <span class="req-icon">○</span>
                                <span>Una lettera minuscola</span>
                            </div>
                            <div id="req-number" class="flex items-center space-x-2 text-neutral-500">
                                <span class="req-icon">○</span>
                                <span>Un numero</span>
                            </div>
                            <div id="req-special" class="flex items-center space-x-2 text-neutral-500">
                                <span class="req-icon">○</span>
                                <span>Un carattere speciale</span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-6">
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

                        <!-- Password Match Indicator -->
                        <div id="password-match" class="mt-2 hidden">
                            <div id="match-success" class="flex items-center space-x-2 text-green-600 dark:text-green-400 hidden">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Le password coincidono</span>
                            </div>
                            <div id="match-error" class="flex items-center space-x-2 text-red-600 dark:text-red-400 hidden">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Le password non coincidono</span>
                            </div>
                        </div>
                        
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
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
                    <button type="submit" 
                            class="w-full justify-center py-3 px-6 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold rounded-2xl shadow-soft hover:shadow-medium transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('auth.register') }}
                    </button>
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


    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthIndicator = document.getElementById('password-strength');
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    const matchIndicator = document.getElementById('password-match');
    const matchSuccess = document.getElementById('match-success');
    const matchError = document.getElementById('match-error');
    
    // Password strength validation
    function validatePassword(password) {
        const requirements = {
            length: password.length >= 10,
            upper: /[A-Z]/.test(password),
            lower: /[a-z]/.test(password),
            number: /[0-9]/.test(password),
            special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
        };
        
        // Update requirement indicators
        Object.keys(requirements).forEach(req => {
            const element = document.getElementById('req-' + req);
            const icon = element.querySelector('.req-icon');
            if (requirements[req]) {
                element.className = 'flex items-center space-x-2 text-green-600 dark:text-green-400';
                icon.textContent = '✓';
            } else {
                element.className = 'flex items-center space-x-2 text-neutral-500';
                icon.textContent = '○';
            }
        });
        
        // Calculate strength
        const score = Object.values(requirements).filter(Boolean).length;
        const percentage = (score / 5) * 100;
        
        // Update strength bar and text
        strengthBar.style.width = percentage + '%';
        
        if (score === 0) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-neutral-300';
            strengthText.textContent = '';
            strengthText.className = 'text-sm font-semibold text-neutral-500';
        } else if (score <= 2) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
            strengthText.textContent = 'Debole';
            strengthText.className = 'text-sm font-semibold text-red-500';
        } else if (score <= 3) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
            strengthText.textContent = 'Media';
            strengthText.className = 'text-sm font-semibold text-yellow-500';
        } else if (score <= 4) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-blue-500';
            strengthText.textContent = 'Forte';
            strengthText.className = 'text-sm font-semibold text-blue-500';
        } else {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
            strengthText.textContent = 'Molto Forte';
            strengthText.className = 'text-sm font-semibold text-green-500';
        }
        
        return requirements;
    }
    
    // Password confirmation validation
    function validateConfirmation() {
        const password = passwordInput.value;
        const confirmation = confirmInput.value;
        
        if (confirmation.length === 0) {
            matchIndicator.classList.add('hidden');
            confirmInput.classList.remove('border-red-500', 'border-green-500');
            return;
        }
        
        matchIndicator.classList.remove('hidden');
        
        if (password === confirmation && password.length > 0) {
            matchSuccess.classList.remove('hidden');
            matchError.classList.add('hidden');
            confirmInput.classList.remove('border-red-500');
            confirmInput.classList.add('border-green-500');
        } else {
            matchSuccess.classList.add('hidden');
            matchError.classList.remove('hidden');
            confirmInput.classList.remove('border-green-500');
            confirmInput.classList.add('border-red-500');
        }
    }
    
    // Event listeners
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        if (password.length > 0) {
            strengthIndicator.classList.remove('hidden');
            validatePassword(password);
        } else {
            strengthIndicator.classList.add('hidden');
        }
        
        // Re-validate confirmation if it has content
        if (confirmInput.value.length > 0) {
            validateConfirmation();
        }
    });
    
    confirmInput.addEventListener('input', validateConfirmation);
    
    // Progressive enhancement - form works without JS
    console.log('Password validation enhanced with vanilla JavaScript');
});
</script>

@endsection
