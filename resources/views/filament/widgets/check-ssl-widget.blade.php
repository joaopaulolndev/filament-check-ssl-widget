<x-filament-widgets::widget class="fi-wi-stats-overview-stat filament-check-ssl-widget">
    @if($shouldShowTitle)
        <div class="filament-check-ssl-widget-header">
            <h2 class="filament-check-ssl-widget-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="filament-check-ssl-widget-icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>

                {{ is_null($title) ? __('filament-check-ssl-widget::default.title') : $title }}
            </h2>
            <p class="filament-check-ssl-widget-description">
                {{ is_null($description) ? __('filament-check-ssl-widget::default.description') : $description }}
            </p>
        </div>
    @endif

    <div class="filament-check-ssl-widget-content md:grid-cols-{{$quantityPerRow}}">
        @foreach ($certificates as $certificate)
            <div class="filament-check-ssl-widget-content-domain">
                <div class="filament-check-ssl-widget-content-domain-name">
                    @if ($certificate['favicon'])
                        <img src="{{ $certificate['favicon'] }}"  alt="{{ $certificate['domain'] }}"/>
                    @endif
                    {{ $certificate['domain'] }}
                </div>
                <div class="filament-check-ssl-widget-content-domain-certificate">
                    @if ($certificate['is_valid'])
                        <span>
                            <strong>{{ __('filament-check-ssl-widget::default.expiration') }}: </strong> {{ $certificate['expiration_date']->diffForHumans() }}
                            (<strong class="italic">{{ (int)abs($certificate['expiration_date_in_days']->diffInDays()) }} {{ __('filament-check-ssl-widget::default.expiration_in_days') }}</strong>)
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="certificate-is-valid" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="certificate-is-not-valid" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
