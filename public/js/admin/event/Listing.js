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
        url: baseUrl + 'events/list',
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
          data: 'user_id'
}
        , {
          data: 'event_categories_id'
}
        , {
          data: 'event_name'
}
        , {
          data: 'event_start_datetime'
}
        , {
          data: 'event_end_datetime'
}
        , {
          data: 'event_primary_image'
}
        , {
          data: 'event_location'
}
        , {
          data: 'event_contact'
}
        , {
          data: 'event_available_tickets'
}
        , {
          data: 'event_ticket_amount'
}
        , {
          data: 'event_ticket_discount_amount'
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
            return '<div class="d-inline-block text-nowrap">' + "<a href=\"/events/" + full['id'] + "/edit\" class=\"btn btn-sm btn-icon\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-edit\"></i></a>") + "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-trash\"></i></button>") + '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' + viewListUrl + '" class="dropdown-item">View</a>' + '<a href="javascript:;" class="dropdown-item">Suspend</a>' + '</div>' + '</div>';
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
              return '<span class="events-id">' + $val + '</span>';
            }
  }
    , {
    // user_id
    targets: 2,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['user_id'] ?full['user_id'] : '';
              return '<span class="events-user_id">' + $val + '</span>';
            }
  }
    , {
    // event_categories_id
    targets: 3,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_categories_id'] ?full['event_categories_id'] : '';
              return '<span class="events-event_categories_id">' + $val + '</span>';
            }
  }
    , {
    // event_name
    targets: 4,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_name'] ?full['event_name'] : '';
              return '<span class="events-event_name">' + $val + '</span>';
            }
  }
    , {
    // event_start_datetime
    targets: 5,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_start_datetime'] ?full['event_start_datetime'] : '';
              return '<span class="events-event_start_datetime">' + $val + '</span>';
            }
  }
    , {
    // event_end_datetime
    targets: 6,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_end_datetime'] ?full['event_end_datetime'] : '';
              return '<span class="events-event_end_datetime">' + $val + '</span>';
            }
  }
    , {
    // event_primary_image
    targets: 7,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_primary_image'] ?full['event_primary_image'] : '';
              return '<span class="events-event_primary_image">' + $val + '</span>';
            }
  }
    , {
    // event_location
    targets: 8,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_location'] ?full['event_location'] : '';
              return '<span class="events-event_location">' + $val + '</span>';
            }
  }
    , {
    // event_contact
    targets: 9,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_contact'] ?full['event_contact'] : '';
              return '<span class="events-event_contact">' + $val + '</span>';
            }
  }
    , {
    // event_available_tickets
    targets: 10,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_available_tickets'] ?full['event_available_tickets'] : '';
              return '<span class="events-event_available_tickets">' + $val + '</span>';
            }
  }
    , {
    // event_ticket_amount
    targets: 11,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_ticket_amount'] ?full['event_ticket_amount'] : '';
              return '<span class="events-event_ticket_amount">' + $val + '</span>';
            }
  }
    , {
    // event_ticket_discount_amount
    targets: 12,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_ticket_discount_amount'] ?full['event_ticket_discount_amount'] : '';
              return '<span class="events-event_ticket_discount_amount">' + $val + '</span>';
            }
  }
    , {
    // active
    targets: 13,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['active'] ?full['active'] : '';
              return '<span class="events-active">' + $val + '</span>';
            }
  }
  ],
  order: [[1, 'desc']],
    dom: '<"row mx-2 events-list-header"' + '<"col-md-2 col-auto events-list-page-col"<"datatable-toolbar"l>>' + '<"col-md-10 col events-list-action-col"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-row mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2 events-list-footer"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
      language: {
    sLengthMenu: '_MENU_',
      search: '',
        searchPlaceholder: 'Search'
  },
  // Buttons with Dropdown
  buttons: [{
    text: '<i class="ti ti-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add events</span>',
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
        url: "".concat(baseUrl, "events/").concat(record_id),
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
        text: 'The events has been deleted!',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire({
        title: 'Cancelled',
        text: 'The events is not deleted!',
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
  $('#offcanvasAddeventsLabel').html('Edit events');

  // get data
  $.get("".concat(baseUrl, "events/").concat(record_id, "/edit"), function (data) {
    $('#record_id').val(data.id);
        $('#add-events-id').val(data.id);
      $('#add-events-user_id').val(data.user_id);
      $('#add-events-event_categories_id').val(data.event_categories_id);
      $('#add-events-event_name').val(data.event_name);
      $('#add-events-event_start_datetime').val(data.event_start_datetime);
      $('#add-events-event_end_datetime').val(data.event_end_datetime);
      $('#add-events-event_primary_image').val(data.event_primary_image);
      $('#add-events-event_location').val(data.event_location);
      $('#add-events-event_contact').val(data.event_contact);
      $('#add-events-event_available_tickets').val(data.event_available_tickets);
      $('#add-events-event_ticket_amount').val(data.event_ticket_amount);
      $('#add-events-event_ticket_discount_amount').val(data.event_ticket_discount_amount);
      $('#add-events-active').val(data.active);
  });
});

// changing the title
$('.add-new').on('click', function () {
  $('#record_id').val(''); //reseting input field
  $('#offcanvasAddeventsLabel').html('Add events');
});

// Filter form control to default size
// ? setTimeout used for multilingual table initialization
setTimeout(function () {
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm');
}, 300);
});
