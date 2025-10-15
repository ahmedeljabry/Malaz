   <section class="py-5" data-entrance="from-top">
        <div class="container">
            <h3 class="title mb-4">
                {{ __('home.parteners') }}
            </h3>
            <div class="owl-carousel owl-theme logos">
                @forelse (\App\Models\Partner::active()->get() as $partner)
                    <div class="item logo">
                        <img src="{{ $partner->image }}" alt="{{ $partner?->name }}" />
                    </div>
                @empty
                    <p>{{ __('home.no_data') }}</p>
                @endforelse
            </div>
        </div>
    </section>
