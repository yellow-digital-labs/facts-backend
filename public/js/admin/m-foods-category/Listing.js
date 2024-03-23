$(function () {
  // ajax setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var table = $('.datatables');
  if (table.length) {
    $('.datatables thead tr').clone(true).appendTo('.dt-column-search thead');
    $('.datatables thead tr:eq(1) th').each(function (i) {
      if (i > 0) {
        var title = $(this).text();
        $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');

        $('input', this).on('keyup change', function () {
          if (dt_table.column(i).search() !== this.value) {
            dt_table.column(i).search(this.value).draw();
          }
        });
      }
    });

    var dt_table = table.DataTable({
      processing: true,
      serverSide: true,
      orderCellsTop: true,
      bLengthChange: true,
      paging: true,
      ajax: {
        url: baseUrl + 'm-foods-categories/list',
      },
      columns: [
        // columns according to JSON
        {
          data: ''
        }
        , {
          data: 'id'
}
        , {
          data: 'food_category_name'
}
        , {
          data: 'active'
}
      ],
      columnDefs: [
        {
          // Actions
          targets: 0,
          searchable: false,
          orderable: false,
          render: function render(data, type, full, meta) {
            return '<div class="d-inline-block text-nowrap">' + "<a href=\"/m-foods-categories/" + full['id'] + "/edit\" class=\"btn btn-sm btn-icon\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-edit\"></i></a>") + "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-trash\"></i></button>") + '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' + viewListUrl + '" class="dropdown-item">View</a>' + '<a href="javascript:;" class="dropdown-item">Suspend</a>' + '</div>' + '</div>';
    }
}
  
    , {
    // id
    targets: 1,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['id'] ?full['id'] : '';
              return '<span class="m-foods-categories-id">' + $val + '</span>';
            }
  }
    , {
    // food_category_name
    targets: 2,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['food_category_name'] ?full['food_category_name'] : '';
              return '<span class="m-foods-categories-food_category_name">' + $val + '</span>';
            }
  }
    , {
    // active
    targets: 3,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['active'] ?full['active'] : '';
              return '<span class="m-foods-categories-active">' + $val + '</span>';
            }
  }
  ],
  order: [[1, 'desc']],
    dom: '<"row mx-2 m-foods-categories-list-header"' + '<"col-md-2 col-auto m-foods-categories-list-page-col"<"datatable-toolbar"l>>' + '<"col-md-10 col m-foods-categories-list-action-col"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-row mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2 m-foods-categories-list-footer"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
      language: {
    sLengthMenu: '_MENU_',
      search: '',
        searchPlaceholder: 'Search'
  },
  // Buttons with Dropdown
  buttons: [{
    text: '<i class="ti ti-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add m-foods-categories</span>',
    className: 'add-new btn btn-primary ms-3',
    action: function action(e, dt, node, config) {
      window.location.href = urlCreateView;
    }
  }]
});
}

// Delete Record
$(document).on('click', '.delete-record', function () {
  var record_id = $(this).data('id'),
    dtrModal = $('.dtr-bs-modal.show');

  // hide responsive modal in small screen
  if (dtrModal.length) {
    dtrModal.modal('hide');
  }

  // sweetalert for confirmation of delete
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    customClass: {
      confirmButton: 'btn btn-primary me-3',
      cancelButton: 'btn btn-label-secondary'
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      // delete the data
      $.ajax({
        type: 'DELETE',
        url: "".concat(baseUrl, "m-foods-categories/").concat(record_id),
        success: function success() {
          dt_table.draw();
        },
        error: function error(_error) {
          console.log(_error);
        }
      });

      // success sweetalert
      Swal.fire({
        icon: 'success',
        title: 'Deleted!',
        text: 'The m-foods-categories has been deleted!',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire({
        title: 'Cancelled',
        text: 'The m-foods-categories is not deleted!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      });
    }
  });
});

// edit record
$(document).on('click', '.edit-record', function () {
  var record_id = $(this).data('id'),
    dtrModal = $('.dtr-bs-modal.show');

  // hide responsive modal in small screen
  if (dtrModal.length) {
    dtrModal.modal('hide');
  }

  // changing the title of offcanvas
  $('#offcanvasAddm-foods-categoriesLabel').html('Edit m-foods-categories');

  // get data
  $.get("".concat(baseUrl, "m-foods-categories/").concat(record_id, "/edit"), function (data) {
    $('#record_id').val(data.id);
        $('#add-m-foods-categories-id').val(data.id);
      $('#add-m-foods-categories-food_category_name').val(data.food_category_name);
      $('#add-m-foods-categories-active').val(data.active);
  });
});

// changing the title
$('.add-new').on('click', function () {
  $('#record_id').val(''); //reseting input field
  $('#offcanvasAddm-foods-categoriesLabel').html('Add m-foods-categories');
});

// Filter form control to default size
// ? setTimeout used for multilingual table initialization
setTimeout(function () {
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm');
}, 300);
});
