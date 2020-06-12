@extends('layouts.base')

@section('title', 'Blog')

@section('body')
    <section class="xs-section-padding blog-grid-sidebar-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8"> 
                    <div class="single-blog-post post-list format-gallery">
                        <div class="post-image">
                            <img style="height: 300px;width: 100%;object-fit: cover;" src="{{Voyager::image(str_replace('\\', '/', $data->cover))}}" alt="{{$data->title}}">
                        </div>
                        <div class="post-body">
                            <div class="entry-header">
                                <div class="entry-meta">
                                    <span class="post-author"><a href="#"><i class="icon icon-user2"></i> {{$data->userDetails->name}}</a></span>
                                    <span class="post-cat"><a href="#"><i class="icon icon-folders"></i> {{$data->kategoriDetails->name}}</a></span>
                                    <span class="post-date"><strong>{{$data->created_at->format('d')}}</strong>{{$data->created_at->format('M')}}</span>
                                </div>
                                <h2 class="entry-title"><a href="blog-single.html">{{$data->title}}</a></h2>
                                <div class="entry-content">
                                    {!!$data->post!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-categories">
                        <div class="widget-header">
                            <h3 class="xs-title">Category</h3>
                            <span class="border-divider"></span>
                        </div>
                        <ul class="list-group">
                            @foreach($category as $row)
                            <li>
                                <a href="{{route('blog.index', ['kategori' => $row->slug])}}">
                                    {{$row->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
