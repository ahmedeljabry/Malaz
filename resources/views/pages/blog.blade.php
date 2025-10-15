@extends('layouts.app')
@section('title', __('nav.blog'))
@section('content')
    <section class="py-5">
        <div class="container">
            <h3 class="title mb-4" data-entrance="from-top">
                {{ __('nav.blog') }}
            </h3>
            <div class="row" data-entrance="from-top">
                @forelse (\App\Models\Post::published()->get() as $post)
                    <div class="col-xl-3 mb-4">
                        <div class="blog-container">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" />
                            <div class="blog-content">
                                <div class="d-flex justify-content-between gap-4">
                                    <div>
                                        <div class="blog-date">
                                            {{ \Illuminate\Support\Str::replace(
                                                ['am','pm'],
                                                ['a.m','p.m'],
                                                $post->published_at->format('l d M. Y - h:i a')
                                            ) }}
                                        </div>

                                        <div class="blog-title">
                                            {{ $post->title }}
                                        </div>

                                        <div class="blog-description">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post->body), 160, '...') }}
                                        </div>
                                    </div>
                                    <button class="arrow-link" onclick="window.location.href='{{ route('blog.details' , $post->slug) }}'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6888 12.2426C13.6889 12.0394 13.7696 11.8446 13.9133 11.701C14.0569 11.5573 14.2517 11.4766 14.4549 11.4764L23.1278 11.4764C23.3309 11.4766 23.5257 11.5573 23.6694 11.701C23.813 11.8446 23.8938 12.0394 23.8939 12.2426L23.8939 20.9155C23.8975 21.0183 23.8804 21.1209 23.8435 21.217C23.8067 21.3131 23.7508 21.4009 23.6793 21.4749C23.6078 21.549 23.5221 21.6079 23.4274 21.6481C23.3326 21.6884 23.2307 21.7091 23.1278 21.7091C23.0248 21.7091 22.9229 21.6884 22.8282 21.6481C22.7334 21.6079 22.6477 21.549 22.5762 21.4749C22.5047 21.4009 22.4489 21.3131 22.412 21.217C22.3752 21.1209 22.358 21.0183 22.3617 20.9155L22.3617 14.0928L12.1059 24.3485C11.9622 24.4923 11.7672 24.573 11.5639 24.573C11.3606 24.573 11.1656 24.4923 11.0218 24.3485C10.8781 24.2047 10.7973 24.0097 10.7973 23.8064C10.7973 23.6031 10.8781 23.4081 11.0218 23.2644L21.2776 13.0087L14.4549 13.0087C14.2517 13.0085 14.0569 12.9278 13.9133 12.7841C13.7696 12.6405 13.6889 12.4457 13.6888 12.2426Z" fill="black" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">{{ __('home.no_data') }}</p>
                @endforelse
            </div>
        </div>
    </section>
    <x-blocks.discover />
@endsection

