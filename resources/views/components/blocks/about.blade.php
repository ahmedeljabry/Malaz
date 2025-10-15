@props([
    'btn_title' => __('about.read_more'),
    'btn_link' => '#',
])
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 d-flex justify-content-center flex-column" data-entrance="from-top">
                <h3 class="title mb-4">
                    @php
                        $aboutTitle = \App\Models\Setting::value('about_title') ?? __('about.title');
                    @endphp
                    {{ $aboutTitle }}
                </h3>

                <p class="font-18">
                    {{  \App\Models\Setting::value('about_desc') ?? ''  }}
                </p>
                <a href="{{ $btn_link }}" class="btn-purple text-decoration-none" download="{{ \Illuminate\Support\Facades\Storage::disk('public')->url(\App\Models\Setting::value('about_attachment')) }}">
                    <p>{{ $btn_title }}</p>
                </a>
            </div>

            <div class="col-xl-6" data-entrance="from-top">
                <img src="{{ asset('web/img/about-img.png') }}" alt="{{ $aboutTitle }}" class="w-100" />
            </div>
        </div>
    </div>
</section>
