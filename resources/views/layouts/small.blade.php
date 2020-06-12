@extends('layouts.base')

@section('body')
    <section class="section-default">
        <div class="container">
            @include('layouts._alerts')
            
            <div class="div-register">
                @yield('small-content')
            </div>
        </div>
        @yield('small-content-after')
    </section>
@endsection