$(function () {
  let like = $('.like-toggle');
  let likeIllustrationId;
  like.on('click', function () {
    let $this = $(this);
    likeIllustrationId = $this.data('illustration-id');
    //ajax処理
    $.ajax({
      headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/like',
      method: 'POST',
      data: {
        'illustration_id': likeIllustrationId
      },
    })
    //通信成功
    .done(function (data) {
      $this.toggleClass('liked');
      $this.next('.like-counter').html(data.illustration_likes_count);
    })
    //通信失敗
    .fail(function () {
      console.log('fail'); 
    });
  });
});