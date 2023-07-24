// JavaScript Document
$(document).ready(function(e) {
    $('#mymodal').on('shown.bs.modal', function (e) {
		var modal = $(this)
		modal.find('.modal-footer .btn-primary').focus();
	})
});

function showAlert(title, msg){
	$('#modal-title').html(title);
	$('#modal-body').html(msg);
	$('#modal-footer').addClass('text-center');
	$('#modal-footer').html('<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id="btn-commit">Đồng ý</button>');
	$('#mymodal').modal('show');
}

function showConfirm(title, msg, yfunc, nfunc){
	$('#modal-title').html(title);
	$('#modal-body').html(msg);
	$('#modal-footer').removeClass('text-center');
	$('#modal-footer').html('<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="'+nfunc+'">Không</button> <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id="btn-commit" onclick="'+yfunc+'">Có</button>');
	$('#mymodal').modal('show');
}