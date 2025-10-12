   <section class="pt-5 footer" data-entrance="from-bottom">
        <div class="container">
            <dis class="row">
                <div class="col-xl-3 mb-3">
                    <img src="img/logo.svg" class="w-100" style="max-width:280px;" />
                </div>
                <div class="col-xl-3">
                    <p>{{ \App\Models\Setting::value('address1') }}</p>
                    <p>{{ \App\Models\Setting::value('address2') }}</p>
                    <div class="d-lg-block d-flex foot-m-links">
                        <p class=" flex-grow-1">{{ \App\Models\Setting::value('phone') }}</p>
                        <p class=" flex-grow-1"><a href="mailto:{{ \App\Models\Setting::value('email') }}" class="footer-link">{{ \App\Models\Setting::value('email') }}</a></p>
                    </div>

                </div>
                <div class="col-xl-3">
                    <div class="d-lg-block d-flex foot-m-links">
                        <p class=" flex-grow-1"><a href="{{ route('about') }}" class="footer-link">{{ __('nav.about') }}</a></p>
                        <p class=" flex-grow-1"><a href="{{ route('services') }}" class="footer-link">{{ __('nav.services') }}</a></p>
                    </div>
                    <div class="d-lg-block d-flex foot-m-links">
                        <p class=" flex-grow-1"><a href="{{ route('blog') }}" class="footer-link">{{ __('nav.blog') }}</a></p>
                        <p class=" flex-grow-1"><a href="{{ route('contact') }}" class="footer-link">{{ __('nav.contact') }}</a></p>
                    </div>


                </div>
                <div class="col-xl-3">
                    <p>{{ __('home.follow') }}</p>
                    <div class="d-flex gap-2">
                        <a href="{{ \App\Models\Setting::value('linkedin') }}" class="footer-link">
                            <img src="{{ asset('web/img/in.svg') }}" />
                        </a>
                        <a href="{{ \App\Models\Setting::value('instagram') }}" class="footer-link">
                            <img src="{{ asset('web/img/ins.svg') }}" />
                        </a>
                        <a href="{{ \App\Models\Setting::value('x') }}" class="footer-link">
                            <img src="{{ asset('web/img/x.svg') }}" />
                        </a>
                        <a href="{{ \App\Models\Setting::value('tiktok') }}" class="footer-link">
                            <img src="{{ asset('web/img/tik.svg') }}" />
                        </a>
                        <a href="{{ \App\Models\Setting::value('snapchat') }}" class="footer-link">
                            <img src="{{ asset('web/img/snap.svg') }}" />
                        </a>
                    </div>
                </div>
            </dis>

            <div class="text-center mt-5">
                <p style="font-size:12px">{{ __('footer.rights', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </section>
