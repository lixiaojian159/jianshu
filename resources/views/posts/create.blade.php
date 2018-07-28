@extends('layouts.default')
@section('title','文章创建')
@section('content')
<form action="{{url('/posts')}}" method="POST">
    {{csrf_field()}}
   <!--  <input type="hidden" name="_token" value="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"> -->
   @include('layouts._error')
    <div class="form-group">
        <label>标题</label>
        <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label>内容</label>
        <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容">{{old('content')}}</textarea>
    </div>
    <button type="submit" class="btn btn-default">提交</button>
</form>
<br>
@stop
