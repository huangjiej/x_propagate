$(function() {
	//验证码
	$(".getcode").click(function() {
		time(this);
	});
	//share click
	$(document).on("click", '[data-toggle="share-btn"]', function() {
		var html = '<div class="share">\
		<p class="txt">方法一：点击右上角┆图标<br>\
		然后发送给朋友<br>\
		或分享到朋友圈\
		</p>\
		</div>'
		$(html).appendTo('.main,.scroll')
		$(".share").fadeIn();
	});

	//share
	$(".scroll,.main").on("click", ".share", function() {
		$(".share").fadeOut();
		$(".share").remove();
	})

	//comment
	$(document).on("click", '[data-toggle="comment"]', function() {
		$(".reply").show();
		$(".reply input2").focus();
	})

	$(document).on("click", '[data-toggle="comment"]', function() {
		$(".reply").show();
		$(".reply .input2").focus();
	})

	$(document).on("click", '[data-toggle="close-reply"]', function() {
		$(".reply").hide();
	})

	//zan
	$(document).on("click", ".zan", function() {
		var num = $(this).find('.num').html();
		if ($(this).hasClass('on')) {
			$(this).removeClass('on');
			$(this).find('.num').html(Number(num) - 1)
		} else {
			$(this).addClass('on');
			$(this).find('.num').html(Number(num) + 1)
		}
	})
	
})


var wait = 30;

function time(o) {
	if (wait == 0) {
		o.removeAttribute("disabled");
		$(o).removeClass('disabled');
		o.value = "获取校验码";
		wait = 30;
	} else {
		o.setAttribute("disabled", true);
		$(o).addClass('disabled');
		o.value = "获取校验码(" + wait + "s)";
		wait--;
		setTimeout(function() {
				time(o)
			},
			1000)
	}
}