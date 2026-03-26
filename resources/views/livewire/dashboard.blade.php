<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Welcome, {{ auth()->user()->name }}</flux:heading>
            <flux:subheading>{{ $this->schoolName }} - Dashboard Overview</flux:subheading>
        </div>

        <flux:button href="{{ route('filament.admin.pages.dashboard') }}" icon="cog-6-tooth" variant="primary">
            Login to Admin Panel
        </flux:button>
    </div>

    <!-- Stats Grid with better spacing -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-6">
        @foreach ($this->stats as $stat)
            <flux:card class="flex items-center gap-4 p-6">
                <div class="flex size-12 items-center justify-center rounded-lg bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 dark:bg-{{ $stat['color'] }}-900/30 dark:text-{{ $stat['color'] }}-400">
                    <flux:icon :name="$stat['icon']" />
                </div>

                <div>
                    <flux:text size="sm" class="font-medium">{{ $stat['label'] }}</flux:text>
                    <flux:heading size="xl">{{ $stat['value'] }}</flux:heading>
                    <flux:text size="xs" class="mt-1">{{ $stat['description'] }}</flux:text>
                </div>
            </flux:card>
        @endforeach
    </div>

    <div class="mt-8">
        <flux:card>
            <div class="mb-4 flex items-center justify-between">
                <flux:heading size="lg">Recent Health Records</flux:heading>
            </div>

            <div class="space-y-4">
                @forelse ($this->recentRecords as $record)
                    <div class="flex items-center justify-between rounded-lg border border-neutral-200 p-3 dark:border-neutral-800">
                        <div>
                            <flux:text class="font-medium">{{ $record->student->full_name }}</flux:text>
                            <flux:text size="xs">{{ $record->record_date->format('M d, Y') }} - BMI: {{ $record->bmi }}</flux:text>
                        </div>
                        <flux:badge :color="$record->bmi_category === 'Normal' ? 'emerald' : 'amber'">
                            {{ $record->bmi_category }}
                        </flux:badge>
                    </div>
                @empty
                    <flux:text class="py-4 text-center italic">No records found</flux:text>
                @endforelse
            </div>
        </flux:card>
    </div>
</div>
