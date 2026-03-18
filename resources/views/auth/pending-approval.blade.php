<x-layouts::auth.simple title="Account Pending Approval">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2 text-center">
            <h1 class="text-xl font-medium">Account Pending Approval</h1>
            <p class="text-muted-foreground text-sm">Thank you for registering, <strong>{{ auth()->user()->name }}</strong>!</p>
        </div>

        <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 dark:border-amber-900 dark:bg-amber-950/50">
            <div class="flex items-center gap-3">
                <div class="text-amber-600 dark:text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <p class="text-sm text-amber-800 dark:text-amber-300">
                    Your account ({{ auth()->user()->email }}) is currently pending approval by an administrator.
                </p>
            </div>
        </div>

        <div class="space-y-4 text-center">
            <p class="text-muted-foreground text-sm">
                You will be able to access the dashboard once your account has been reviewed and approved.
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline dark:text-gray-400 dark:hover:text-gray-200">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-layouts::auth.simple>
