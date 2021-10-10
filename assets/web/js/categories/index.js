$(document).ready(function() 
{
    var action = ADMINURL+'/faculty/getRecords'; 
    const table = $('#listingTable').DataTable( 
    {
        "responsive": true,
        "processing": true,
        "bFilter": false, 
        "bInfo": true,
        "bLengthChange": false,
        "pagingType": "full_numbers",
        "serverSide": 'true',
        "ajax": {
            "url": action,
            "data": function (object) 
            {
                object.custom = {
                    "name" :  $('#faculty-name').val(),
                    "email" : $('#faculty-email').val(),
                    "phone" : $('#faculty-phone').val(),
                    "status" : $('#faculty-status').val()
                }
            }
        },
        "columns": [
            { "data": "id",  "visible": false, },
            { "data": "select"},
            { "data": "name"},
            { "data": "email"},
            { "data": "phone"},
            { "data": "status"},
            { "data": "actions"}
        ],
        "aoColumnDefs": [{ "bSortable": false, "aTargets": [0,1,6] }],
        "lengthMenu": [[20, 20, 50, 100, 500], [20, 25, 50, 100, 500]],
        "aaSorting": [[0, 'ASC']],
        "language": {
          "processing": "Loading ...",
          "paginate": 
          {
            "first": `<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_arrow-Active.svg" alt=" view"></span></a>`,
            "previous": `<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_double_arrow-Active.svg" alt=" view"></span></a>`,
            "next": `<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_double_arrow-Active.svg" alt=" arrow"></span></a>`,
            "last": `<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_arrow-Active.svg" alt=" arrow"></span></a>`
          }
        }
    });

    table.on("draw.dt", function (e) {                    
        setCustomPagingSigns.call($(this));
    }).each(function () {
        setCustomPagingSigns.call($(this)); 
    });

    function setCustomPagingSigns() 
    {
      $('.my-select').selectbox();

      var wrapper = this.parent();

      // set global class
      wrapper.find('.dataTables_info').addClass('card-subtitle pb-0');

      // entries info class
      wrapper.find('tbody tr').addClass('inner-td');

      wrapper.find('tbody tr').each(function(index, element)
      {
        if (index != '0') 
        {
          $(element).find('td:nth-child(3)').addClass('theme-green semibold f-18 text-underline');
          $(element).find('td:nth-child(4)').addClass('text-center');
          $(element).find('td:nth-child(5)').addClass('theme-green semibold text-center f-18');           
        }
      })

      // for search only
      wrapper.find('tbody tr').first().addClass('inner-td theme-bg-blue-light vertical-align-middle');
      wrapper.find('tbody tr').first().find('td').last().addClass('text-center');

      // pagination 
      if(wrapper.find("a.first").hasClass("disabled"))
      {
        wrapper.find("a.first").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_arrow.svg" alt=" view"></span></a>`);
      }

      if(wrapper.find("a.previous").hasClass("disabled"))
      {
        wrapper.find("a.previous").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_double_arrow.svg" alt=" view"></span></a>`);
      }

      if(wrapper.find("a.last").hasClass("disabled"))
      {
        wrapper.find("a.last").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_arrow.svg" alt=" view"></span></a>`);
      }

      if(wrapper.find("a.next").hasClass("disabled"))
      {
        wrapper.find("a.next").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_double_arrow.svg" alt=" view"></span></a>`);
      }  
    }
});

function doSearch(element)
{
  $('#listingTable').DataTable().draw();
}

function removeSearch(element)
{ 

  $('#faculty-name').val(''),
  $('#faculty-email').val(''),
  $('#faculty-phone').val(''),
  $('#faculty-status').val('')

  $('#listingTable').DataTable().draw();
}

function deleteCollections(element)
{

   var $members = $('.facultySelect:checked');

   if ($members.length == 0) 
   {
      swal("Error",'Please select atleast one faculty.','error');
      return false; 
   }
   else
   {

      var arrEncId = [];
      $members.each(function()
      {
            arrEncId.push($(this).val());            
      })

      action = ADMINURL+'/faculty/bulkDelete';

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
            axios.post(action, { arrEncId:arrEncId })
            .then(function (response) 
            {
              if (response.data.status == 'success') 
              {
                swal("Success",response.data.msg,'success');
                $('#listingTable').DataTable().ajax.reload();
                
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
}
