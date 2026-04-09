@extends('layout.index')

@section('content')
  @include('pages.home.partials.hero')
  @include('pages.home.partials.counter')
  @include('pages.home.partials.about')
  @include('pages.home.partials.team_member')
  {{-- @include('pages.home.partials.pricing') --}}
  {{-- @include('pages.home.partials.blog') --}}
  @include('pages.home.partials.schedule')
  @include('pages.home.partials.newlatter')
  @include('pages.home.partials.contact')
@endsection
