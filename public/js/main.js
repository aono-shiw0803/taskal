// ログイン時の本日のタスク表示
$(function(){
  $(window).ready(function(){
    setTimeout(function(){
      $('.login-bg').fadeIn(400);
    }, 500);
    setTimeout(function(){
      $('.login-message').addClass('add');
    }, 1000);
  });
});
$(function(){
  $('.login-message-main input, .login-bg').click(function(){
    $('.login-bg, .login-message.add').fadeOut(400);
  });
});
// ログイン時の本日のタスク表示

// フラッシュメッセージ
$(function(){
  setTimeout(function(){
    $('.flash').fadeOut(300);
  }, 2500);
});
// フラッシュメッセージ

/* オープニングアニメーション */
$(function(){
  $(window).ready(function(){
    $(".animation-main #anime-1, .animation-main #anime-2, .animation-main #anime-3").addClass('add');
    setTimeout(function(){
      $('.animation-main h1').addClass('add');
    }, 1000);
    setTimeout(function(){
      $('.animation').addClass('add');
      $('.animation-main').css('display', 'none');
    }, 2500);
    setTimeout(function(){
      $('.welcome-btn').addClass('add');
    }, 3000);
  });
});

$(function(){
  setTimeout(function(){
    $('.animation').css({'background-color':'#ccff99', 'transition':'1.0s'});
  }, 500);
  setTimeout(function(){
    $('.animation').css({'background-color':'#99ff99', 'transition':'1.0s'});
  }, 1500);
});
/* オープニングアニメーション */


// login
$(function(){
  setTimeout(function(){
    $('.login-main .anime-1, .register-main .anime-1').addClass('add');
  }, 100);
  setTimeout(function(){
    $('.login-main .anime-2, .register-main .anime-2').addClass('add');
  }, 200);
  setTimeout(function(){
    $('.login-main .anime-3, .register-main .anime-3').addClass('add');
  }, 300);
  setTimeout(function(){
    $('.login-main .anime-4, .register-main .anime-4').addClass('add');
  }, 400);
  setTimeout(function(){
    $('.login-main .anime-5, .register-main .anime-5').addClass('add');
  }, 500);
  setTimeout(function(){
    $('.login-main .anime-6, .login-main .anime-7').addClass('add');
  }, 800);
  setTimeout(function(){
    $('.register-main .anime-6').addClass('add');
  }, 600);
  setTimeout(function(){
    $('.register-main .anime-7').addClass('add');
  }, 700);
  setTimeout(function(){
    $('.register-main .anime-8').addClass('add');
  }, 800);
  setTimeout(function(){
    $('.register-main .anime-9').addClass('add');
  }, 900);
  setTimeout(function(){
    $('.register-main .anime-10').addClass('add');
  }, 1200);
});
// login


// 未完了タスクhoverメッセージ
$(function(){
  $('.attention').each(function(){
    $('.msg').hide();
    $('.attention').hover(function(){
      $('.msg').fadeIn(0);
    }, function(){
      $('.msg').fadeOut(0);
    });
  });
});
// 未完了タスクhoverメッセージ


// -----ドラックスクロール-----
$(function(){
  jQuery.prototype.mousedragscrollable = function(){
    let target; // 動かす対象
    $(this).each(function (i, e){
      $(e).mousedown(function (event){
        event.preventDefault();
        target = $(e); // 動かす対象
        $(e).data({
          "down": true,
          "move": false,
          "x": event.clientX,
          "y": event.clientY,
          "scrollleft": $(e).scrollLeft(),
          "scrolltop": $(e).scrollTop(),
        });
        return false
      });
      // move後のlink無効
      $(e).click(function (event){
        if ($(e).data("move")){
          return false
        }
      });
    });
    // list要素内/外でのevent
    $(document).mousemove(function (event){
      if ($(target).data("down")){
        event.preventDefault();
        let move_x = $(target).data("x") - event.clientX;
        let move_y = $(target).data("y") - event.clientY;
        if (move_x !== 0 || move_y !== 0){
          $(target).data("move", true);
        } else { return; };
        $(target).scrollLeft($(target).data("scrollleft") + move_x);
        $(target).scrollTop($(target).data("scrolltop") + move_y);
        return false
      }
    }).mouseup(function (event){
      $(target).data("down", false);
      return false;
    });
  }
  $(".schedule").mousedragscrollable();
});
// -----ドラックスクロール-----

// サイドバーメニューの開閉システム
$(function(){
  $('#open').click(function(){
    $('.left-side').addClass('open');
  });
  $('#close').click(function(){
    $('.left-side').removeClass('open');
  });
});
// サイドバーメニューの開閉システム
