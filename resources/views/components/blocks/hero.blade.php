<section class="hero"  data-entrance="from-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 ">
                <div class="hero-text-container h-100">
                    <div class="hero-text-mobile">
                        <div class="hero-text">
                            <h1>{{ __('home.hero_text') }}</h1>
                            <button class="btn-hero">
                                <p class="mb-0" onclick="window.location.href='{{ route('about') }}'">
                                    {{ __('home.read_more') }}
                                </p>
                            </button>
                        </div>

                        <div class="container-2030 mt-auto">
                            <img src="{{ asset('web/img/2030.png') }}" />
                        </div>
                    </div>
                </div>

                <img src="{{ asset('web/img/man.png') }}" class="man-mobile"  data-entrance="from-fade"/>
            </div>
            <div class=" col-xl-6 d-none d-lg-block ">
                <div class="hero-image">
                    <img src="{{ asset('web/img/man.png') }}" alt="Man with tablet" />
                </div>
            </div>
        </div>
    </div>
</section>
