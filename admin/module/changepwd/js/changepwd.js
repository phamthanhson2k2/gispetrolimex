// JavaScript Document
function chkAccUpdate(){
	var fname = $('#txt-fullname');
	var email = $('#txt-email');
	if(fname.val() == ''){
		fname.parent().parent().addClass('has-error');
		var e1 = true;
	}else{
		fname.parent().parent().removeClass('has-error');
		var e1 = false;
	}
	
	if(email.val() == ''){
		email.parent().parent().addClass('has-error');
		var e2 = true;
	}else{
		email.parent().parent().removeClass('has-error');
		var e2 = false;
	}
	
	return !e1 && !e2;
}

function chkAccPass(){
	var cupass = $('#txt-cur-pass');
	var nepass = $('#txt-new-pass');
	var repass = $('#txt-renew-pass');
	if(cupass.val() == ''){
		cupass.parent().parent().addClass('has-error');
		$cuError = true;
	}else{
		cupass.parent().parent().removeClass('has-error');
		$cuError = false;
	}
	
	if(nepass.val() == ''){
		nepass.parent().parent().addClass('has-error');
		$neError = true;
	}else{
		nepass.parent().parent().removeClass('has-error');
		$neError = false;
	}
	
	if(repass.val() == ''){
		repass.parent().parent().addClass('has-error');
		$reError = true;
	}else{
		repass.parent().parent().removeClass('has-error');
		$reError = false;
	}
	
	if(!$cuError && !$neError && !$reError){
		if(nepass.val() != repass.val()){
			nepass.parent().parent().addClass('has-error');
			repass.parent().parent().addClass('has-error');
			return false;
		}else{
			nepass.parent().parent().removeClass('has-error');
			repass.parent().parent().removeClass('has-error');
			return true;
		}
	}else{
		return false;
	}
}