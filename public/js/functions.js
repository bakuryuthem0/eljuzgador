function getRootUrl () {
  return $('.baseUrl').val();
}
function activeteStatus (inp,toHidden,toShow,toRemove,toAdd) {
	inp.prevAll(toHidden).addClass('hidden');
	inp.prevAll(toShow).removeClass('hidden');
	inp.parent().removeClass(toRemove);
	inp.parent().addClass(toAdd);
	inp.nextAll('.form-control-feedback').addClass('active');
}
function startAjax (btn) {
	$('.miniLoader').addClass('active');
	btn.addClass('disabled').attr('disabled', true);
}
function endAjax (response, btn) {
	$('.miniLoader').removeClass('active');
	$('.responseAjax').addClass('alert-'+response.type).addClass('active');
}
function startIconAjax (btn) {
	btn.find('.fa').addClass('hidden');
	startAjax(btn);
}
function ajaxErrorWithIcon (btn) {
	btn.find('.fa-times').removeClass('hidden');
	ajaxError(btn);
}

function responseMsg(response)
{
	removeResponseAjax();
	$('.responseAjax').addClass('alert-'+response.type).addClass('active');
	if (typeof response.msg == "object") {
		$('.responseAjax').children('p').html('<ul class="listErrors"></ul>');
		$.each(response.msg, function(index, val) {
			$('.listErrors').append('<li>'+val+'</li>');
		});
	}else
	{
		$('.responseAjax').children('p').html(response.msg);
	}
}
function ajaxError (btn) {
	endAjax ({ type: 'danger'}, btn);
	btn.removeClass('disabled').attr('disabled', false);
	$('.responseAjax').children('p').html('Ups, ha habido un error.');
}
function addValToElim (toAdd, esto) {
	esto.addClass('to-elim');
	$(toAdd).val(esto.val()).attr('data-url',esto.data('url')).attr('data-tosend',esto.data('tosend'));
}
function closeModalElim (boton) {
	$('.to-elim').removeClass('to-elim');
	$(boton).removeClass('disabled').attr('disabled', false);
	removeResponseAjax();
}
function elimSuccess (response, btn) {
	endAjax(response, btn)
	responseMsg(response);
	if (response.type == 'danger') {
		btn.removeClass('disabled').attr('disabled', false);
	}else
	{
		$('.to-elim').parent().parent().remove();
	}
}
function loadContentWithIcon (response, btn) {
	btn.find('.fa-check').removeClass('hidden');
	loadContent(response, btn);
}
function loadContent (response, btn) {
	$('.miniLoader').removeClass('active');
	btn.removeClass('disabled').attr('disabled', false);
	$('.partial-container').html(response);
}
function login (response, btn) {
	endAjax(response, btn)
	$('.responseAjax').children('p').html(response.msg);

	if (response.type == 'danger') {
		btn.removeClass('disabled').attr('disabled',false);
	}else
	{
		btn.addClass('disabled').attr('disabled',true);
		setTimeout(function() {
			window.location.reload();	
		},2000);
	}
}
function changePassSuccess(response, btn) {
	endAjax(response, btn);
	responseMsg(response);
	if (response.type != 'danger') {
		$('.validate-input').val('');
	}
	btn.removeClass('disabled').attr('disabled', false);

}
function removeResponseAjax() {
	$('.responseAjax').removeClass('alert-success');
	$('.responseAjax').removeClass('alert-danger');
	$('.responseAjax').removeClass('active');

}
function checkEmpty(inp) {
	if (inp.val() == "") {
		activeteStatus(inp,'.control-label','.label-control-danger','has-success','has-error');
		return 0;
	}else
	{
		activeteStatus(inp,'.control-label','.label-control-success','has-error','has-success');
		return 1;
	}
}
function addHtml (inp,toShow,msg) {
	inp.prevAll('.control-label').addClass('hidden');
	inp.prevAll(toShow).removeClass('hidden').children('p').html(msg)
}
function emptyMsg (inp) {
	var proceed = checkEmpty(inp);
	if (proceed == 0) {
		addHtml(inp,'.label-control-danger','El campo es obligatorio');
	}else
	{
		addHtml(inp,'.label-control-success','Valido');

	}
	return proceed;
}
function validateEmail(inp) {

	var atpos = inp.val().indexOf("@");
    var dotpos = inp.val().lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=inp.val().length) {
        return false;
    }
	return true;
}
function validate() {
	var proceed = 1;
	$('.validate-input').each(function(index, el) {
		if ($(el).attr('type') == "text") {
			if (checkEmpty($(el)) == 0) {
				proceed = 0;
			}
		}else if($(el).attr('type') == "email")
		{
			if(checkEmpty($(el)) == 0 || validateEmail($(el)) == false)
			{
				proceed = 0;
			}
		}else if($(el).attr('type') == undefined)
		{
			if (checkEmpty($(el)) == 0) {
				proceed = 0;
			}
		}
	});
	return proceed;
}
function doAjax(url, method, dataType, dataPost, btn, beforeSendCallback, successCallback, errorCallback) {
	$.ajax({
		headers: {'csrftoken': $('input[name = _token]').val()},
		url: url,
		type: method,
		dataType: dataType,
		data: dataPost,
		beforeSend: function(){
			beforeSendCallback(btn)
		},
		success: function(response){
			successCallback(response, btn);
		},
		error: function(){
			errorCallback(btn)
		}
	});
}
function clonar(target, name, input) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active');
	toClone.children('div').children(input).attr('name',name);
	toClone.after(cloned);
}
function removeCloned(esto) {
	esto.parents('.to-clone').remove();
	if ($('.factura-item:not(.fac-to-clone)').length < 1) {
		$('.btn-process-fac').addClass('hidden');
	};
}
function imgPreview(evt, css, target) {
	var files = evt.target.files; // FileList object

	//Obtenemos la imagen del campo "file". 
	for (var i = 0, f; f = files[i]; i++) {         
	   //Solo admitimos imágenes.
	   if (!f.type.match('image.*')) {
	        continue;
	   }

	   var reader = new FileReader();
	   
	   	reader.onload = (function(theFile) {
	       return function(e) {
	       // Creamos la imagen.
	              target.html(['<img class="thumb ',css,'" src="', e.target.result,'" title="', $('.title').val(), '"/>'].join(''));
	       };
	   	})(f);

	   	reader.readAsDataURL(f);

	}
}
jQuery(document).ready(function($) {
	$('.contLoading').removeClass('active');
	$('.logMeIn').on('click', function(event) {
		var proceed = 1;
		$('.login-input').each(function(index, el) {
			if ($(el).val() == "") {
				proceed = 0;
			}
		});

		if (proceed == 1) {
			var btn = $(this);
			var dataPost = {
				'username' : $('.email').val(),
				'password' : $('.password').val(),
				'remember' : remember,
			}
			var remember;
			if ($('.remember:checked').length > 0) {
				remember = 1;
			}else
			{
				remember = 0;
			}	
			doAjax(btn.val(), 'POST', 'json', dataPost, btn, startAjax, login, ajaxError);
		};
	});
	$('.btn-send').on('click', function(event) {
		if (validate()) {
			$('form').submit();
		}
	});
});