function beforeSend(btn) {
	btn.addClass('disabled').attr('disabled',true);
}
function loadContentNews(response, btn)
{
	endAjax(btn);
	$(btn.data('target')).append(response);
}
function endAjax(btn) {
	btn.removeClass('disabled').attr('disabled',false);
}
function ajaxError(btn){
	endAjax(btn)
}
jQuery(document).ready(function($) {
	$(document).on("click",'.load-more',function(){
		var dataPost = {}, btn = $(this);
		doAjax(btn.data('url'), "GET", "html", dataPost, btn, beforeSend, loadContentNews, ajaxError);
	})
	$('.comment-form .validate-input').on('blur, keyup',function(){
		if (validate()) {
			$('.comment-form .btn-block').attr('disabled',false).addClass('btn-success')
		}else
		{
			$('.comment-form .btn-block').attr('disabled',true).removeClass('btn-success')
		}
	})
});