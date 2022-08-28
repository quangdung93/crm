/**
 * DataTables Advanced
 */

'use strict';

// Advanced Search Functions Starts
// --------------------------------------------------------------------

// Filter column wise function
function filterColumn(i, val) {
  if (i == 5) {
    var startDate = $('.start_date').val(),
      endDate = $('.end_date').val();
      if (startDate !== '' && endDate !== '') {
        filterByDate(i, startDate, endDate); // We call our filter function
      }


    $('.dt-advanced-search').dataTable().fnDraw();
  } else {
    $('.dt-advanced-search').DataTable().column(i).search(val, false, true).draw();
  }
}

// Datepicker for advanced filter
var separator = ' - ',
  rangePickr = $('.flatpickr-range'),
  dateFormat = 'MM/DD/YYYY';
var options = {
  autoUpdateInput: false,
  autoApply: true,
  locale: {
    format: dateFormat,
    separator: separator
  },
  opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

//
if (rangePickr.length) {
  rangePickr.flatpickr({
    mode: 'range',
    dateFormat: 'm/d/Y',
    onClose: function (selectedDates, dateStr, instance) {
      var startDate = '',
        endDate = new Date();
      if (selectedDates[0] != undefined) {
        startDate =
          selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
        $('.start_date').val(startDate);
      }
      if (selectedDates[1] != undefined) {
        endDate =
          selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
        $('.end_date').val(endDate);
      }
      $(rangePickr).trigger('change').trigger('keyup');
    }
  });
}

// Advance filter function
// We pass the column location, the start date, and the end date
var filterByDate = function (column, startDate, endDate) {
  // Custom filter syntax requires pushing the new filter to the global filter array
  $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
    var rowDate = normalizeDate(aData[column]),
      start = normalizeDate(startDate),
      end = normalizeDate(endDate);

    // If our date from the row is between the start and end
    if (start <= rowDate && rowDate <= end) {
      return true;
    } else if (rowDate >= start && end === '' && start !== '') {
      return true;
    } else if (rowDate <= end && start === '' && end !== '') {
      return true;
    } else {
      return false;
    }
  });
};

// converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
var normalizeDate = function (dateString) {
  var date = new Date(dateString);
  var normalized =
    date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
  return normalized;
};
// Advanced Search Functions Ends

$(function () {
  var isRtl = $('html').attr('data-textdirection') === 'rtl';
  var dt_responsive_table = $('.dt-responsive');

  // on key up from input field
  $('input.dt-input').on('keyup', function () {
    filterColumn($(this).attr('data-column'), $(this).val());
  });

  // Responsive Table
  // --------------------------------------------------------------------

  if (dt_responsive_table.length) {
    var dt_responsive = dt_responsive_table.DataTable({
      ajax: assetPath + 'admin/orders/customer/5530',
      columns: [
        { data: '_id' },
        { data: 'code' },
        { data: 'store_id' },
        { data: 'created_at' },
        { data: 'created_by' },
        { data: 'customer_id' },
        { data: 'total_quantity' },
        { data: 'total_price' },
        { data: 'payment_method' },
        { data: 'status' },
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Label
          targets: -1,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              0: { title: 'Khởi tạo', class: 'badge-light-primary' },
              1: { title: 'Hoàn thành', class: ' badge-light-success' },
              3: { title: 'Đang giao', class: ' badge-light-danger' },
              4: { title: 'Resigned', class: ' badge-light-warning' },
              5: { title: 'Đang giao', class: ' badge-light-info' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge badge-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: -2,
          render: function (data, type, full, meta) {
            var $paymentMethod = full['payment_method'];
            var $payment = {
              1: { title: 'Tiền mặt', class: ' badge-light-success' },
              2: { title: 'Chuyển khoản', class: 'badge-light-primary' },
            };
            if (typeof $payment[$paymentMethod] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge badge-pill ' +
              $payment[$paymentMethod].class +
              '">' +
              $payment[$paymentMethod].title +
              '</span>'
            );
          }
        }
      ],
      dom:
        '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['code'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table'
          })
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
  }

  // // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .custom-select').removeClass('custom-select-sm').removeClass('form-control-sm');
});
