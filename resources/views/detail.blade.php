@extends('layout')

@section('content')

<div class="block02">

<div class="block02_img">
<img src="data:image/png;base64,{{ $illustration->filename }}">
<p>Posted by {{ $user_name->name }}</p>
</div>

<div class="block02_item">
<p>{{ $illustration->comment }}</p>

<p class="block02_title">Comments</p>
@foreach($comments as $comment)
    <div class="commentArea">
        <p>{{ $comment->comment }}</p>
        <p class="commentArea_name">{{ $comment->author->name }}</p>
    </div>
@endforeach

{{ Form::open(['route' => ['illustration.addComment', $illustration->id]]) }}
    <textarea class="form-control" name='add_comment' placeholder="コメント入力" rows="2">{{ old('content') }}</textarea>
    <button class="btn btn-secondary" type="submit">追加</button>
{{ Form::close() }}

</div>





</div>







@endsection