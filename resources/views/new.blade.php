@extends('layout')

@section('content')


    <h2 class="heading02">お絵描き新規投稿</h2>

    <div class="formArea">
    {{ Form::open(['route' => 'illustration.store', 'id' => 'illustrationForm', 'files' => true]) }}

    <div class="block03">
    <div class="block03_item-01">

      <canvas id="canvas" width="500" height="300" style="border: solid 1px #000;box-sizing: border-box;"></canvas>
    </div>
    <div class="block03_item-02">
  <div class="option">
    <div class="color">
      <span class="fw-b">色：</span>
      <a href="" class="black" data-color="0, 0, 0, 1"></a>
      <a href="" class="red" data-color="255, 0, 0, 1"></a>
      <a href="" class="blue" data-color="0, 0, 255, 1"></a>
      <a href="" class="yellow" data-color="255, 255, 0, 1"></a>
      <a href="" class="green" data-color="0, 128, 0, 1"></a>
      <a href="" class="gray" data-color="128, 128, 128, 1"></a>
    </div>
    <div class="bold mt-3">
    <span class="fw-b">太さ：</span>
      <a href="" class="small" data-bold="1">小</a>
      <a href="" class="middle" data-bold="5">中</a>
      <a href="" class="large" data-bold="10">大</a>
    </div>
  </div>
  <input type="button" class="btn btn-danger mt-3" value="clear" id="clear">
  <div id="result"><img src=""></div>

  <div>
      <div class="w-100">
      <label><i class="fas fa-comment mr-1"></i>投稿者コメント（50文字まで）</label>
      </div>
    <div class="form-group w-100">
      <textarea class="form-control" name="comment" rows="2" cols="20" placeholder="コメントを入力" required></textarea>
    </div>
  </div>
    @foreach ($errors->all() as $error)
    <p class="errorText">※{{ $error }}</p>
    @endforeach
  <input id="input_canvas" type="hidden" name="input_canvas" value="">

  <div class="form-group mt-5">
        <btn class="btn btn-info btn-block" id="submitBtn">投稿する</btn>
    </div>
    {{ Form::close() }}
    </div>

    </div>

    </div>
@endsection