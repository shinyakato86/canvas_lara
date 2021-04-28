@extends('layout')

@section('content')
<h2 class="heading02">お絵描き投稿詳細</h2>

<div class="block02">

<div class="block02_img">
<img src="{{ $illustration->filename }}" id="canvasImg">
<p class="mt-3"><i class="fas fa-pencil-alt mr-3"></i>Posted by {{ $user_name->name }}</p>
@auth
  @if ($illustration->user_id === Auth::user()->id)
{{ Form::open(['method' => 'delete', 'route' => ['illustration.destroy', $illustration->id]]) }}
  {{ Form::submit('削除', ['class' => 'btn mt-3 btn-danger']) }}
{{ Form::close() }}
  @endif
@endauth

</div>

<div class="block02_item">

@auth
  <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
@if (!$illustration->isLikedBy(Auth::user()))
    <span class="likes-detail">
        <i class="fas fa-heart like-toggle" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration_likes_count}}</span>
    </span><!-- /.likes -->
  @else
    <span class="likes-detail">
        <i class="fas fa-heart heart like-toggle liked" data-illustration-id="{{ $illustration->id }}"></i>
      <span class="like-counter">{{$illustration_likes_count}}</span>
    </span><!-- /.likes -->
  @endif
@endauth
@guest
  <span class="likes-detail">
      <i class="fas fa-heart heart like-guest"></i>
    <span class="like-counter">{{$illustration_likes_count}}</span>
  </span><!-- /.likes -->
@endguest

<a id="download" href="" data-name="{{ $illustration->filename }}" download="img.jpg" class="icon_download"><i class="fas fa-arrow-down"></i></a>

<p class="authorComment">{{ $illustration->comment }}</p>

@foreach($comments as $comment)
    <div class="commentArea">
        <p>{{ $comment->comment }}</p>
        <p class="commentArea_name">{{ $comment->author->name }}</p>
    </div>
@endforeach

<p class="block02_title">コメント</p>
{{ Form::open(['route' => ['illustration.addComment', $illustration->id]]) }}
    <textarea class="form-control mb-3" name='add_comment' placeholder="コメント入力" rows="2">{{ old('content') }}</textarea>
    @foreach ($errors->all() as $error)
    <p class="errorText">※{{ $error }}</p>
    @endforeach
    <button class="btn btn-info btn-block mt-5" type="submit">コメント投稿</button>
{{ Form::close() }}

</div>

</div>

@endsection