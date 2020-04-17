// on select image 
$(document).on("change",".choose-image", function(){
	var img=this;
	upload_image(img);
	if($(this).data('iddoctor')=='1'){
            remove_active();
        }
});
// end
	
// call for upload image 
function upload_image(img){
	var ID=$(img).attr('table-id');
	var show_image_src=$(img).attr('show-image-src');
	var show_image_href=$(img).attr('show-image-href');
	var login_profile_img=$(img).attr('login-profile-img');
	
	if(image_vaildation(img)){
		if (img.files && img.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				if(show_image_src && show_image_src!=''){
					$(show_image_src).attr('src', e.target.result);
				}
				
				if(show_image_href && show_image_href!=''){
					$(show_image_href).attr('href', e.target.result);
				}
				
				if(ID && ID!=''){ 
					var url=$(img).attr('action');
					var fileInputboxName=$(img).attr('name');				
					var file_data = img.files[0];   
					var form_data = new FormData();                  
					form_data.append('ID', ID);
					form_data.append('login_profile_image', login_profile_img);
					form_data.append('fileInputboxName', fileInputboxName);
					form_data.append(fileInputboxName, file_data);
											
					$.ajax({
						url: url,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(result){ //console.log(result);
							if(result!=''){
								var src=BASE_URL+result;
								return src;
							}
						}
					});
				}	
			}
			reader.readAsDataURL(img.files[0]);
		}	
	}
}
// end

// for check vaildation	
function image_vaildation(files=''){
	var id=files.id; 
	var file = files.files[0];//get file 
	
	if(!file){
		var error=" Please select Image.";
		$('#'+id).next('span').show().children('i').css('font-size','14px').html('<span id="'+id+'" class="invalid">'+error+'</span>');
		return false;
	}
	
	var accept_min=($(files).data('min-size'))?$(files).data('min-size'):"10";
	var accept_max=($(files).data('max-size'))?$(files).data('max-size'):"10000";
	var validExtensions=$(files).attr('accept');
	validExtensions=(validExtensions)?(validExtensions.trim().split(',')):['.jpg','.jpeg','.png'];
	
	var fileName = file.name;
	var fileNameExt = "."+fileName.substr(fileName.lastIndexOf('.') + 1);
	var sizeKB = (file.size / 1024).toFixed(3);
	var width =file.width;
	var height =file.height;
	
	if ($.inArray(fileNameExt, validExtensions) == -1){
		var error=" Image should be in "+validExtensions.toString()+" format.";
		$('#'+id).next('span').show().children('i').css('font-size','14px').html('<span id="'+id+'" class="invalid">'+error+'</span>');
		$(files).val('');
		return false;
	} 
	
	if (sizeKB < accept_min){ 
		var error=" Image should be in minimum size "+accept_min+" KB.";
		$('#'+id).next('span').show().children('i').css('font-size','14px').html('<span id="'+id+'" class="invalid">'+error+'</span>');
		$(files).val('');
		return false;
	}
	
	if(sizeKB > parseFloat(accept_max)){
		var error=" Image should be in maximum size "+accept_max+" KB.";
		$('#'+id).next('span').show().children('i').css('font-size','14px').html('<span id="'+id+'" class="invalid">'+error+'</span>');
		$(files).val('');
		return false;
	}
	
	$('#'+id).next('span').hide().children('i').html('');
	return true;
}
// end