loadImage();
function loadImage()
{
    var asset_id = $("#asset_id").val();
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url : MEDIAFILE,
        type: "POST",
        data : {asset_id : asset_id, _token : token },
        success : function(data)
        {
            $('#dropzone-previews').html(data.output);

            $('.remove_image').hide()
        }
    });
}
