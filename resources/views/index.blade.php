@extends('layout')

@section('content')

<div class="contentsArea">
<section class="section">
<h2 class="heading02">写真一覧</h2>

@foreach($illustrations as $illustration)
<a href={{ route('illustration.detail', ['id' =>  $illustration->id]) }} class="btn-02-s">
  <img src="data:image/png;base64,{{ $illustration->filename }}">
</a>
@endforeach

</section>
</div>

@endsection