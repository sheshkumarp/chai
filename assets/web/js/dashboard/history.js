$(document).ready(function () 
{
  getTodoHistory('');

  $('#selectUser').on('change', function() {
      getTodoHistory(this.value);
    });

});


function getTodoHistory(bacecamp_person_id)
{
  var action = ADMINURL+'/dashboard/todos/getTodoHistoryData';
            
  $('.card-footer').LoadingOverlay("show", {
      background: "rgba(165, 190, 100, 0)",
  });

  axios.post(action,{bacecamp_person_id:bacecamp_person_id})
  .then(function (response) 
  {
      const resp = response.data;
      $('.card-footer').LoadingOverlay("hide");

      if(resp.status == 'success'){
        $("#historyData").html(response.data.html);
      }
    
  })
  .catch(function (error) 
  {
      $('.card-footer').LoadingOverlay("hide");
     // swal("Error",error.response.data.msg,'error');
  }); 
} 