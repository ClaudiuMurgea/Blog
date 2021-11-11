@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-8">

          <div class="card">

            <nav class="navbar navbar-light bg-light card-header">
                  <a class="navbar-brand text-primary card-body text-center" href="/"> Show Posts </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
                  <a class="navbar-brand text-primary card-body text-center" href="/admin/categories"> Show Categories </a>
            </nav>

            <nav class="navbar navbar-light bg-light card-header">
                  <a class="navbar-brand text-primary card-body text-center" href="/admin/comments"> Accept Comments </a>
            </nav>

          </div>
        </div>
      </div>
  </div>

@endsection
