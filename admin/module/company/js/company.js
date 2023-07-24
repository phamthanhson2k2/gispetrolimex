// JavaScript Document
$(document).ready(function(e) {
    $('#cmb-parent').change(function(e) {
        if($('#btn-submit').text()=='Thêm')
			window.location = 'home.php?m=campany&act=lst&pid='+$(this).val();
    });
	
	$('.act-edit').click(function(e) {
        e.preventDefault();
		$('#tbl-list tr').removeClass('active-row');
		$(this).closest('tr').addClass('active-row');
		$('#txt-name').val($(this).closest('tr').find('td:eq(1)').text());
		
		$('#txt-add').val($(this).closest('tr').find('td:eq(2)').text());
		$('#txt-phone').val($(this).closest('tr').find('td:eq(3)').text());
		$('#txt-email').val($(this).closest('tr').find('td:eq(4)').text());
		$('#txt-tax').val($(this).closest('tr').find('td:eq(5)').text());
		$('#txt-file-name').val($(this).closest('tr').find('td:eq(6)').text());
		$('#txt-img-edit').val($(this).closest('tr').find('td:eq(6)').text()); // Lấy link để so sánh khi chỉnh sửa có thay đổi ảnh không
		
		$('#cmb-parent').val($(this).attr('pid'));
		$('#btn-submit').text('Cập nhật');
		$('#btn-cancel').prop('disabled', false);
		$('#btn-cancel').attr('temp', $('#frm').attr('action'));
		$('#frm').attr('action', $(this).attr('href'));
    });
	
	$('#btn-cancel').click(function(e) {
		$('#tbl-list tr').removeClass('active-row');
        $('#txt-name').val('');
		
		$('#txt-add').val('');
		$('#txt-phone').val('');
		$('#txt-email').val('');
		$('#txt-tax').val('');
		$('#txt-file-name').val('');
		$('#txt-img-edit').val('');
		
		$('#cmb-parent').val(getParameterByName('pid'));
		$('#btn-submit').text('Thêm');
		$('#btn-cancel').prop('disabled', true);
		$('#frm').attr('action', $(this).attr('temp'));
    });
	
	$('.act-del').click(function(e) {
        e.preventDefault();
		showConfirm('Xác Nhận', 'Bạn chắc muốn xóa danh mục <b>'+$(this).closest('tr').find('td:eq(1)').text()+'</b> không?', 'actDel(\''+$(this).attr('href')+'\')');
    });
});

function chk(){
	var name = $('#txt-name');
	var add = $('#txt-add');
	var phone = $('#txt-phone');
	var email = $('#txt-email');
	var tax = $('#txt-tax');
	var img = $('#txt-img');
	var img_edit = $('#txt-img-edit');
	
	if(name.val() == ''){
		name.parent().addClass('has-error');
		var e1= true;
	}else{
		name.parent().removeClass('has-error');
		var e1= false;
	}
	
	if(add.val() == ''){
		add.parent().addClass('has-error');
		var e2= true;
	}else{
		add.parent().removeClass('has-error');
		var e2= false;
	}
	
	if(phone.val() == ''){
		phone.parent().addClass('has-error');
		var e3= true;
	}else{
		phone.parent().removeClass('has-error');
		var e3= false;
	}
	
	if(email.val() == ''){
		email.parent().addClass('has-error');
		var e4= true;
	}else{
		email.parent().removeClass('has-error');
		var e4= false;
	}
	
	if(tax.val() == ''){
		tax.parent().addClass('has-error');
		var e5= true;
	}else{
		tax.parent().removeClass('has-error');
		var e5= false;
	}
	
	if(img.val() == '' && img_edit.val() == ''){
		img.parent().addClass('has-error');
		var e6= true;
	}else{
		img.parent().removeClass('has-error');
		var e6= false;
	}
	
	return !e1 && !e2 && !e3 && !e4 && !e5 && !e6 ;
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