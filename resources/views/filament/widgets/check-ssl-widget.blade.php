<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        @if($shouldShowTitle)
            <div class="mb-4">
                <h2 class="flex items-center text-lg font-semibold text-gray-900 dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>

                    {{ is_null($title) ? __('filament-check-ssl-widget::default.title') : $title }}
                </h2>
                <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                    {{ is_null($description) ? __('filament-check-ssl-widget::default.description') : $description }}
                </p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-2 md:grid-cols-{{$quantityPerRow}}">
            @foreach ($certificates as $certificate)
               <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-2 rounded-md shadow-sm">
                    <span class="flex text-sm font-medium text-gray-800 dark:text-white">
                        @if ($certificate['favicon'])
                            <img src="{{ $certificate['favicon'] }}" style="margin-right: 6px; width: 24px;" />
                        @endif
                        {{ $certificate['domain'] }}
                    </span>
                    <span class="flex items-center text-xs text-gray-800 dark:text-white">
                        @if ($certificate['is_valid'])
                            <li><strong>Expiration: </strong> {{ $certificate['expiration_date']->diffForHumans() }} (<strong class="italic">{{ (int)abs($certificate['expiration_date_in_days']->diffInDays()) }} days</strong>)</li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1" width="16" height="16" style="color: green;margin-left: 8px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1" width="16" height="16" style="color: red;margin-left: 8px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
