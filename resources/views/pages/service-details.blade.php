@extends('layouts.app')
@section('title', isset($service) ? $service->name : __('nav.services'))
@section('content')

    <section class="py-5">
        <div class="container">
            <div class="breadcrumb-container" data-entrance="from-left">
                <a href="{{ route('home') }}">{{ __('services.home') }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.25593 2.21501C4.33147 2.15041 4.42957 2.11844 4.52867 2.12612C4.62777 2.13381 4.71976 2.18053 4.78443 2.25601L7.78443 5.75601C7.84267 5.82397 7.87467 5.91051 7.87467 6.00001C7.87467 6.08951 7.84267 6.17605 7.78443 6.24401L4.78443 9.74401C4.71869 9.8158 4.62761 9.85921 4.53044 9.86507C4.43327 9.87093 4.33764 9.83878 4.26374 9.7754C4.18985 9.71203 4.1435 9.62241 4.13449 9.52548C4.12547 9.42856 4.1545 9.33192 4.21543 9.25601L7.00593 6.00001L4.21543 2.74401C4.15071 2.6686 4.11857 2.57058 4.12607 2.47148C4.13357 2.37239 4.1801 2.28032 4.25543 2.21551" fill="black" />
                </svg>
                <a href="{{ route('services') }}">{{ __('services.services') }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.25593 2.21501C4.33147 2.15041 4.42957 2.11844 4.52867 2.12612C4.62777 2.13381 4.71976 2.18053 4.78443 2.25601L7.78443 5.75601C7.84267 5.82397 7.87467 5.91051 7.87467 6.00001C7.87467 6.08951 7.84267 6.17605 7.78443 6.24401L4.78443 9.74401C4.71869 9.8158 4.62761 9.85921 4.53044 9.86507C4.43327 9.87093 4.33764 9.83878 4.26374 9.7754C4.18985 9.71203 4.1435 9.62241 4.13449 9.52548C4.12547 9.42856 4.1545 9.33192 4.21543 9.25601L7.00593 6.00001L4.21543 2.74401C4.15071 2.6686 4.11857 2.57058 4.12607 2.47148C4.13357 2.37239 4.1801 2.28032 4.25543 2.21551" fill="black" />
                </svg>
                <p>{{ $service->name }}</p>
            </div>

            <h3 class="title mb-4" data-entrance="from-left">
                {{ $service->name }}
            </h3>

            @forelse ($service->sections as $section)
                <div class="row mb-5">
                    <div @class(['col-xl-6 mb-4' ,$loop->iteration % 2 == 0 ? 'order-xl-last' : '']) data-entrance="from-left">
                        <img src="{{ asset($section->image) }}" class="w-100 rounded-5" />
                    </div>
                    <div @class(['col-xl-6 mb-4' , $loop->iteration % 2 == 0 ? 'order-xl-first' : '' ]) style="display: flex; flex-direction: column; justify-content: center;" data-entrance="from-right">
                        <p class="font-18 ">
                            {!! $section->body !!}
                        </p>
                    </div>
                </div>
            @empty
                {{ __('services.no_details') }}
            @endforelse

            <div class="text-center mt-5" data-entrance="from-bottom">
                <button onclick="window.location.href='{{ route('services') }}'" class="btn-purple text-decoration-none">
                    <p>{{ __('services.more_services') }}</p>
                </button>
            </div>

        </div>
    </section>

    <x-blocks.partners />
    <x-blocks.discover />
@endsection
