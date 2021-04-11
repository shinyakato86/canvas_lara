@extends('layout')

@section('content')


<div class="block01">

  @foreach($illustrations as $illustration)
  <div class="block01_item">
    <a href={{ route('illustration.detail', ['id' =>  $illustration->id]) }} class="btn-02-s">
      <img src="data:image/png;base64,{{ $illustration->filename }}">
    </a>

    @auth
  <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
  @if (!$illustration->isLikedBy(Auth::user()))
    <span class="likes">
        <i class="fas fa-music like-toggle" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration->likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes">
        <i class="fas fa-music heart like-toggle liked" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration->likes_count}}</span>
    </span><!-- /.likes -->
  @endif
@endauth
@guest
  <span class="likes">
      <i class="fas fa-music heart"></i>
    <span class="like-counter">{{$illustration->likes_count}}</span>
  </span><!-- /.likes -->
@endguest

  </div>



  @endforeach




</div>


@endsection