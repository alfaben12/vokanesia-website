@extends('layouts.base')
@section('body')
    <!-- banner start here -->
    @include('_partials.homes.banner')
    <!-- end of banner -->
    <!-- bes mentor here -->
    @include('_partials.homes.mentor')
    <!-- end of best mentor -->
    <!-- clients reviews -->
    @include('_partials.homes.testimonials')
    <!-- end of client reviews -->
@endsection