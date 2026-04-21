<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
<<<<<<< Updated upstream
        <x-auth-header :title="__('Create account')" :description="__('Enter your details below to create your account')" />
=======
        <div class="text-center">
            <h2 class="text-2xl font-bold text-slate-900">Create account</h2>
            <p class="text-slate-500 mt-1 text-sm">Enter your details to get started</p>
        </div>
>>>>>>> Stashed changes

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Name')"
                :value="old('name')"
                type="text"
                required="true"
                autofocus
                autocomplete="name"
                :placeholder="__('Full name')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required="true"
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required="true"
                autocomplete="new-password"
                :placeholder="__('Password')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirm password')"
                type="password"
                required="true"
                autocomplete="new-password"
                :placeholder="__('Confirm password')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

<<<<<<< Updated upstream
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate="true">{{ __('Log in') }}</flux:link>
=======
        <div class="text-center text-sm text-slate-500 pt-2 border-t border-slate-200">
            <span>Already have an account?</span>
            <flux:link :href="route('login')" wire:navigate="true" class="font-semibold">{{ __('Sign in') }}</flux:link>
>>>>>>> Stashed changes
        </div>
    </div>
</x-layouts::auth>
