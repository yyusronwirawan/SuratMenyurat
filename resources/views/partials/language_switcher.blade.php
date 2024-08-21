{{-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach ($available_locales as $locale_name => $available_locale)
        @if ($available_locale === $current_locale)
            <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
        @else
            <a class="ml-1 underline ml-2 mr-2" href="language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div> --}}
<div class="dropdown">
    <button class="btn btn-sm btn-outline-primary dropdown-toggle" style="text-transform: uppercase;" type="button"
        id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $current_locale }}
    </button>
    <div class="dropdown-menu dropdown-menu-end" style="position: absolute;" aria-labelledby="growthReportId">
        @foreach ($available_locales as $locale_name => $available_locale)
            @if ($available_locale === $current_locale)
                <a class="dropdown-item" style="cursor: not-allowed">{{ $locale_name }}</a>
            @else
                <a class="dropdown-item text-primary"
                    href="{{ route('language.change', $available_locale) }}">{{ $locale_name }}</a>
            @endif
        @endforeach
    </div>`
</div>
