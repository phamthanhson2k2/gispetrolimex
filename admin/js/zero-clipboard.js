// JavaScript Document .btn-primary:hover
$(document).ready(function(e) {
    ZeroClipboard.config({
    	hoverClass: 'btn-primary-hover'
	})
	var client = new ZeroClipboard($('#btn-copy'));
	client.on('ready', function( readyEvent ) {
		
		client.on( 'copy', function(event) {
			event.clipboardData.setData('text/plain', $('#txt-img-url').val());
		} );
		
		client.on( 'aftercopy', function( event ) {
			console.log('Copied text to clipboard: ' + event.data['text/plain']);
		} );
	} );
	
	client.on( 'error', function(event) {
		console.log( 'ZeroClipboard error of type "' + event.name + '": ' + event.message );
		ZeroClipboard.destroy();
	});
});