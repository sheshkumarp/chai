$(document).ready(function () 
{
  $(".todoForm1").validator();
  $('#noticeList').mCustomScrollbar({
      theme: "light",
  });

  //getTodoHistory();
  // get list records 
  getCalenderRecords('all');
  getTodos();
  getNoticeList();



  
  //To hide the datepicker
  $(document).on("click", function(e) {
    var elem = $(e.target);
    if(!elem.hasClass("datepicker") && 
        !elem.hasClass("text-underline") &&
        !elem.hasClass("ui-datepicker") && 
        !elem.hasClass("ui-icon") && 
        !elem.hasClass("ui-datepicker-next") && 
        !elem.hasClass("ui-datepicker-prev") && 
        !$(elem).parents(".ui-datepicker").length){
            $('#dueDate').datepicker('hide');
    }
  });

  var date = new Date();
  date.setDate(date.getDate());
  $('#dueDate').datepicker({
      format: 'mm-dd-yyyy',
      autoclose: true,
      showClear: true,
      startDate: date
  })
  .on('changeDate', function (selected) 
  {
     // startDate = new Date(selected.date.valueOf()); 
      //  console.log(startDate);
       var data=formatDate(selected.date);
       $('#dueDate').text(data[0]);
       $('#dueDateVal').val(data[1]);
      //$('#dueDateVal').val('').datepicker('setStartDate',startDate);
  });
  

})


//----------------------------------Start Todos---------------------------------

//To format the datepicker
  function formatDate(date) {

    var monthNames = [
      "January", "February", "March",
      "April", "May", "June", "July",
      "August", "September", "October",
      "November", "December"
    ];

     /*var days_full = [
                            'Sunday',
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday',
                            'Saturday'
                        ];*/

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    var string=monthNames[monthIndex]  + '-' + day+ '-'+year;
    var stringval=year+ '-'+(monthIndex+1)  + '-' + day;
    
    var formated=[];
    formated.push(string);
    formated.push(stringval);
   
    return formated;
    //return  year+ '-'+monthNames[monthIndex]  + '-' + day;
  }

//
 

function hideShowDiv(id,type){

  if(type=='show'){
    $("#hideDiv_"+id).removeClass('hide');

    var date = new Date();
    date.setDate(date.getDate());
    $('#dueDate_'+id).datepicker({
        format: 'mm-dd-yyyy',
        autoclose: true,
        showClear: true,
        startDate: date
    })
    .on('changeDate', function (selected) 
    {
       // startDate = new Date(selected.date.valueOf()); 
        //  console.log(startDate);
         var data=formatDate(selected.date);
         $('#dueDate_'+id).text(data[0]);
         $('#dueDateVal_'+id).val(data[1]);
        //$('#dueDateVal').val('').datepicker('setStartDate',startDate);
    });

  }else if(type=='hide'){
    $("#hideDiv_"+id).addClass('hide');
  }
 
}

function hideShowTodo(type){

    if(type=='show'){
       // $(element).parent().parent().removeClass('add-to-do-list-hide');
       $("#addRemoveClass").removeClass('add-to-do-list-hide');
    }else if(type=='hide'){
       $("#addRemoveClass").addClass('add-to-do-list-hide');
       $('#dueDate').text('No due date');
       $("input[name=todoName]").val('');
       $("input[name=dueDateVal]").val('');

        //$(element).parent().parent().parent().addClass('add-to-do-list-hide');
    }
}

$(document).on('submit','.todoForm1', function (e) 
{
  if (!e.isDefaultPrevented()) {
    console.log("todoForm1 submit");

    const $this = $(this);
    const action = $this.attr('action');
    const formData = new FormData($this[0]);

    $('.card-body').LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0)",
        });

    axios.post(action, formData)
        .then(function (response) {
            const resp = response.data;

            if (resp.status == 'success') {
                $this[0].reset();
                toastr.success(resp.msg);
                $('.card-body').LoadingOverlay("hide");
                getTodos();
               // setTimeout(function () {
                  //  window.location.href = resp.url;
              //  }, 2000)
            }

            if (resp.status == 'error') {
                $('.card-body').LoadingOverlay("hide");
                toastr.error(resp.msg);
            }
        })
        .catch(function (error) {
            $('.card-body').LoadingOverlay("hide");

            const errorBag = error.response.data.errors;

            $.each(errorBag, function (fieldName, value) {show_event(element)
              {

              }
                $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                $('.err_' + fieldName).text(value[0]).closest('span').show();
            })
        });

    return false;
  }

});

// submitting form after validation
$('#todoForm').validator().on('submit', function (e) 
{

  console.log("todoForm submit");
    if (!e.isDefaultPrevented()) {

        const $this = $(this);
        const action = $this.attr('action');
        const formData = new FormData($this[0]);
        
        
        $('.card-body').LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0)",
        });

        axios.post(action, formData)
            .then(function (response) {
                const resp = response.data;

                if (resp.status == 'success') {
                    $this[0].reset();
                    toastr.success(resp.msg);
                    $('.card-body').LoadingOverlay("hide");
                    getTodos();
                   // setTimeout(function () {
                      //  window.location.href = resp.url;
                  //  }, 2000)
                }

                if (resp.status == 'error') {
                    $('.card-body').LoadingOverlay("hide");
                    toastr.error(resp.msg);
                }
            })
            .catch(function (error) {
                $('.card-body').LoadingOverlay("hide");

                const errorBag = error.response.data.errors;

                $.each(errorBag, function (fieldName, value) {show_event(element)
                  {

                  }
                    $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                    $('.err_' + fieldName).text(value[0]).closest('span').show();
                })
            });

        return false;
    }
});

function showEditDelete(element){
  //console.log($(element).is(":checked"));
  var ischecked = $(element).is(":checked");

  if(ischecked){
    $(element).parent().next().next('div').addClass('active');//.next('div').addClass('active');
  }else{
    $(element).parent().next().next('div').removeClass('active');
  }

  //console.log($(element).closest('.action-wrapper').addClass('active'));
}

function getTodos()
{
    var action = ADMINURL+'/dashboard/todos/getTodoLists';
              
    $('.card-body').LoadingOverlay("show", {
        background: "rgba(165, 190, 100, 0)",
    });

    axios.get(action)
    .then(function (response) 
    {
        const resp = response.data;
        $('.card-body').LoadingOverlay("hide");

        if(resp.status == 'success'){
          $("#todoList").html(response.data.html);
          $(".todoForm1").validator();
        }

      
    })
    .catch(function (error) 
    {
        $('.card-body').LoadingOverlay("hide");
       // swal("Error",error.response.data.msg,'error');
    }); 
}

function deleteTodo(element)
{
    //var noticeId = $(element).attr('noticeId');
    // console.log(noticeId);
    // return false;
    //action = ADMINURL+'/dashboard/notice-board/deleteNotice';
    var action =  $(element).attr('link');
//, { noticeId:noticeId }
    swal({
      title: "Are you sure",
      text: "You want to delete?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Delete",
      confirmButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, 
    function () 
    {   
        axios.post(action)
        .then(function (response) 
        {
          if (response.data.status == 'success') 
          {
            swal("Success",response.data.msg,'success');
            getTodos();
            
          }

          if (response.data.status === 'error') 
          {
            swal("Error",response.data.msg,'error');                
          }

        })
        .catch(function (error) 
        {
           // swal("Error",error.response.data.msg,'error');
        }); 
    });
}

//----------------------------------End Todos---------------------------------

//----------------------------------Start Google Js Code---------------------------------

function getCalenderRecords(type)
{
    // data 
    // var credit_type = 0;
    // var state_id    = 1;

    $('.calendar-wrp').LoadingOverlay("show", {
        background: "rgba(165, 190, 100, 0)",
    });

    // calender
    $("#eventCalendarCustomDate").empty();
    $("#eventCalendarCustomDate").unbind();
    $("#eventCalendarCustomDate").eventCalendar(
    {
        eventsjson: ADMINURL + '/dashboard/calendar/getEvents?type='+type,
        dateFormat: 'dddd D-MM-YYY',
        startWeekOnMonday: false,
        txt_noEvents: 'No events scheduled today!',
        nowIndicator: true,
    });
    $(".course-wrp .eventsCalendar-list-content").mCustomScrollbar({theme:"dark-2"});



    if(type=='google'){
      $(".green-btn").addClass('selected');
    }else if(type=='lectures'){
      $(".orange-btn").addClass('selected');
    }
}

function getEventsByType(type){ 
  //getCalenderRecords(type);
  if(type=='google'){
      $(".orange").hide();
       $(".green").show();
    }else if(type=='lectures'){
      $(".green").hide();
       $(".orange").show();
    }
}

function getEventsOnSelectedDate(type,year,month,day){ 


  //alert(type);
  var action = ADMINURL+'/dashboard/calendar/getEvents?type=all&year='+year+'&month='+month+'&day='+day;
            
  $('.calendar-wrp').LoadingOverlay("show", {
      background: "rgba(165, 190, 100, 0)",
  });

  axios.get(action)
  .then(function (response) 
  {
      $('.calendar-wrp').LoadingOverlay("hide");

      if(response.status==200){
          var html="No Event";
          if(response.data.length>0){
              html="";
              $.each(response.data,function(key,item){
                  var itemclass="orange";
                  if(item.event_type=="google"){
                      itemclass="green";
                  }
                 html+="<p class="+itemclass+">"+item.title+"</p>";
              });
          }
          

          $(".modal-body").html(html);
          var  date= year+"-"+month+"-"+day;
          $("#eventDate").val(date);
          $(".modal-title").html($.fn.eventCalendar.defaults.monthNames[month-1]+" "+day+","+year);
          

          $('#hideEventDiv').hide();
          $('#showEventSpan').show();
          $('input[name="eventName"]').val('');

          $("#eventModal").show();
      }
    
  })
  .catch(function (error) 
  {
      $('.calendar-wrp').LoadingOverlay("hide");
     // swal("Error",error.response.data.msg,'error');
  }); 
}

function closeModal(){ 
  $('input[name="eventName"]').val('');
  $("#eventModal").hide(); 
}

// hide and show live credits fields 
function toggleEventDetails(element) 
{
    $this = $(element).closest('.parentDiv');
   
    if ($this.attr('id') == 'showEventSpan') 
    {
         $('#hideEventDiv').show();
         $("#showEventSpan").hide();
    }

    if ($this.attr('id') == 'hideEventDiv') 
    {
        $('#hideEventDiv').hide();
        $('#showEventSpan').show();
        $('input[name="eventName"]').val('');
    }
}

// submitting form after validation
$('#eventForm').validator().on('submit', function (e) 
{
    if (!e.isDefaultPrevented()) {

        const $this = $(this);
        const action = $this.attr('action');
        const formData = new FormData($this[0]);
        
        
        $('.modal-content').LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0)",
        });

        axios.post(action, formData)
            .then(function (response) {
                const resp = response.data;
                $("#eventModal").hide();

                if (resp.status == 'success') {
                    $this[0].reset();
                    toastr.success(resp.msg);
                    $('.modal-content').LoadingOverlay("hide");
                    
                    getCalenderRecords('all');
                    // setTimeout(function () {
                    //     window.location.href = resp.url;
                    // }, 2000)
                }

                if (resp.status == 'error') {
                    $('.modal-content').LoadingOverlay("hide");
                    toastr.error(resp.msg);
                }
            })
            .catch(function (error) {
                $('.modal-content').LoadingOverlay("hide");
                $("#eventModal").hide();

                const errorBag = error.response.data.errors;

                $.each(errorBag, function (fieldName, value) {show_event(element)
                  {

                  }
                    $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                    $('.err_' + fieldName).text(value[0]).closest('span').show();
                })
            });

        return false;
    }
});

//-------------------------------------End Google Js Code--------------------------------------

//----------------------------------Start Notice Board Js Code---------------------------------
// submitting form after validation
$('#noticeForm').validator().on('submit', function (e) 
{
    if (!e.isDefaultPrevented()) {

        const $this = $(this);
        const action = $this.attr('action');
        const formData = new FormData($this[0]);
        
        
        $('.card-body-15').LoadingOverlay("show", {
            background: "rgba(165, 190, 100, 0)",
        });

        axios.post(action, formData)
            .then(function (response) {
                const resp = response.data;

                if (resp.status == 'success') {
                    $this[0].reset();
                    toastr.success(resp.msg);
                    $('.card-body-15').LoadingOverlay("hide");
                    getNoticeList();
                    // setTimeout(function () {
                    //     window.location.href = resp.url;
                    // }, 2000)
                }

                if (resp.status == 'error') {
                    $('.card-body-15').LoadingOverlay("hide");
                    toastr.error(resp.msg);
                }
            })
            .catch(function (error) {
                $('.card-body-15').LoadingOverlay("hide");

                const errorBag = error.response.data.errors;

                $.each(errorBag, function (fieldName, value) {show_event(element)
                  {

                  }
                    $('.err_' + fieldName).closest('.form-group').addClass('has-error has-danger');
                    $('.err_' + fieldName).text(value[0]).closest('span').show();
                })
            });

        return false;
    }
});


function deleteNotice(element)
{
    var noticeId = $(element).attr('noticeId');
    // console.log(noticeId);
    // return false;
    action = ADMINURL+'/dashboard/notice-board/deleteNotice';

    swal({
      title: "Are you sure!",
      text: "You want to delete?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Delete",
      confirmButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, 
    function () 
    {   
        axios.post(action, { noticeId:noticeId })
        .then(function (response) 
        {
          if (response.data.status == 'success') 
          {
            swal("Success",response.data.msg,'success');

            getNoticeList();
            // setTimeout(function () {
            //     window.location.href = response.data.url;
            // }, 2000)
          }

          if (response.data.status === 'error') 
          {
            swal("Error",response.data.msg,'error');                
          }

        })
        .catch(function (error) 
        {
           // swal("Error",error.response.data.msg,'error');
        }); 
    });
} 

function hideNotice(element)
{
    var noticeId = $(element).attr('noticeId');
    var hideflag = $(element).attr('hideflag');
    // console.log(noticeId);
    // console.log(hideflag);

    var hidetext="Hide";
    if(hideflag==1){
     hidetext="Unhide";
    }
    
    action = ADMINURL+'/dashboard/notice-board/hideNotice';

    swal({
      title: "Are you sure",
      text: "You want to "+hidetext+"?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: hidetext,
      confirmButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, 
    function () 
    {   
        axios.post(action, { noticeId:noticeId,hideflag:hideflag })
        .then(function (response) 
        {
          if (response.data.status == 'success') 
          {
            swal("Success",response.data.msg,'success');
            getNoticeList();
            // setTimeout(function () {
            //     window.location.href = response.data.url;
            // }, 2000)
          }

          if (response.data.status === 'error') 
          {
            swal("Error",response.data.msg,'error');                
          }

        })
        .catch(function (error) 
        {
           // swal("Error",error.response.data.msg,'error');
        }); 
    });
}

function pinNotice(element)
{
    var noticeId = $(element).attr('noticeId');
    var pinflag  = $(element).attr('pinflag');
    // console.log(noticeId);
    // console.log(hideflag);

    var pintext="Pin";
    if(pinflag==1){
     pintext="UnPin";
    }

    action = ADMINURL+'/dashboard/notice-board/pinNotice';

    swal({
      title: "Are you sure",
      text: "You want to "+pintext+"?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: pintext,
      confirmButtonClass: "btn-danger",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, 
    function () 
    {   
        axios.post(action, { noticeId:noticeId,pinflag:pinflag  })
        .then(function (response) 
        {
          if (response.data.status == 'success') 
          {
            swal("Success",response.data.msg,'success');
            getNoticeList();

            // setTimeout(function () {
            //     window.location.href = response.data.url;
            // }, 2000)
          }

          if (response.data.status === 'error') 
          {
            swal("Error",response.data.msg,'error');                
          }

        })
        .catch(function (error) 
        {
           // swal("Error",error.response.data.msg,'error');
        }); 
    });
}



function getNoticeList()
{
    $("#noticeList").mCustomScrollbar("destroy");          
    var action = ADMINURL+'/dashboard/notice-board/getNoticeList';
              
    $('.card-body-15').LoadingOverlay("show", {
        background: "rgba(165, 190, 100, 0)",
    });

    axios.post(action)
    .then(function (response) 
    {
        const resp = response.data;
        $('.card-body-15').LoadingOverlay("hide");

        if(resp.status == 'success'){
          $("#noticeList").html(response.data.html);
          $('#noticeList').mCustomScrollbar({
              theme: "light",
          });          
         /* $('ul.notice-lists.list-group.clear.mh-200').mCustomScrollbar({
              theme: "light",
              scrollButtons:{
                enable:true
              },
              scrollInertia:0,
              advanced:{
              autoScrollOnFocus: false,
              updateOnContentResize: true
              },
          });*/
          //$("#noticeList").mCustomScrollbar();
          //$(".todoForm1").validator();
        }

      
    })
    .catch(function (error) 
    {
        $('.card-body-15').LoadingOverlay("hide");
       // swal("Error",error.response.data.msg,'error');
    }); 
}

//-------------------------------------End Notice Board Js Code--------------------------------



