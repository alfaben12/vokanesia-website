@extends('layouts.base')

@section('title', 'Blog')

@section('body')
    <section class="xs-section-padding blog-grid-sidebar-area">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="blog-post-lists">    
                        @foreach($data as $row)
                            <div class="post-list format-standard">
                                <div class="post-image">
                                    <img style="height: 300px;width: 100%;object-fit: cover;" src="{{Voyager::image(str_replace('\\', '/', $row->cover))}}" alt="{{$row->title}}">
                                </div>
                                <div class="post-body">
                                    <div class="entry-header">
                                        <div class="entry-meta">
                                            <span class="post-author"><a href="#"><i class="icon icon-user2"></i> {{$row->userDetails->name}}</a></span>
                                            <span class="post-cat"><a href="#"><i class="icon icon-folders"></i> {{$row->kategoriDetails->name}}</a></span>
                                            <span class="post-date"><strong>{{$row->created_at->format('d')}}</strong>{{$row->created_at->format('M')}}</span>
                                        </div>
                                        <h2 class="entry-title"><a href="blog-single.html">{{$row->title}}</a></h2>
                                        <div class="btn-wraper">
                                            <a href="{{route('blog.show', ['kategori' => $row->kategoriDetails->slug, 'slug' => $row->slug])}}" class="btn btn-primary icon-right">Continue Reading <i class="icon icon-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
