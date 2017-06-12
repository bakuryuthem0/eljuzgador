function startCheckAjax(check)
{
	check.addClass('hidden').prev('.miniLoader').addClass('active');
}
function endCheckAjax (check) {
	check.removeClass('hidden');
}
function successCheckMenu(response, check, $tableRows)
{
	$tableRows = $($('.menu-cat-table').DataTable().rows().nodes());
	console.log($tableRows)
	endAjax(response, check);
	endCheckAjax(check);
	if (response.type == "danger") {
		$('.responseAjax').children('p').html(response.msg);
		$('html, body').animate({
            scrollTop: $(".responseAjax").offset().top
        }, 500);
	}
	if (response.status == 1) {
		check.attr('checked', true);	
	}else if(response.status == 2)
	{
		check.attr('checked', true);	
		$tableRows.find('.menu_active_'+response.last).attr('checked', false);
	}
	else
	{
		check.attr('checked', false);
	}
	setTimeout(removeResponseAjax, 3000);
}
function errorCheckMenu(check)
{
	endAjax({type:'danger'}, check)
	endCheckAjax(check);
	check.attr('checked',false)
	$('.responseAjax').children('p').html('Error 500, intente de nuevo o contacte al administrador del sitio');
	$('html, body').animate({
            scrollTop: $(".responseAjax").offset().top
        }, 500);
	setTimeout(removeResponseAjax, 3000);
}
function checkMenuCat(check, length, max_text, url, amount)
{
	var dataPost = {id: check.val()};
	doAjax(url, 'GET', 'json', dataPost, check, startCheckAjax, successCheckMenu, errorCheckMenu);
}
jQuery(document).ready(function($) {
	$('.validate-input').on('blur', function(event) {
		emptyMsg($(this));
	});
	$('select.validate-input').on('change', function(event) {
		emptyMsg($(this));
	});
	$('.btn-send-form').on('click', function(event) {
		var proceed;
		proceed = validate();
		if (proceed == 1) {
			$('form').submit();
		};
	});
	$('.btn-change-pass').on('click', function(event) {
		$('.send-change-pass').val($(this).val());
	});
	$('.image-file').on('change',function(event){
		imgPreview(event, 'img-responsive', $(this).nextAll('.outpost'));
	});
	$(document).on('change', '.image-file', function(event) {
		imgPreview(event, 'publication-image center-block', $($(this).nextAll('.outpost')));
	});
	$('.btn-show-msg').on('click', function(event) {
		if ($(this).val() != "") {
			$('.modal-msg-content').html($(this).val())
		}else
		{
			$('.modal-msg-content').html('Sin mensaje')
		}
	});
	$('.payment_type').on('change', function(event) {
		var $type = $(this);
		$('.amount-type').addClass('hidden').children('input').attr('disabled',true);
		
		if ($type.val() == 1) {
			$('.amount-inscription').removeClass('hidden').children('input').attr('disabled',false);
			$('.amount-envelope').removeClass('hidden').children('input').attr('disabled',false);
			$('.amount-bill-1').removeClass('hidden').children('input').attr('disabled',false);
			$('.amount-bill-2').removeClass('hidden').children('input').attr('disabled',false);
			$('.amount-bill-3').removeClass('hidden').children('input').attr('disabled',false);
		}else if($type.val() == 2)
		{
			$('.amount-inscription').removeClass('hidden').children('input').attr('disabled',false);
			$('.amount-envelope').removeClass('hidden').children('input').attr('disabled',false);
		}else
		{
			$('.amount-type').addClass('hidden').children('input').attr('disabled',true);
		}
	});
	$('.payment_method').on('change', function(event) {
		var $type = $(this);
		if ($type.val() == "transferencia" || $type.val() == "cheque") {
			$('.bank-emisor').removeClass('hidden').children('input').attr('disabled',false);
		}else
		{
			$('.bank-emisor').addClass('hidden').children('input').attr('disabled',true);
		}
	});
	$(document).on('click','.change-image-input', function(event) {
		var btn = $(this);
		if(btn.nextAll('.outpost').find('img').hasClass('link'))
		{	
			btn.nextAll('.outpost').find('img').removeClass('link').removeClass('hidden');
		}else
		{
			btn.nextAll('.outpost').find('img').addClass('link').addClass('hidden');
		}
		btn.siblings('.image.active').addClass('hidden').attr('disabled',true)
		btn.siblings('.image.hidden:not(.active)').removeClass('hidden').addClass('to-active').attr('disabled',false);
		btn.siblings('.image.active').removeClass('active');
		btn.siblings('.image.to-active').removeClass('to-active').addClass('active');
	});
	$(document).on('click','.menu_active', function(event) {
          var table = $('.menu-cat-table').DataTable();
          var checked = $(table.rows().nodes()).find('.menu_active:checked').length
          var check     = $(this);
          var length    = check.data('length');
          var max_text  = check.data('max-text');
          var url       = check.data('url');
          checkMenuCat(check, length, max_text, url, checked, $(table.rows().nodes()));
        });
	/***************************/
	/***                     ***/
	/***        Ajax         ***/
	/***                     ***/
	/***************************/
	$('.btn-clone').on('click', function(event) {
		var btn    		= $(this);
		var target 		= btn.data('target');
		var input   	= btn.data('input');
		var name		= btn.data('name');
		clonar(target, name, '.'+input);
	});
	$('.btn-clone-dual').on('click', function(event) {
		var btn    		= $(this);
		var target 		= btn.data('target');
		var input   	= btn.data('input');
		var name		= btn.data('name');
		clonar(target, name, '.'+input);
	});
	$(document).on('click','.dimiss-cloned', function(event) {
		removeCloned($(this));
	});
	$('.preview').on('click', function(event) {
		$('.map').html($('.map-input').val());
	});
	$('.send-change-pass').on('click', function(event) {
		$('.listErrors').remove();
		var btn = $(this);
		var proceed;
		proceed = validate();
		if ($('.password_confirmation').val() != $('.password').val()) {
			activeteStatus($('.password_confirmation'),'.control-label','.label-control-danger','has-success','has-error');
			addHtml($('.password_confirmation'),'.label-control-danger','Las contraseñas no coinciden.');
			proceed = 0;
		};
		
		if (proceed == 1) {
			var dataPost = {
				user_id : btn.val(),
				password: $('.password').val(),
				password_confirmation: $('.password_confirmation').val(),
			}
			doAjax(btn.data('url'), 'POST', 'json', dataPost, btn, startAjax, changePassSuccess, ajaxError);
		};
	});
	$('.show-pub-info').on('click', function(event) {
		removeResponseAjax();
		$('.partial-container').html('');
		var btn = $(this);
		var dataPost = {
			id : $(this).val()
		}
		$('#showItemInfo').modal('show');
		doAjax(getRootUrl()+'/administracion/publicaciones/cargar-detalles', 'GET', 'html', dataPost, btn, startAjax, loadContent, ajaxError);
	});
	$('.show-item-info').on('click', function(event) {
		removeResponseAjax();
		$('.partial-container').html('');
		var btn = $(this);
		var dataPost = {
			id : $(this).val()
		}
		$('#showItemInfo').modal('show');
		doAjax(getRootUrl()+'/administracion/publicaciones/cargar-detalles', 'GET', 'html', dataPost, btn, startAjax, loadContent, ajaxError);
	});
	$('.course-select').on('change', function(event) {
		removeResponseAjax();
		$('.partial-container').html('');
		var btn = $(this);
		var dataPost = {
			id : $(this).val()
		}
		$('#showItemInfo').modal('show');
		doAjax(getRootUrl()+'/administracion/inscripcion/cargar-horarios', 'GET', 'html', dataPost, btn, startAjax, loadContent, ajaxError);
	});
	/***************************/
	/***                     ***/
	/***      Ajax Elim      ***/
	/***                     ***/
	/***************************/
	$('.btn-elim-user').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Usuario');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-cat').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Categoría');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-misc').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Caracteristica');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-image').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar imagen');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-publication').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar publicación');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-slide').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Slide');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-article').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Articulo');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-reject-modal').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {
			store_id : btn.val(),
			motivo   : $('.motivo').val()
		};
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
	$('.btn-elim-thing-modal').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {};
		dataPost[btn.data('tosend')] = btn.val();
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
	$('#elimThing').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-thing-modal');
	});
	$('.modal').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-thing-modal');
	});
});