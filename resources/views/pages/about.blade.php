@extends('layouts.app')
@section('title', __('about.title'))
@section('content')
    <x-blocks.about :btn_title="__('home.company_profile')" />
    <x-blocks.visions />
    <x-blocks.service />
    <x-blocks.partners />
    <x-blocks.discover />
@endsection
