$(function(){
    
    // canvas
    var cnvs = document.getElementById('canvas');
    var ctx = cnvs.getContext('2d');
 
    // 変数宣言
    const cnvWidth = 500;
    const cnvHeight = 500;
    var cnvColor = "0, 0, 0, 1";  // 線の色
    var cnvBold = 5;  // 線の太さ
    var clickFlg = 0;  // クリック中の判定 1:クリック開始 2:クリック中
    var bgColor = "rgb(255,255,255)";
 
    // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
    setBgColor();
 
    // canvas上でのイベント
    $("#canvas").mousedown(function(){
      clickFlg = 1; // マウス押下開始
    }).mouseup(function(){
      clickFlg = 0; // マウス押下終了
    }).mousemove(function(e){
      // マウス移動処理
      if(!clickFlg) return false;
      draw(e.offsetX, e.offsetY);
    });
 
    // 描画処理
    function draw(x, y) {
      ctx.lineWidth = cnvBold;
      ctx.strokeStyle = 'rgba('+cnvColor+')';
      // 初回処理の判定
      if (clickFlg == "1") {
        clickFlg = "2";
        ctx.beginPath();
        ctx.lineCap = "round";  //　線を角丸にする
        ctx.moveTo(x, y);
      } else {
        ctx.lineTo(x, y);
      }
      ctx.stroke();
    };
 
    // 色の変更
    $(".color a").click(function(){
      cnvColor = $(this).data("color");
      return false;
    });
 
    // 線の太さ変更
    $(".bold a").click(function(){
      cnvBold = $(this).data("bold");
      return false;
    });
 
    // 描画クリア
    $("#clear").click(function(){
      ctx.clearRect(0,0,cnvWidth,cnvHeight);
      setBgColor();
    });
 
    // canvasを画像で保存
    $("#download").click(function(){
      //canvas = document.getElementById('canvas');
      //var base64 = canvas.toDataURL("image/jpeg");
      var img = 'data:application/octet-stream;base64,' + $(this).data("name");
      $(this).attr('src', img);
    });
    
 
    function setBgColor(){
      // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
      ctx.fillStyle = bgColor;
      ctx.fillRect(0,0,cnvWidth,cnvHeight);
    }

    // フォーム送信
    $("#submitBtn").click(function(){
      canvas = document.getElementById('canvas');
      const form = document.getElementById('illustrationForm');
      var base64 = canvas.toDataURL("image/jpeg");
      document.getElementById('input_canvas').value=base64;
      form.submit();
    });

  });


$(function(){
  $("#download").click(function(){
    //canvas = document.getElementById('canvas');
    //var base64 = canvas.toDataURL("image/jpeg");
    //var img = 'data:application/octet-stream;base64,' + $(this).data("name");
    //$(this).attr('href', img);
    //var img = reference to image
    var url = $(this).data("name").replace(/^data:image\/[^;]+/, 'data:application/octet-stream');
    $(this).attr('href', url);
    // Or perhaps: location.href = url;
    // Or even setting the location of an <iframe> element, 
  });
});