$(document).on('change','.select-other', function(){
	var self=this;	
	var selected = $('option:selected', this).attr('class');
	if(selected == "editable"){
		$(self).hide();
		$(self).parent().find('.editOption').show().focus();
	}
});

$(document).on('blur','.editOption', function(){
	var editText = $(this).val();
	if(editText!=''){
		$(this).parent().find('.editable').val(editText);
		$(this).parent().find('.editable').html(editText);
		$(this).hide().val('');
		$(this).parent().find('.editable').removeClass('editable');
		$(this).parent().find('.select-other').append("<option value='Other' class='editable'>Other</option>").show();
	}else{
		$(this).hide();
		$(this).parent().find('.select-other').show().val('');
	}		
});