

$(document).ready(function(){
    $('#acquisition_date').datepicker({format: 'mm/dd/yyyy', autoclose: true});
    $('#inventory_confirmation_date').datepicker({format: 'mm/dd/yyyy', autoclose: true});
    $('#disposal_date').datepicker({format: 'mm/dd/yyyy', autoclose: true});
})


Dropzone.autoDiscover = false;

let token = $('meta[name="csrf-token"]').attr('content');

$(function() 
{
    var myDropzone = new Dropzone("div#dropzoneDragArea", 
    { 
        paramName: "file",
        url: UPLOADFILE,
        previewsContainer: 'div.dropzone-previews',
        acceptedFiles: '.jpg,.jpeg,.png',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 4,
        maxFiles: 4,
        params: {
            _token: token
        },
        init: function() {
            var myDropzone = this;

            $("#formdata").submit(function(event) {

                $('#formdata').LoadingOverlay("show", {
                    background: "rgba(165, 190, 100, 0.4)",
                });

                event.preventDefault();

                const $this     = $(this);
                const URL       = $this.attr('action');
                const formData  = new FormData($this[0]);

                // URL = $("#formdata").attr('action');
                // formData = $('#formdata').serialize();

                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: formData,
                    processData: false,     
                    contentType: false,     
                    cache: false,
                    success: function(result){
                        if(result.status == "success")
                        {
                            const resp = result;

                            if (resp.status == 'success') 
                            {
                                $('#asset_id').val(result.asset_id);
                        
                                myDropzone.processQueue();

                                $('#formdata')[0].reset();

                                toastr.success(resp.msg);
                                
                                $('#formdata').LoadingOverlay("hide");

                                setTimeout(function () 
                                {
                                    window.location.href = resp.url;
                                }, 2000)
                            }
                            if (resp.status == 'error') 
                            {
                                $('#formdata').LoadingOverlay("hide");
                                toastr.error(resp.msg);
                            }
                        }
                    },
                    error : function (result) 
                    {
                        $('#formdata').LoadingOverlay("hide");
                        
                        const errorBag = result.responseJSON.errors;

                        $.each(errorBag, function (fieldName, value) 
                        {
                            $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                            $('.err_' + fieldName).text(value[0]).closest('span').show();
                        })
                    }
                });
            });
            
            this.on("success", function (file, response) 
            {
                $('#formdata')[0].reset();
                $('.dropzone-previews').empty();
            });

            this.on("queuecomplete", function () {
            
            });
            
            this.on("sendingmultiple", function(file, xhr, formData) 
            {
                let asset_id = document.getElementById('asset_id').value;
                formData.append('asset_id', asset_id);
            });

        }
    });
});

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
        }
    });
}

$(document).on('click', '.remove_image', function()
{
    let imageId = $(this).attr('id');
    let token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : REMOVEFILE,
        type : "POST",
        data : {encID : imageId, _token : token},
        success : function (data)
        {
            loadImage();
        }

    });

});

function getUsd(element)
{
    var currency = parseFloat($(element).val());

    $('.err_acquisition_cost_local').closest('div').removeClass('has-error has-danger');
    $('.err_acquisition_cost_local').html('');

    if (isNaN(currency)) 
    {
        $('.err_acquisition_cost_local').closest('div').addClass('has-error has-danger');
        $('.err_acquisition_cost_local').html('Please enter valid number');
    }
    else
    {

        var requestURL = 'https://api.exchangerate-api.com/v4/latest/USD';
        var request = new XMLHttpRequest();
        request.open('GET', requestURL);
        request.responseType = 'json';
        request.send();

        request.onload = function() {

            let cdf = request.response.rates.CDF;

            let converted = currency/cdf;
            // console.log(converted);

            $("#acquisition_cost_usd").val((converted).toFixed(2));     
        }
    }

    // $('.err_acquisition_cost_local').closest('div').removeClass('has-error has-danger');
    // $('.err_acquisition_cost_local').html('');

    // if (isNaN(currency)) 
    // {
    //     $('.err_acquisition_cost_local').closest('div').addClass('has-error has-danger');
    //     $('.err_acquisition_cost_local').html('Please enter valid number');
    // }
    // else
    // {

    //     let token = $('meta[name="csrf-token"]').attr('content');
    //     let MONEYCONVERTURL = `${BASEURL}/convertmoney`;

    //     $.ajax({
    //         url : MONEYCONVERTURL,
    //         type: "POST",
    //         data : {currency : currency, _token : token },
    //         success : function(data)
    //         {   
    //             $("#acquisition_cost_usd").val(data.output)
    //         }
    //     });
    // }
}