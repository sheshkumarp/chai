$(document).ready(function () {
      $('input[name="phone"]').mask('999-999-9999');
      $('input[name="first_name"]').focus();
})


$('#facultyMemberForm').validator().on('submit', function (e) {
      if (!e.isDefaultPrevented()) {
            const $this = $(this);
            const action = $this.attr('action');
            const formData = new FormData($this[0]);
            formData.append('about_lecture', editor.getData());

            $('.card').LoadingOverlay("show", {
                  background: "rgba(165, 190, 100, 0.4)",
            });

            axios.post(action,formData)
            .then(function (response) 
            {
                  const resp =  response.data;

            if (resp.status == 'success') 
            {
                  $this[0].reset();
                  toastr.success(resp.msg);
                  $('.card').LoadingOverlay("hide");
                  setTimeout(function()
                  {
                        window.location.href= resp.url;
                  }, 2000)
            }

            if (resp.status == 'error') 
            {
                  $('.card').LoadingOverlay("hide");
                  toastr.error(resp.msg);
            }
            })
            .catch(function (error) 
            {
              $('.card').LoadingOverlay("hide");

              const errorBag = error.response.data.errors;

              $.each(errorBag, function(fieldName, value) 
              {
                  $('.err_'+fieldName).closest('.form-group').addClass('has-error has-danger'); 
                  $('.err_'+fieldName).text(value[0]).closest('span').show(); 
              })
            });


            return false;
      }
})

$('input[type="file"]').change(function(e)
{
    var fileName = e.target.files[0].name;
    $(this).closest('.fileParentDiv').find('.file-upload-filename').html(fileName);
    $(this).closest('.fileParentDiv').find('.removefile').show();  
    $(this).closest('.fileParentDiv').find('.choosefile').hide(); 
})

function removeFile(element)
{
  $(element).closest('.fileParentDiv').find('input[type="file"]').val('');
  $(element).closest('.fileParentDiv').find('.file-upload-filename').html('No file Selected.');
  $(element).closest('.fileParentDiv').find('.removefile').hide();  
  $(element).closest('.fileParentDiv').find('.choosefile').show(); 
  $(element).closest('.fileParentDiv').find('.old_file').val(''); 
}


function addPracticeArea(element) 
{    
    $(element).hide();
    $(areaHtml).insertAfter($(".practiceInputParent:last"));
    $('.my-select').selectbox();
}

function togglePublication(element) {
      $this = $(element).closest('.parentDiv');

      if ($this.attr('id') == 'showPublicationDiv') {
            $('#hidePublicationDiv').show();
            $('#showPublicationDiv').hide();
      }

      if ($this.attr('id') == 'hidePublicationDiv') {
            $('#showPublicationDiv').show();
            $('#hidePublicationDiv').hide();
            $('textarea[name="publication"]').val('');
      }
}

function toggleEducation(element) {
      $this = $(element).closest('.parentDiv');

      if ($this.attr('id') == 'showEducationDiv') {
            $('#hideEducationDiv').show();
            $('#showEducationDiv').hide();
      }

      if ($this.attr('id') == 'hideEducationDiv') {
            $('#showEducationDiv').show();
            $('#hideEducationDiv').hide();
            $('textarea[name="education"]').val('');
      }
}

