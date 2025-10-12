@props([
    'title' => null,
    'intro' => null,
    'action' =>  '#',
])
<x-ui.section id="contact">
    <div class="mx-auto max-w-2xl text-center">
        @if($title)
            <x-ui.heading :text="$title" />
        @endif
        @if($intro)
            <x-ui.text muted class="mt-3" :text="$intro" />
        @endif
    </div>

    <x-ui.container class="mt-8">
        <form method="POST" action="{{ $action }}" data-module="form">
            @csrf
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-ui.label for="name" :value="__('Name')" />
                    <x-ui.input name="name" id="name" autocomplete="name" />
                </div>
                <div>
                    <x-ui.label for="email" :value="__('Email')" />
                    <x-ui.input name="email" id="email" type="email" autocomplete="email" />
                </div>
                <div class="sm:col-span-2">
                    <x-ui.label for="message" :value="__('Message')" />
                    <x-ui.textarea name="message" id="message" rows="5" />
                </div>
            </div>
            <div class="mt-6">
                <x-ui.button type="submit">{{ __('Send Message') }}</x-ui.button>
            </div>
        </form>
    </x-ui.container>
</x-ui.section>

