// JavaScript Document
$(document).ready(function(e) {
    $('#cmb-congty').change(function(e) {
        if($('#btn-submit').text()=='Thêm')
			window.location = 'home.php?m=price&act=lst&cid='+$(this).val();
    });
	
	$('.act-edit').click(function(e) {
        e.preventDefault();
		$('#tbl-list tr').removeClass('active-row');
		$(this).closest('tr').addClass('active-row');

		$('#txt-ngayban').val($(this).closest('tr').find('td:eq(3)').text());
		$('#txt-price').val($(this).closest('tr').find('td:eq(5)').text());
		
		$('#cmb-congty').val($(this).attr('cid'));
		$('#cmb-loai').val($(this).attr('lid'));
		
		$('#btn-submit').text('Cập nhật');
		$('#btn-cancel').prop('disabled', false);
		$('#btn-cancel').attr('temp', $('#frm').attr('action'));
		$('#frm').attr('action', $(this).attr('href'));
    });
	
	$('#btn-cancel').click(function(e) {
		$('#tbl-list tr').removeClass('active-row');
        $('#txt-name').val('');
		$('#txt-dvt').val('');
		
		$('#cmb-congty').val(getParameterByName('cid'));
		$('#cmb-loai').val(getParameterByName('lid'));
		$('#btn-submit').text('Thêm');
		$('#btn-cancel').prop('disabled', true);
		$('#frm').attr('action', $(this).attr('temp'));
    });
	
	$('.act-del').click(function(e) {
        e.preventDefault();
		showConfirm('Xác Nhận', 'Bạn chắc muốn xóa thông tin giá bán <b>'+$(this).closest('tr').find('td:eq(2)').text()+'</b> không?', 'actDel(\''+$(this).attr('href')+'\')');
    });
});

function chk(){
	var price = $('#txt-price');
	var ngay = $('#txt-ngayban');
	var cty = $('#cmb-congty');
	var loai = $('#cmb-loai');
	
	if(cty.val() == 0){
		cty.parent().addClass('has-error');
		var e1= true;
	}else{
		cty.parent().removeClass('has-error');
		var e1= false;
	}
	
	if(loai.val() == 0){
		loai.parent().addClass('has-error');
		var e2= true;
	}else{
		loai.parent().removeClass('has-error');
		var e2= false;
	}
	
	if(ngay.val() == ''){
		ngay.parent().addClass('has-error');
		var e3= true;
	}else{
		ngay.parent().removeClass('has-error');
		var e3= false;
	}
	
	if(price.val() == ''){
		price.parent().addClass('has-error');
		var e4= true;
	}else{
		price.parent().removeClass('has-error');
		var e4= false;
	}
	return !e1 && !e2 && !e3&& !e4;
}

function actDel(url){
	window.location = url;
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? 0 : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function(e) {
    $('#txt-img').change(function(e) {
		var fname = $('#txt-file-name');
		if($(this).val() == '')
			fname.val('');
		else{
			var names = $.map($(this)[0].files, function(val) { return val.name; });
			fname.val(names.join(', '));
		}
	});
});

function openFolder(){
	$('#txt-img').click();
}