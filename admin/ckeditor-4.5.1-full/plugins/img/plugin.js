
CKEDITOR.plugins.add('img', {
	init: function(editor){
		editor.addCommand('imgDialog', new CKEDITOR.dialogCommand('imgDialog'));
		editor.ui.addButton('Image', {
			label: 'Insert an image',
			command: 'imgDialog',
			icon: 'ckeditor-4.5.1-full/plugins/img/images/icon.png'
		});
	}
});

CKEDITOR.dialog.add( 'imgDialog', function( editor ){
	return {
		title : 'Image Properties',
		minWidth : 400,
		minHeight : 200,
		contents :
		[
			{
				id : 'general',
				label : 'Settings',
				elements :
				[
				 	{
						type:'text',
						id:'url',
						label:'URL',
						validate : CKEDITOR.dialog.validate.notEmpty('The URL Text field cannot be empty.' ),
						required : true,
						commit : function( data )
						{
							data.url = this.getValue();
						}
					},
					{
						type:'button',
						id:'btn-sel',
						label:'Choice image',
						onClick : function(data)
						{
							var d = this.getDialog();
							$cke_txt_img_id = d.getContentElement('general','url')['_']['inputId'];
							console.log($cke_txt_img_id);
							$('#galleryModal').modal('show');
							
						}
					},
					{
						type:'text',
						id:'alt',
						label:'Alternative Text',
						required : false,
						commit : function( data )
						{
							data.alt = this.getValue();
						}
					}
				]
			}
		],
		onOk : function(){
			var dialog = this,
				data = {},
				img = editor.document.createElement('img');
				this.commitContent(data);
				img.setAttribute('src', data.url);
				img.setAttribute('alt', data.alt);
				img.setHtml( data.contents);
				editor.insertElement(img);
		}
	};
});