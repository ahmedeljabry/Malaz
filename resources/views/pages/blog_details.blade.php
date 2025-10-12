@extends('layouts.app')
@section('title', $post->title)
@section('content')
        <section class="py-5">
        <div class="container">

            <img src="{{ $post->image }}" class="blog-details-image" data-entrance="fade" alt="{{ $post->title }}" />

            <h3 class="title mb-3 mt-5" data-entrance="from-left">
                {{ $post->title }}
            </h3>
            
            <p style="font-size:14px;" data-entrance="from-bottom"> 
                {{ \Illuminate\Support\Str::replace(
                    ['am','pm'],
                    ['a.m','p.m'],
                    $post->published_at->format('l d M. Y - h:i a')
                ) }}
            </p>

            <div class=" mb-5 mt-4" data-entrance="from-right">
                {!! $post->body !!}
            </div>

            @php
                $currentUrl = urlencode(url()->current());
                $titleText = urlencode($post->title);
                $share = [
                    'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$currentUrl}",
                    'x' => "https://twitter.com/intent/tweet?url={$currentUrl}&text={$titleText}",
                    'instagram' => "https://www.instagram.com/?url={$currentUrl}",
                    'tiktok' => "https://www.tiktok.com/share?url={$currentUrl}",
                    'snapchat' => "https://www.snapchat.com/scan?attachmentUrl={$currentUrl}",
                ];
            @endphp
            <div class="d-flex gap-4 align-items-center pt-5" data-entrance="from-bottom">
                <h5 class="bold mb-0">{{ __('buttons.share') }}</h5>
                <div class="d-flex gap-2">
                    <a href="{{ $share['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="footer-link" aria-label="LinkedIn">
                        <img src="{{ asset('web/img/in.svg') }}" alt="LinkedIn" />
                    </a>
                    <a href="{{ $share['instagram'] }}" target="_blank" rel="noopener noreferrer" class="footer-link" aria-label="Instagram">
                        <img src="{{ asset('web/img/ins.svg') }}" alt="Instagram" />
                    </a>
                    <a href="{{ $share['x'] }}" target="_blank" rel="noopener noreferrer" class="footer-link" aria-label="X">
                        <img src="{{ asset('web/img/x.svg') }}" alt="X" />
                    </a>
                    <a href="{{ $share['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="footer-link" aria-label="TikTok">
                        <img src="{{ asset('web/img/tik.svg') }}" alt="TikTok" />
                    </a>
                    <a href="{{ $share['snapchat'] }}" target="_blank" rel="noopener noreferrer" class="footer-link" aria-label="Snapchat">
                        <img src="{{ asset('web/img/snap.svg') }}" alt="Snapchat" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <x-blocks.discover />
@endsection
