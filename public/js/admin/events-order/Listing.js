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
        url: baseUrl + 'events-orders/list',
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
          data: 'booking_user_id'
}
        , {
          data: 'event_user_id'
}
        , {
          data: 'event_id'
}
        , {
          data: 'no_of_booking'
}
        , {
          data: 'booking_unit_amount'
}
        , {
          data: 'applicable_tax_amount'
}
        , {
          data: 'booking_total_amount'
}
        , {
          data: 'points_used'
}
        , {
          data: 'booking_payable_amount'
}
        , {
          data: 'status'
}
      ],
      columnDefs: [
        {
          // Actions
          targets: 0,
          searchable: false,
          orderable: false,
          render: function render(data, type, full, meta) {
            return '<div class="d-inline-block text-nowrap">' + "<a href=\"/events-orders/" + full['id'] + "/edit\" class=\"btn btn-sm btn-icon\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-edit\"></i></a>") + "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-trash\"></i></button>") + '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' + viewListUrl + '" class="dropdown-item">View</a>' + '<a href="javascript:;" class="dropdown-item">Suspend</a>' + '</div>' + '</div>';
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
              return '<span class="events-orders-id">' + $val + '</span>';
            }
  }
    , {
    // booking_user_id
    targets: 2,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['booking_user_id'] ?full['booking_user_id'] : '';
              return '<span class="events-orders-booking_user_id">' + $val + '</span>';
            }
  }
    , {
    // event_user_id
    targets: 3,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_user_id'] ?full['event_user_id'] : '';
              return '<span class="events-orders-event_user_id">' + $val + '</span>';
            }
  }
    , {
    // event_id
    targets: 4,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['event_id'] ?full['event_id'] : '';
              return '<span class="events-orders-event_id">' + $val + '</span>';
            }
  }
    , {
    // no_of_booking
    targets: 5,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['no_of_booking'] ?full['no_of_booking'] : '';
              return '<span class="events-orders-no_of_booking">' + $val + '</span>';
            }
  }
    , {
    // booking_unit_amount
    targets: 6,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['booking_unit_amount'] ?full['booking_unit_amount'] : '';
              return '<span class="events-orders-booking_unit_amount">' + $val + '</span>';
            }
  }
    , {
    // applicable_tax_amount
    targets: 7,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['applicable_tax_amount'] ?full['applicable_tax_amount'] : '';
              return '<span class="events-orders-applicable_tax_amount">' + $val + '</span>';
            }
  }
    , {
    // booking_total_amount
    targets: 8,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['booking_total_amount'] ?full['booking_total_amount'] : '';
              return '<span class="events-orders-booking_total_amount">' + $val + '</span>';
            }
  }
    , {
    // points_used
    targets: 9,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['points_used'] ?full['points_used'] : '';
              return '<span class="events-orders-points_used">' + $val + '</span>';
            }
  }
    , {
    // booking_payable_amount
    targets: 10,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['booking_payable_amount'] ?full['booking_payable_amount'] : '';
              return '<span class="events-orders-booking_payable_amount">' + $val + '</span>';
            }
  }
    , {
    // status
    targets: 11,
    visible: true,
      searchable: true,
        orderable: true,
          responsivePriority: 4,
            render: function render(data, type, full, meta) {
              var $val = full['status'] ?full['status'] : '';
              return '<span class="events-orders-status">' + $val + '</span>';
            }
  }
  ],
  order: [[1, 'desc']],
    dom: '<"row mx-2 events-orders-list-header"' + '<"col-md-2 col-auto events-orders-list-page-col"<"datatable-toolbar"l>>' + '<"col-md-10 col events-orders-list-action-col"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-row mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2 events-orders-list-footer"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
      language: {
    sLengthMenu: '_MENU_',
      search: '',
        searchPlaceholder: 'Search'
  },
  // Buttons with Dropdown
  buttons: [{
    text: '<i class="ti ti-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add events-orders</span>',
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
        url: "".concat(baseUrl, "events-orders/").concat(record_id),
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
        text: 'The events-orders has been deleted!',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire({
        title: 'Cancelled',
        text: 'The events-orders is not deleted!',
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
  $('#offcanvasAddevents-ordersLabel').html('Edit events-orders');

  // get data
  $.get("".concat(baseUrl, "events-orders/").concat(record_id, "/edit"), function (data) {
    $('#record_id').val(data.id);
        $('#add-events-orders-id').val(data.id);
      $('#add-events-orders-booking_user_id').val(data.booking_user_id);
      $('#add-events-orders-event_user_id').val(data.event_user_id);
      $('#add-events-orders-event_id').val(data.event_id);
      $('#add-events-orders-no_of_booking').val(data.no_of_booking);
      $('#add-events-orders-booking_unit_amount').val(data.booking_unit_amount);
      $('#add-events-orders-applicable_tax_amount').val(data.applicable_tax_amount);
      $('#add-events-orders-booking_total_amount').val(data.booking_total_amount);
      $('#add-events-orders-points_used').val(data.points_used);
      $('#add-events-orders-booking_payable_amount').val(data.booking_payable_amount);
      $('#add-events-orders-status').val(data.status);
  });
});

// changing the title
$('.add-new').on('click', function () {
  $('#record_id').val(''); //reseting input field
  $('#offcanvasAddevents-ordersLabel').html('Add events-orders');
});

// Filter form control to default size
// ? setTimeout used for multilingual table initialization
setTimeout(function () {
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm');
}, 300);
});
