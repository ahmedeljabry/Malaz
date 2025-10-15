@extends('layouts.app')
@section('title', __('nav.contact'))
@section('content')
        <section class="py-5">
        <div class="container">


            <h3 class="title mb-3 "  data-entrance="from-top">
                {{ __('nav.contact') }}
            </h3>

          <div class="row">
              <div class="col-xl-6">
                  <div style="border-radius:20px; overflow:hidden;" data-entrance="from-top">
                      {!! \App\Models\Setting::value('map_iframe_1') ?: '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8828.338198583187!2d39.18138550046487!3d21.51324324359736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2sJeddah%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1759687803016!5m2!1sen!2seg" width="100%" height="400" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                  </div>

                  <div class="row mt-5 mb-5">
                      <div class="col-xl-6" data-entrance="from-top">
                          <h5 class="bold mb-4">{{ __('contact.location') }}</h5>
                          <p>{{ \App\Models\Setting::value('address1') }}</p>
                          <p>{{ \App\Models\Setting::value('address2') }}</p>
                      </div>
                      <div class="col-xl-6" data-entrance="from-top">
                          <h5 class="bold mb-4">{{ __('contact.call_us') }}</h5>
                          @php($phone = \App\Models\Setting::value('phone'))
                          @php($email = \App\Models\Setting::value('email'))
                          @if($phone)
                              <p>{{ $phone }}</p>
                          @endif
                          @if($email)
                              <p>{{ $email }}</p>
                          @endif
                      </div>

                  </div>

              </div>
              <div class="col-xl-6">
                  <div style="border-radius:20px; overflow:hidden;" data-entrance="from-top">
                      {!! \App\Models\Setting::value('map_iframe_2') ?: \App\Models\Setting::value('map_iframe_1') ?: '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8828.338198583187!2d39.18138550046487!3d21.51324324359736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2sJeddah%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1759687803016!5m2!1sen!2seg" width="100%" height="400" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                  </div>

                  <div class="row mt-5 mb-5">
                      <div class="col-xl-6" data-entrance="from-top">
                          <h5 class="bold mb-4">{{ __('contact.location') }}</h5>
                          <p>{{ \App\Models\Setting::value('address1') }}</p>
                          <p>{{ \App\Models\Setting::value('address2') }}</p>
                      </div>
                      <div class="col-xl-6" data-entrance="from-top">
                          <h5 class="bold mb-4">{{ __('contact.call_us') }}</h5>
                          @php($phone = \App\Models\Setting::value('phone'))
                          @php($email = \App\Models\Setting::value('email'))
                          @if($phone)
                              <p>{{ $phone }}</p>
                          @endif
                          @if($email)
                              <p>{{ $email }}</p>
                          @endif
                      </div>

                  </div>

              </div>
          </div>

          <div class="row mt-5">
              <div class="col-xl-3"></div>
              <div class="col-xl-6" data-entrance="from-top">
                  <h5 class="bold mb-4">{{ __('nav.contact') }}</h5>

                  @if (session('status'))
                      <div class="alert alert-success">{{ session('status') }}</div>
                  @endif

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul class="mb-0">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <form method="post" action="{{ route('contact.submit') }}">
                      @csrf
                      <div class="form-floating mb-3">
                          <input name="name" type="text" class="form-control" id="nameInput" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                          <label for="nameInput">{{ __('Name') }} <span class="red">*</span></label>
                      </div>

                      <div class="form-floating mb-3">
                          <input name="email" type="email" class="form-control" id="emailInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                          <label for="emailInput">{{ __('Email address') }}  <span class="red">*</span></label>
                      </div>

                      <div class="form-floating mb-3">
                          <input name="phone" type="text" class="form-control" id="phoneInput" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}">
                          <label for="phoneInput">{{ __('Phone') }}</label>
                      </div>

                      <div class="form-floating mb-3">
                          <input name="subject" type="text" class="form-control" id="subjectInput" placeholder="{{ __('Subject') }}" value="{{ old('subject') }}">
                          <label for="subjectInput">{{ __('Subject') }}</label>
                      </div>

                      <div class="form-floating">
                          <textarea name="message" class="form-control" placeholder="{{ __('Message') }}" id="messageInput" style="height: 100px" required>{{ old('message') }}</textarea>
                          <label for="messageInput">{{ __('Message') }}  <span class="red">*</span></label>
                      </div>

                      <div class="mt-5 text-center">
                          <button class="btn-purple" type="submit">
                              <p>{{ __('Send') }}</p>
                          </button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
    </section>

@endsection
