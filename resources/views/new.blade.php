@extends('layout')

@section('content')

<div class="contentsArea">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href={{route( 'index')}}>TOP</a></li>
      <li class="breadcrumb-item active" aria-current="page">受注案件新規登録</li>
    </ul>
  </nav>
  <section class="section">
    <h2 class="heading02">受注案件新規登録</h2>

    <div class="formArea">
    {{ Form::open(['route' => 'illustration.store', 'id' => 'illustrationForm', 'files' => true]) }}

    <canvas id="canvas" width="500" height="300" style="border: solid 1px #000;box-sizing: border-box;"></canvas>
  <div class="option">
    <div class="color">
      色：
      <a href="" class="black" data-color="0, 0, 0, 1"></a>
      <a href="" class="red" data-color="255, 0, 0, 1"></a>
      <a href="" class="blue" data-color="0, 0, 255, 1"></a>
    </div>
    <div class="bold">
      太さ：
      <a href="" class="small" data-bold="1">小</a>
      <a href="" class="middle" data-bold="5">中</a>
      <a href="" class="large" data-bold="10">大</a>
    </div>
  </div>
  <input type="button" value="clear" id="clear">
  <a id="download" href="#" download="canvas.jpg">ダウンロード</a>
  <div id="result"><img src=""></div>

  <div class="row mb-3 align-items-start">
      <div class="col-12">
      <label>●案件名</label>
      </div>
    <div class="col-md-10 form-group">
      <input class="form-control" type="text" name="comment" value="" required="" data-error="※入力必須です">
    </div>
  </div>

  <input type="file" name="image">

  <div class="form-group mt-5">
        {{ Form::submit('作成する', ['class' => 'btn-03']) }}
    </div>
    {{ Form::close() }}
    </div>


    </section>
</div>

@endsection