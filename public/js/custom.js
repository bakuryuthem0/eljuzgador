function beforeSend(btn) {
	btn.addClass('disabled').attr('disabled',true);
}
function loadContentNews(response, btn)
{
	endAjax(btn);
	var $news = $(response);
	$(btn.data('target')).append($news);
	if ($(window).width() >= 768) {
		$('.grid').isotope( 'insert', $news );
		$('.gitd').on('arrangeComplete', function(event) {
			$('.grid').isotope('layout');

		});
		$('.grid').isotope( 'reLayout')
	}
}
function endAjax(btn) {
	btn.removeClass('disabled').attr('disabled',false);
}
function ajaxError(btn){
	endAjax(btn)
	btn.removeClass('hidden');
	btn.next('.miniLoader').removeClass('active')
}
function successCheck (response, btn) {
	var dataPost = {};
	var estado = response.estado, actual = response.current;
	$.ajax({
		headers: {'csrftoken': $('input[name = _token]').val()},
		url: btn.data('url'),
		type: "GET",
		dataType: "html",
		data: dataPost,
		beforeSend: function(){
			beforeSend(btn)
		},
		success: function(response){
			if (estado == 1) {
				btn.fadeOut('fast', function() {
					btn.remove();
				});
			}else
			{
				btn.attr('data-url',getRootUrl()+'/noticias/cargar-mas?page='+actual)
			}
			loadContentNews(response, btn);
		},
		error: function(){
			ajaxError(btn)
		}
	});
}
function beforeLike (btn) {
	btn.addClass('hidden');
	btn.next('.miniLoader').addClass('active');
}
function successLike(response, btn)
{
	btn.next('.miniLoader').removeClass('active');
	btn.removeClass('hidden');
	btn.siblings(btn.data('target')).html(response.count)
	if (response.type == 'success') {
		if (btn.hasClass(btn.data('to-remove'))) {
			btn.removeClass(btn.data('to-remove')).addClass(btn.data('to-add'));
		}
		btn.attr('data-title','¡Exito!')
	}else
	{
		btn.attr('data-title','Ups!')
	}
	btn.attr('data-content',response.msg)
	btn.popover('show')
	setTimeout(function(){hidePopover(btn)}, 3000)
}
function hidePopover(btn)
{
	btn.popover('hide');
}
function successLoadContent  (response, btn) {
	endAjax(btn);
	$(btn.data('target')).append(response);
}
jQuery(document).ready(function($) {
	$(document).on("click",'.load-more',function(){
		var dataPost = {}, btn = $(this);
		doAjax(getRootUrl()+'/noticias/obtener-pagina?page='+btn.data('current'), "GET", "json", dataPost, btn, beforeSend, successCheck, ajaxError);
	})
	$('.fa-add-love').on('click', function(event) {
		var dataPost = {
			'art_id' : $(this).data('id') 
		}
		var btn = $(this);
		doAjax(getRootUrl()+'/agregar-love', "GET", "json", dataPost, btn, beforeLike, successLike, ajaxError);
	});
	$('.comment-form .validate-input').on('blur, keyup',function(){
		if (validate()) {
			$('.comment-form .btn-block').attr('disabled',false).addClass('btn-success')
		}else
		{
			$('.comment-form .btn-block').attr('disabled',true).removeClass('btn-success')
		}
	})
	$('.send-comment').on('click', function(event) {
		var proceed = validate();
		var btn = $(this);
		var dataPost = {
			name   :$('.comment_name').val(),
			email  :$('.comment_email').val(),
			comment:$('.comment_msg').val(),
			art_id : $('.art_id').val()
		};
		if (proceed) {
			doAjax(btn.data('url'), "post", "html", dataPost, btn, beforeSend, successLoadContent, ajaxError);
		}
	});
	$(document).on('click', '.fa-comment-like', function(event) {
		var dataPost = {
			'comment_id' : $(this).data('id') 
		}
		var btn = $(this);
		doAjax(getRootUrl()+'/agregar-like', "GET", "json", dataPost, btn, beforeLike, successLike, ajaxError);
	});
	$(document).on('click', '.relevant-news', function(event) {
		window.location.href = $(this).data('url');
	});
});