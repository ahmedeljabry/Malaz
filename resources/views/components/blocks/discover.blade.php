    <section class="discover home" data-entrance="from-right">
        <div class="container py-5">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="white text-uppercase bold">
                        {{ \App\Models\Setting::value('discover_title') ?? 'اكتشف المزيد مع ملاذ' }}
                    </h4>
                    <p class="white">
                        {{ \App\Models\Setting::value('discover_desc') ?? '' }}
                    </p>

                    <button class="btn-cyan" onclick="window.location.href='{{ route('about') }}'">
                        <p>{{ __('buttons.contact_us_now') }}</p>
                    </button>
                </div>
                <img src="{{ asset('web/img/dd.png') }}" class="discover-img" />
            </div>
        </div>
    </section>
