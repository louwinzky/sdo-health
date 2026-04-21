<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
<<<<<<< Updated upstream
        <x-auth-header :title="__('Sign in')" :description="__('Enter your email and password below to log in')" />
=======
        <div class="text-center">
            <h2 class="text-2xl font-bold text-slate-900">Welcome back</h2>
            <p class="text-slate-500 mt-1 text-sm">Enter your credentials to access your account</p>
        </div>
>>>>>>> Stashed changes

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required="true"
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="flex flex-col gap-1">
                @if (Route::has('password.request'))
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ __('Password') }}</label>
                        <flux:link class="text-sm" :href="route('password.request')" wire:navigate="true">
                            {{ __('Forgot your password?') }}
                        </flux:link>
                    </div>
                @endif
                <flux:input
                    name="password"
                    type="password"
                    required="true"
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
<<<<<<< Updated upstream
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    value="1" 
                    {{ old('remember') ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 accent-green-500 focus:ring-green-500 dark:focus:ring-green-500 cursor-pointer"
                >
                <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Log in') }}
=======
                <input id="remember" name="remember" type="checkbox" value="1" class="w-5 h-5 rounded border-gray-300 accent-green-500 focus:ring-green-500 cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="ml-2 block text-sm text-gray-900">{{ __('Remember me') }}</label>
            </div>

            <div class="pt-2">
                <flux:button type="submit" class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors" data-test="login-button">
                    {{ __('Sign in') }}
>>>>>>> Stashed changes
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
<<<<<<< Updated upstream
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate="true">{{ __('Sign up') }}</flux:link>
=======
            <div class="text-center text-sm text-slate-500 pt-2 border-t border-slate-200">
                <span>Don't have an account?</span>
                <flux:link :href="route('register')" wire:navigate="true" class="font-semibold">{{ __('Create one') }}</flux:link>
>>>>>>> Stashed changes
            </div>
        @endif
    </div>
</x-layouts::auth>
