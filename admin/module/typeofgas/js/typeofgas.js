// JavaScript Document
$(document).ready(function(e) {
    $('#cmb-parent').change(function(e) {
        if($('#btn-submit').text()=='Thêm')
			window.location = 'home.php?m=typeofgas&act=lst&tid='+$(this).val();
    });
	
	$('.act-edit').click(function(e) {
        e.preventDefault();
		$('#tbl-list tr').removeClass('active-row');
		$(this).closest('tr').addClass('active-row');
		
		$('#txt-name').val($(this).closest('tr').find('td:eq(1)').text());
		$('#txt-dvt').val($(this).closest('tr').find('td:eq(2)').text());
		
		$('#cmb-parent').val($(this).attr('tid'));
		$('#btn-submit').text('Cập nhật');
		$('#btn-cancel').prop('disabled', false);
		$('#btn-cancel').attr('temp', $('#frm').attr('action'));
		$('#frm').attr('action', $(this).attr('href'));
    });
	
	$('#btn-cancel').click(function(e) {
		$('#tbl-list tr').removeClass('active-row');
        $('#txt-name').val('');
		$('#txt-dvt').val('');
		
		$('#cmb-parent').val(getParameterByName('tid'));
		$('#btn-submit').text('Thêm');
		$('#btn-cancel').prop('disabled', true);
		$('#frm').attr('action', $(this).attr('temp'));
    });
	
	$('.act-del').click(function(e) {
        e.preventDefault();
		showConfirm('Xác Nhận', 'Bạn chắc muốn xóa loại xăng dầu <b>'+$(this).closest('tr').find('td:eq(1)').text()+'</b> không?', 'actDel(\''+$(this).attr('href')+'\')');
    });
});

function chk(){
	var name = $('#txt-name');
	var dvt = $('#txt-dvt');
	var tram = $('#cmb-parent');
	
	if(name.val() == ''){
		name.parent().addClass('has-error');
		var e1= true;
	}else{
		name.parent().removeClass('has-error');
		var e1= false;
	}
	
	if(dvt.val() == ''){
		dvt.parent().addClass('has-error');
		var e2= true;
	}else{
		dvt.parent().removeClass('has-error');
		var e2= false;
	}
	
	if(tram.val() == 0){
		tram.parent().addClass('has-error');
		var e3= true;
	}else{
		tram.parent().removeClass('has-error');
		var e3= false;
	}
	return !e1 && !e2 && !e3;
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