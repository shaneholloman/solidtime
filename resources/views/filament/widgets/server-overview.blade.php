<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <span class="text-gray-950 font-bold dark:text-white">Version</span>
            @if($version !== null)
                <span>v{{ $version }}</span>
            @else
                <span>-</span>
            @endif
            <br>
            <span class="text-gray-950 font-bold dark:text-white">Build</span>
            @if($build !== null)
                <span>{{ $build }}</span>
            @else
                <span>-</span>
            @endif

        </div>

        @if ($currentVersion !== null && $version !== null)
        <div class="mt-4 inline-flex items-center justify-center gap-1">
            @if ($needsUpdate)
                <span>
                    <x-filament::icon
                        icon="heroicon-o-exclamation-triangle"
                        class="h-5 w-5 text-orange-500 dark:text-orange-400"
                    />
                </span>
                <span>Update available (v{{ $currentVersion }})</span>
            @else
                <x-filament::icon
                    icon="heroicon-o-check-circle"
                    class="h-5 w-5 text-green-500 dark:text-green-400"
                />
                <span>Current version</span>
            @endif
        </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
