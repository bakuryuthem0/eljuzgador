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
		$('.gutter-7px > div:not(.active)').last().addClass('active');
		var dataPost = {}, btn = $(this);
		doAjax('http://localhost/eljuzgador/partials/more-news.php', "GET", "html", dataPost, btn, beforeSend, loadContentNews, ajaxError);
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