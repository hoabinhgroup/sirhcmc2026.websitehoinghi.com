@extends('layout.index')
@section('content')
  @include('pages.blog.partials.detail_hero')
  @include('pages.blog.partials.detail_content')
  @include('pages.blog.partials.detail_comment')
  @include('pages.blog.partials.detail_related')
@endsection
