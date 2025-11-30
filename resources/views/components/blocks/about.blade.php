@props([
    'btn_title' => __('about.read_more'),
    'btn_link' => null,
])
@php
    $aboutTitle = \App\Models\Setting::value('about_title') ?? __('about.title');
    $aboutAttachment = \App\Models\Setting::value('about_attachment');
    $storage = \Illuminate\Support\Facades\Storage::disk('public');
    $aboutAttachmentUrl = $aboutAttachment && $storage->exists($aboutAttachment) ? $storage->url($aboutAttachment) : null;
    $buttonLink = $btn_link ?? $aboutAttachmentUrl;
    $downloadName = $buttonLink === $aboutAttachmentUrl && $aboutAttachmentUrl ? basename($aboutAttachment) : null;
@endphp
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 d-flex justify-content-center flex-column" data-entrance="from-top">
                <h3 class="title mb-4">
                    {{ $aboutTitle }}
                </h3>

                <p class="font-18">
                    {{  \App\Models\Setting::value('about_desc') ?? ''  }}
                </p>

                @if($buttonLink)
                    <a href="{{ $buttonLink }}" class="btn-purple text-decoration-none" @if($downloadName) download="{{ $downloadName }}" target="_blank" rel="noopener" @endif>
                        <p>{{ $btn_title }}</p>
                    </a>
                @endif
            </div>

            <div class="col-xl-6" data-entrance="from-top">
                <img src="{{ asset('web/img/about-img.png') }}" alt="{{ $aboutTitle }}" class="w-100" />
            </div>
        </div>
    </div>
</section>
