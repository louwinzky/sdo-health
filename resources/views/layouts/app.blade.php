<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main class="p-0 m-0 w-full min-h-screen">
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
