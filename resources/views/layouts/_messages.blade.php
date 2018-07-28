@foreach(['success','info','warning','danger'] as $mess)
@if(session()->has($mess))
<div class="alert alert-{{$mess}}">{{session()->get($mess)}}</div>
@endif
@endforeach