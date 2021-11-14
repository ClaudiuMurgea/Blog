@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-8">

          <div class="card">

            <nav class="navbar navbar-light bg-light card-header">
                <a class="navbar-brand text-primary card-body text-center" href="{{ route('public.posts') }}"> Show published posts </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
              <a class="navbar-brand text-primary card-body text-center" href={{ route('admin.posts') }}> Show all posts </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
              <a class="navbar-brand text-primary card-body text-center" href={{ route('post.create') }}> Create Posts </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
              <a class="navbar-brand text-primary card-body text-center" href={{ route('admin.categories') }}> Show Categories </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
              <a class="navbar-brand text-primary card-body text-center" href={{ route('category.create') }}> Create Category </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
                <a class="navbar-brand text-primary card-body text-center" href={{ route('admin.comments') }}> Accept Comments </a>
            </nav>

          </div>
        </div>
      </div>
  </div>

@endsection
