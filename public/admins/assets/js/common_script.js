function PreviewImage() {
    var ext = $('#img-upload').val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $('#img-upload').val('');
            $('#upload_logo_error').html('gif , png , jpg , jpeg are allowed.');
    } else {
        $('#upload_logo_error').html('');
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img-upload").files[0]);
        oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    }
}