<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/sweetalert2/js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- summernote --}}
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/compress.js') }}"></script>
<script src="{{ asset('js/rowfy.js') }}"></script>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{ asset('dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('dist/js/dropify.js') }}"></script>

{{ Session::has('message') }}
<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
<script>
    $(document).ready(function () {
        initDataTable();
    });

    function initDataTable() {
        if ($('#bookingTable').length && $('#bookingTableButtons').length) {
            if ($.fn.DataTable.isDataTable('#bookingTable')) {
                $('#bookingTable').DataTable().clear().destroy();
                $('#bookingTable').empty();
            }

            let thCount = $('#bookingTable thead th').length;
            let tdCount = $('#bookingTable tbody tr:first td').length;

            console.log("TH count:", thCount);
            console.log("TD count:", tdCount);

            $('#bookingTable_wrapper .dataTables_info').remove();
            $('#bookingTable_wrapper .dataTables_paginate').remove();
            $('#bookingTableButtons .dt-buttons').remove();
            $('#bookingTableButtons .dataTables_filter').remove();
            $('#bookingTableButtons .dataTables_length').remove();

            if (thCount !== tdCount) {
                console.error("Mismatch detected! Thead columns:", thCount, "Tbody columns:", tdCount);
                return; // Stop DataTables from initializing if there's a mismatch
            }

            if ($('#bookingTable tbody tr').length === 0) {
                console.warn("No data found in table. Skipping DataTables initialization.");
                return;
            }

            setTimeout(function () {
                let actionColumnIndex = -1;
                $('#bookingTable thead th').each(function (index) {
                    let columnText = $(this).text().trim().toLowerCase();
                    if (columnText.includes('action')) {
                        actionColumnIndex = index;
                    }
                });

                var table = $('#bookingTable').DataTable({
                    responsive: true,
                    dom: '<"d-flex justify-content-between align-items-center"lfB>rtip',
                    buttons: [
                        { extend: 'csv', text: '<i class="fas fa-file-csv"></i> Export to CSV', exportOptions: { columns: ':visible:not(:last-child)' } },
                        { extend: 'excel', text: '<i class="fas fa-file-excel"></i> Export to Excel', exportOptions: { columns: ':visible:not(:last-child)' } },
                        { extend: 'print', text: '<i class="fas fa-print"></i> Print', exportOptions: { columns: ':visible:not(:last-child)' } },
                        { extend: 'colvis', text: '<i class="fas fa-columns"></i> Column Visibility' },
                        { extend: 'pdf', text: '<i class="fas fa-file-pdf"></i> Export to PDF', exportOptions: { columns: ':visible:not(:last-child)' } },
                    ],
                    columnDefs: actionColumnIndex !== -1 ? [{ orderable: false, targets: actionColumnIndex }] : [],
                    language: {
                        search: "",
                        searchPlaceholder: "Search...",
                        paginate: {
                            first: "<<",
                            previous: "<",
                            next: ">",
                            last: ">>"
                        },
                        processing: "Loading...",
                        aria: {
                            sortAscending: " 🠕",
                            sortDescending: " 🠗"
                        }
                    },
                    pagingType: "full_numbers"
                });

                // Move elements correctly
                if ($('#bookingTableButtons').length) {
                    $('.dataTables_length').prependTo('#bookingTableButtons');
                    table.buttons().container().appendTo('#bookingTableButtons');
                    $('.dataTables_filter').appendTo('#bookingTableButtons');
                } else {
                    console.error("Div #bookingTableButtons not found.");
                }
            }, 100);
        } else {
            console.error("Table #bookingTable or Div #bookingTableButtons not found.");
        }
    }

    function refreshTable(response) {
        $('#bookingTable').replaceWith(response.view);
        toastr.success(response.msg);

        setTimeout(function () {
            initDataTable();
        }, 500);
    }
</script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
<!-- Required for Export to Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<!-- Required for Export to PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
    $(function() {

        $(".thumbnail").fancybox();

        $(document).on("click", ".btn-modal", function(e) {
            e.preventDefault();
            var container = $(this).data("container");

            $.ajax({
                url: $(this).data("href"),
                dataType: "html",
                success: function(result) {
                    $(container).html(result).modal("show");
                    $('.select2').select2();
                },
            });
        });
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: `{{ __('Please Select') }}`,
            allowClear: false
        });

        // init custom file input
        bsCustomFileInput.init();

        // init summernote
        $('.summernote').summernote({
            placeholder: '{{ __("Type something") }}',
            tabsize: 2,
            height: $('.summernote').data('height') ?? 300
        });
        $('.in_kind_support_summernote').summernote({
            placeholder: '{{ __("Type something") }}',
            tabsize: 2,
            height: 100,
            width: 500
        });

        $(".datepicker").datepicker({
            // dateFormat: "yy-mm-dd", // Customize the date format as needed
            dateFormat: "dd-mm-yy", // Customize the date format as needed
            changeMonth: true,
            changeYear: true
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr(".current-flatpickr", {
            dateFormat: "Y-m-d", // Stored format (for database)
            altInput: true,
            altFormat: "d / M / Y", // Display format in the input
            minDate: "today",
            disableMobile: true
        });

        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d", // Stored format (for database)
            altInput: true,
            altFormat: "d / M / Y", // Display format in the input
            placeholder: "Select Date"
        });
    });
</script>
<script>
    $(document).ready(function() {
        const Confirmation = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if (Session::has('msg'))
            @if (Session::get('success') == true)
                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('msg') }}"
                });
                success.play();
            @else
                Toast.fire({
                    icon: 'error',
                    title: "{{ Session::get('msg') }}"
                });
                error.play();
            @endif
        @endif
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function initializeStatusInput(url) {
        $('input.status').off('change').on('change', function () {
            const id = $(this).data('id');
            console.log(id);

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    if (response.status == 1) {
                        Toast.fire({
                            icon: 'success',
                            title: response.msg
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.msg
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX error: " + status + "\nError: " + error);
                }
            });
        });
    }
</script>
@stack('js')

