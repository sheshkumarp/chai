$(document).ready(function () 
{
  //alert('pass');

  var action = BASEURL + '/admin/dashboard/getMovementRecords';

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
        "data": function (object) {
          object.custom = {
            "asset_name": $('#asset_name').val(),
            "moved_from": $('#moved_from').val(),
            "moved_to": $('#moved_to').val()
          }
        }
      },
      "columns": [
        { "data": "asset_name" },
        { "data": "moved_from" },
        { "data": "moved_to" },
        { "data": "date" }
      ],

      "aoColumnDefs": [{ "bSortable": false, "aTargets": [0,1,2,3] }],
      "lengthMenu": [[20, 20, 50, 100, 500], [20, 25, 50, 100, 500]],
      "aaSorting": [[0, 'DESC']],
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

  table.on("draw.dt", function (e) 
  {
    setCustomPagingSigns.call($(this));
  }).each(function () {
    setCustomPagingSigns.call($(this));
  });

  function setCustomPagingSigns() {
    var wrapper = this.parent();

    // set global class
    wrapper.find('.dataTables_info').addClass('card-subtitle pb-0');

    // entries info class
    wrapper.find('tbody tr').addClass('inner-td');

    // for users module only || add custome class for tr
    wrapper.find('tbody tr').each(function () {
      $(this).find('td:nth-child(4)').css("text-align", "center");
      
    })

    // pagination 
    if (wrapper.find("a.first").hasClass("disabled")) {
      wrapper.find("a.first").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_arrow.svg" alt=" view"></span></a>`);
    }

    if (wrapper.find("a.previous").hasClass("disabled")) {
      wrapper.find("a.previous").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/left_double_arrow.svg" alt=" view"></span></a>`);
    }

    if (wrapper.find("a.last").hasClass("disabled")) {
      wrapper.find("a.last").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_arrow.svg" alt=" view"></span></a>`);
    }

    if (wrapper.find("a.next").hasClass("disabled")) {
      wrapper.find("a.next").html(`<a href="#" class="arrow hover-img"><span><img src="${BASEURL}/assets/admin/images/icons/right_double_arrow.svg" alt=" view"></span></a>`);
    }
  }
});


function doSearch(element) {
  $('#listingTable').DataTable().draw();
}


function removeSearch(element) {

  $('#asset_name').val('');
  $('#moved_from').val('');
  $('#moved_to').val('');
  doSearch();
}
