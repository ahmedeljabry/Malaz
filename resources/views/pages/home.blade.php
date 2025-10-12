@extends('layouts.app')
@section('title', __('nav.home'))
@section('content')
    <x-blocks.hero />
    <x-blocks.about />
    <x-blocks.service />
    <x-blocks.partners />
    <x-blocks.blog />
    <x-blocks.discover />
@endsection
