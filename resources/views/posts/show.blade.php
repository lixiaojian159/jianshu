@extends('layouts.default')
@section('title','文章详情')
@section('content')
<div class="blog-post">
    @include('layouts._messages')
    <div style="display:inline-flex">
            <h2 class="blog-post-title">{{$post->title}}</h2>
            @can('update',$post)
            <a style="margin: auto"  href='{{url("/posts/$post->id/edit")}}'>
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            @endcan
            @can('delete',$post)
            <a style="margin: auto"  href='{{url("/posts/$post->id/delete")}}'>
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
            @endcan
    </div>
    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="#">{{$post->user->name}}</a></p>
    <p><p>{!!$post->content!!}</p><p><br></p></p>
    <div>
        @if( $post->zan(Auth::id())->exists() )
        <a href='{{url("/posts/$post->id/zan")}}' type="button" class="btn btn-primary btn-lg">赞</a>
        @else
        <a href='{{url("/posts/$post->id/quzan")}}' type="button" class="btn btn-primary btn-lg">取消赞</a>
        @endif
    </div>
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">评论</div>
    <!-- List group -->
    <ul class="list-group">
        @foreach($post->comments as $comment)
        <li class="list-group-item">
            <h5>{{$comment->created_at}} by {{$comment->user->name}}</h5>
            <div>{{$comment->content}}</div>
        </li>
        @endforeach
    </ul>
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">发表评论</div>
    <div style="height: 5px"></div>
    @include('layouts._error')
    <!-- List group -->
    <ul class="list-group">
        <form action='{{url("/posts/$post->id/comment")}}' method="post">
            {{csrf_field()}}
            <input type="hidden" name="post_id" value="62"/>
            <li class="list-group-item">
                <textarea name="content" class="form-control" rows="10"></textarea>
                <div style="height: 5px"></div>
                <button class="btn btn-default" type="submit">提交</button>
            </li>
        </form>
    </ul>
</div>
@stop