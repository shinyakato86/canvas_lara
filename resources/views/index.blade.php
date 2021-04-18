@extends('layout')

@section('content')


<div class="block01">

  @foreach($illustrations as $illustration)
    <a href={{ route('illustration.detail', ['id' =>  $illustration->id]) }} class="block01_item">
      <img src="{{ $illustration->filename }}">

    @auth
  <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
  @if (!$illustration->isLikedBy(Auth::user()))
    <span class="likes">
        <i class="fas fa-heart like-toggle" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration->likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes">
        <i class="fas fa-heart heart like-toggle liked" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration->likes_count}}</span>
    </span><!-- /.likes -->
  @endif
@endauth
@guest
  <span class="likes">
      <i class="fas fa-heart heart"></i>
    <span class="like-counter">{{$illustration->likes_count}}</span>
  </span><!-- /.likes -->
@endguest

    <div class="block01_bg"></div>
  </a>



  @endforeach




</div>


@endsection