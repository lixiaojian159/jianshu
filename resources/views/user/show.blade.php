@extends('layouts.default')
@section('title','个人主页')
@section('content')
<div>
    <blockquote>
            <p>
            	<img src="{{asset('/home/image/user.jpeg')}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$users->name}}
            </p>
            <footer>
                关注：{{$users->starCount()}}｜粉丝：{{$users->fanCount()}}｜文章：{{$users->postCount()}}
            </footer>
            <div style="height: 10px"></div>
            @include('user.bages.like',['target_user'=>$users])
    </blockquote>
 </div>
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                            <p><a href="">{{$users->name}}</a> {{$post->created_at->diffForHumans()}} </p>
                            <p><a href="/posts/{{$post->id}}/show" >{{$post->title}}</a></p>
                            <p>{!!str_limit($post->content,200,'...')!!}</p>
                    </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    
                    @foreach($susers as $star)
                    <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$star->name}}</p>
                            <p class="">关注：{{$star->stars_count}} | 粉丝：{{$star->fans_count}}｜ 文章：{{$star->posts_count}}</p>

                            @include('user.bages.like',['target_user'=>$star])
                    </div>
                    @endforeach

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">

                    @foreach($fusers as $fan)
                    <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fan->name}}</p>
                            <p class="">
                                关注：{{$fan->stars_count}} | 粉丝：{{$fan->fans_count}}｜ 文章：{{$fan->posts_count}}
                            </p>
                            @include('user.bages.like',['target_user'=>$fan])
                    </div>
                    @endforeach

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
@stop