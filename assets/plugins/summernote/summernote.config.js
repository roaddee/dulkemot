// Added by CI Bootstrap 3
$(function(){
	$('textarea.texteditor').summernote({
		height: 400,
		onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0], editor, welEditable);
		}
	});
	$('textarea.mini-texteditor').summernote({
		height: 200,
		onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0], editor, welEditable);
		}
	});
	
});
function sendFile(file, editor, welEditable) {
		data = new FormData();
		data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
		$.ajax({
				data: data,
				type: "POST",
				url: '/assets/actions/siteman_upload_summernote.php',
				cache: false,
				contentType: false,
				processData: false,
				success: function(url) {
						editor.insertImage(welEditable, url);
				}
		});
}

function progressHandlingFunction(e){
    if(e.lengthComputable){
        $('progress').attr({value:e.loaded, max:e.total});
        // reset progress on complete
        if (e.loaded == e.total) {
            $('progress').attr('value','0.0');
        }
    }
}
