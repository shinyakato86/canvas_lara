@extends('layout')

@section('content')

<div class="contentsArea">
<section class="section">
    <h2 class="heading02">受注案件詳細</h2>
            <p>{{ $illustration->comment }}</p>
            <p>Posted by {{ $user_name->name }}</p>

            @foreach($comments as $comment)
                 <p>{{ $comment->comment }}</p>
                 <p>{{ $comment->author->name }}</p>
            @endforeach

            {{ Form::open(['route' => ['illustration.addComment', $illustration->id]]) }}
            <textarea class="form-control" name='add_comment' placeholder="コメント入力" rows="2">{{ old('content') }}</textarea>
            <button class="btn btn-primary" type="submit">Button</button>
            {{ Form::close() }}

        <img src="data:image/png;base64,{{ $illustration->filename }}">

</section>




</div>
@endsection