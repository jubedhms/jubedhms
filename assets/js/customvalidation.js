$(document).ready(function() {
    $(".MyForm").validate({
        errorClass: 'invalid',
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.insertAfter(element.next('span').children());
        },
        highlight: function(element) {
            $(element).next('span').show();
			//$(element).closest('.form-control').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).next('span').hide();
			//$(element).closest('.form-control').removeClass('has-error');
        }
    });
 });

 
$(".next").click(function() {
        $(".MyForm").validate({ 
            errorClass: 'invalid',
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.insertAfter(element.next('span').children());
            },
            highlight: function(element) {
                $(element).next('span').show();
            },
            unhighlight: function(element) {
                $(element).next('span').hide();
            }
        });
        if ((!$('.MyForm').valid())) {
            return true;
        }
 });
  

//for check signin exist user
jQuery.validator.addMethod("checkExistEmpUsername", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistEmpUsername",
		data: {user_name: value},
		success: function(result) {response=result;}  
	});
	
	if(response== true || response== 'true'){return true;}
	else{return false;}
}, 'Username has been not registered.');
//end

//for check on create new user existed or not
jQuery.validator.addMethod("checkNotExistEmpUsername", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistEmpUsername",
		data: {user_name: value},
		success: function(result) { response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Username has been registered already.');
//end

//for check for update exist Doctor MCR
jQuery.validator.addMethod("checkExistDoctorMCR", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistDoctorMCR",
		data: {doctor_mcr: value},
		success: function(result) { response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Patient PNR has been not registered.');
// end 

//for check for update exist patient PNR
jQuery.validator.addMethod("checkExistPatientPRN", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistPatientPRN",
		data: {patient_prn: value},
		success: function(result) {response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Patient PNR has been not registered.');
// end  

jQuery.validator.addMethod("first_name", function(value, element) {
  return this.optional( element ) || /^[A-Za-z]+$/.test( value );
}, 'First Name should be in Letters.');

jQuery.validator.addMethod("middle_name", function(value, element) {
  return this.optional( element ) || /^[A-Za-z]+$/.test( value );
}, 'Last Name should be in Letters.');

jQuery.validator.addMethod("last_name", function(value, element) {
  return this.optional( element ) || /^[A-Za-z]+$/.test( value );
}, 'Last Name should be in Letters.');



// for retail shop

//for check on create special offer ID
jQuery.validator.addMethod("checkExistOfferID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistSpecialOfferID",
		data: {offer_id: value},
		success: function(result) {response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Offer ID has been registered already.');
// end 

//for check on update special offer ID
jQuery.validator.addMethod("checkSecondExistOfferID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkSecondExistSpecialOfferID",
		data: {ID:$('#ID').val(),offer_id: value},
		success: function(result) {response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Offer ID has been registered already.');
// end 

//for check on create product ID
jQuery.validator.addMethod("checkExistProductID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistProductID",
		data: {product_id: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Product ID has been registered already.');
// end 

//for check on update product ID
jQuery.validator.addMethod("checkSecondExistProductID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkSecondExistProductID",
		data: {ID:$('#ID').val(),product_id: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Product ID has been registered already.');
// end

//for check on create service ID
jQuery.validator.addMethod("checkExistServiceID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistServiceID",
		data: {service_id: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Service ID has been registered already.');
// end 

//for check on update service ID
jQuery.validator.addMethod("checkSecondExistServiceID", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkSecondExistServiceID",
		data: {ID:$('#ID').val(),service_id: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Service ID has been registered already.');
// end

//for check on create Food Beverage Code
jQuery.validator.addMethod("checkExistFoodBeverageCode", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkExistFoodBeverageCode",
		data: {item_code: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Item Code has been registered already.');
// end 

//for check on update Food Beverage Code
jQuery.validator.addMethod("checkSecondFoodBeverageCode", function(value, element) {
	var response=false;
	$.ajax({
		'async': false,
		type: "POST",
		url: AJAX_URL+"checkSecondFoodBeverageCode",
		data: {ID:$('#ID').val(),item_code: value},
		success: function(result){response=result;}  
	});
	
	if(response== true || response== 'true'){return false;}
	else{return true;}
}, 'Item Code has been registered already.');
// end


// end