@extends('layouts.base')

@section('title', $data->title)

@section('body')
    <section class="xs-section-padding">
        <div class="container">
            {!! $data->pages !!}
        </div>
    </section>
@endsection