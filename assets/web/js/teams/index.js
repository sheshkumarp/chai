$(document).ready(function () 
{
  var action = ADMINURL + '/teams/getRecords';

  const table = $('#teamListingTable').DataTable(
    {
      "responsive": true,
      "processing": true,
      "bFilter": false,
      "bInfo": true,
      "bLengthChange": false,
      "pagingType": "full_numbers",
      "serverSide": 'true',
      "ajax": action,
      "columns": [
        { "data": "id"},
        { "data": "title" },
        { "data": "created_at" },
        { "data": "actions" }
      ],

      "aoColumnDefs": [{ "bSortable": false }],
      "lengthMenu": [[10, 20, 50, 100, 500], [10, 25, 50, 100, 500]],
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
      $(this).find('td:nth-child(1)').addClass('text-center');
      $(this).find('td:nth-child(2)').addClass('theme-green semibold f-18 text-underline');
      $(this).find('td:nth-child(3)').addClass('');
      $(this).find('td:nth-child(4)').addClass('theme-green semibold f-18');
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

