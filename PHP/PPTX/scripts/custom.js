$('document').ready(function(){
	$('#fileInput').change(function(){
		UploadedFileCheck();
	});
});
function UploadedFileCheck()
{
	var selectedFileName=$('#fileInput').val().split('\\');
	if(selectedFileName != null)
	{
		var uploadedFileType=selectedFileName[2].split('.');
		if(uploadedFileType[1]!=null && uploadedFileType[1].trim()!="" && (uploadedFileType[1].toLowerCase()=="pptx" || uploadedFileType[1].toLowerCase()=="pptx"))
		{
			$('#format').val(uploadedFileType[1].toLowerCase());
			$('#submitButton').attr('disabled',false);
			$('#errorDiv').css('display','none');
		}
		else
		{
			$('#errorDiv').css('display','block');
			$('#submitButton').attr('disabled',true);
		}
	}
}