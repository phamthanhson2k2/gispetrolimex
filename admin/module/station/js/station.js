// JavaScript Document
$(document).ready(function(e) {	
	$('#txt-title').on('input propertychange paste', function() {
   		$('#txt-url').val(removeSign($(this).val()));
	});
	
	$('#galleryModal').on('shown.bs.modal', function(e) {
		if($(e.relatedTarget).is('#set-feature'))
			var fn = 'onOk(0)';//anh dai dien
		else
			var fn = 'onOk(1)';//cke picture
			
		$('#btn-modal-ok').attr('onclick', fn);
		var iframe = $(this).find('iframe');
		if(iframe.attr('src') == '')
			iframe.attr('src','gallery-compactsp.php');
	});
	
	$('#confirmModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var whatever = button.data('whatever');
		var identify = button.data('id');
		var page = button.data('page');
		var modal = $(this);
		modal.find('.modal-body span').text(whatever);
		modal.find('.modal-body #modal-nid').val(identify);
		modal.find('.modal-body #modal-page').val(page);
	});
	
	$('#clr-feature').click(function(e) {
        $('#img-feature').attr('src', '');
		$('#img-feature').removeClass('img-responsive');
		$('#clr-feature').addClass('hide');
		$('#set-feature').removeClass('hide');
		$('#txt-feature-img').val('');
    });
	
	if($('#img-feature').attr('src') != ''){
		$('#clr-feature').removeClass('hide');
		$('#set-feature').addClass('hide');
	}else{
		$('#clr-feature').addClass('hide');
		$('#set-feature').removeClass('hide');
	}
});
function onDel(tid, page){
	showConfirm('Xác nhận', 'Bạn có chắc muốn xóa Trạm bán lẻ này không?', 'actDel('+tid+', '+page+')');
}

function actDel(tid, page){
	window.location = 'home.php?m=station&act=delete&tid='+tid+'&page='+page;
}
function onOk(which){
	if(which == 0){
		var path = $('#iframe').contents().find('#txt-img-path').val();
		if(path != ''){
			$('#img-feature').addClass('img-responsive');
			$('#img-feature').attr('src', path);
			$('#clr-feature').removeClass('hide');
			$('#set-feature').addClass('hide');
			$('#txt-feature-img').val(path.replace('../gallerysp/','gallerysp/'));
		}
	}
	else{
		var path = $('#iframe').contents().find('#txt-img-path').val();
		if(path != ''){
			var url = path.replace('../gallerysp/','gallerysp/');
			$('#'+$cke_txt_img_id).val(url);
		}
	}
}
function getBaseUrl(){
	var baseUrl = window.location.origin+'/';
	var pathArray = window.location.pathname.split( '/' );
	var len = pathArray.length;
	if(len > 2){
		for(var i = 0; i < len - 2; i++){
			if(pathArray[i] != '')
				baseUrl += pathArray[i] + '/';
		}
	}
	return baseUrl;
}


$(document).ready(function(e) {	
	/*$("#provine").change(function(event){
		matp = $("#provine").val();
		$.post('module/combobox/index.php', {"matp":matp}, function(data){
			$("#district").html(data);
		});	
	});
	
	$("#district").change(function(event){
		maqh = $("#district").val();
		$.post('module/station/index.php', {"maqh":maqh}, function(data){
			$("#ward").html(data);
		});	
	});*/
	
	$("#district").change(function(event){
		maqh = $("#district").val();
		$.post('module/station/index.php', {"maqh":maqh}, function(data){
			$("#ward").html(data);
		});	
	});
	
});

function chkEditArticle(){
	var tentram = $('#txt-tentram');
	var phone = $('#txt-phone');
	var add = $('#txt-add');
	var district = $('#district');
	var ward = $('#ward');
	var kinhdo = $('#latitude');
	var vido = $('#longitude');
	
	
	
	if(tentram.val() == ''){
		tentram.parent().addClass('has-error');
		var e1= true;
	}else{
		tentram.parent().removeClass('has-error');
		var e1= false;
	}
	
	if(phone.val() == ''){
		phone.parent().addClass('has-error');
		var e2= true;
	}else{
		phone.parent().removeClass('has-error');
		var e2= false;
	}
	
	if(add.val() == ''){
		add.parent().addClass('has-error');
		var e3= true;
	}else{
		add.parent().removeClass('has-error');
		var e3= false;
	}
	
	if(district.val() == 0){
		district.parent().addClass('has-error');
		var e4= true;
	}else{
		district.parent().removeClass('has-error');
		var e4= false;
	}
	
	if(ward.val() == 0){
		ward.parent().addClass('has-error');
		var e5= true;
	}else{
		ward.parent().removeClass('has-error');
		var e5= false;
	}
	
	if(kinhdo.val() == ''){
		kinhdo.parent().addClass('has-error');
		var e6= true;
	}else{
		kinhdo.parent().removeClass('has-error');
		var e6= false;
	}
	
	if(vido.val() == ''){
		vido.parent().addClass('has-error');
		var e7= true;
	}else{
		vido.parent().removeClass('has-error');
		var e7= false;
	}
	
	
	return !e1 && !e2&& !e3&& !e4&& !e5&& !e6&& !e7 ;
}
