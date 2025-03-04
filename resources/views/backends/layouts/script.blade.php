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


<script src="https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>
<script>
    function toggleTheme() {
        let darkMode = document.body.classList.toggle("dark-version");
        document.getElementById("light-icon").classList.toggle("d-none", !darkMode);
        document.getElementById("dark-icon").classList.toggle("d-none", darkMode);

        let aside = document.querySelector("aside");

        if (darkMode) {
            $.cookie("dark-version" , 1 , { expires: new Date().getTime() + (10 * 365 * 24 * 60 * 60 * 1000) }, '/');
            aside.classList.add("bg-default");
            aside.classList.remove("bg-white");
        } else {
            $.cookie("dark-version" , 0 , { expires: new Date().getTime() + (10 * 365 * 24 * 60 * 60 * 1000) }, '/');
            aside.classList.add("bg-white");
            aside.classList.remove("bg-default");
        }

        localStorage.setItem("theme", darkMode ? "dark" : "light");
    }

    document.addEventListener("DOMContentLoaded", function () {
        let theme = localStorage.getItem("theme") || "light";
        let darkMode = theme === "dark";

        document.body.classList.toggle("dark-version", darkMode);
        document.getElementById("light-icon").classList.toggle("d-none", !darkMode);
        document.getElementById("dark-icon").classList.toggle("d-none", darkMode);

        let aside = document.querySelector("aside");

        if (darkMode) {
            $.cookie("dark-version" , 1 , { expires: new Date().getTime() + (10 * 365 * 24 * 60 * 60 * 1000) }, '/');
            aside.classList.add("bg-default");
            aside.classList.remove("bg-white");
        } else {
            $.cookie("dark-version" , 0 , { expires: new Date().getTime() + (10 * 365 * 24 * 60 * 60 * 1000) }, '/');
            aside.classList.add("bg-white");
            aside.classList.remove("bg-default");
        }
    });
</script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
{{-- <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script> --}}
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>


<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
{{-- <script>
    $(document).ready(function () {
        initDataTable();
    });

    function initDataTable() {
        if ($('#bookingTable').length && $('#dataTableButtons').length) {
            if ($.fn.DataTable.isDataTable('#bookingTable')) {
                $('#bookingTable').DataTable().clear().destroy();
                $('#bookingTable').empty();
            }

            let thCount = $('#bookingTable thead th').length;
            let tdCount = $('#bookingTable tbody tr:first td').length;

            $('#bookingTable_wrapper .dataTables_info').remove();
            $('#bookingTable_wrapper .dataTables_paginate').remove();
            $('#dataTableButtons .dt-buttons').remove();
            $('#dataTableButtons .dataTables_filter').remove();
            $('#dataTableButtons .dataTables_length').remove();

            if (thCount !== tdCount) {
                console.error("Mismatch detected! Thead columns:", thCount, "Tbody columns:", tdCount);
                return;
            }

            if ($('#bookingTable tbody tr').length === 0) {
                console.warn("No data found in table. Skipping DataTables initialization.");
                return;
            }

            setTimeout(function () {
                $.fn.dataTable.ext.search.length = 0;

                let actionColumnIndex = -1;
                let usernameColumnIndex = -1;
                let emailColumnIndex = -1;
                let statusColumnIndex = -1;

                let ignoredColumns = [];

                $('#bookingTable thead th').each(function (index) {
                    let columnText = $(this).text().trim().toLowerCase();
                    if (columnText.includes('action')) {
                        actionColumnIndex = index;
                    }
                    if (columnText.includes('username') || columnText.includes('customer name')) {
                        usernameColumnIndex = index;
                    }
                    if (columnText.includes('email')) {
                        emailColumnIndex = index;
                    }
                    if (columnText.includes('status')) {
                        statusColumnIndex = index;
                    }
                    if (columnText === 'image' || columnText === 'images') {
                        ignoredColumns.push(index);
                    }
                });

                // Custom search filter to ignore "image" and "images" columns
                $.fn.dataTable.ext.search.push(function (settings, searchData, index, rowData, counter) {
                    let searchTerm = $('#bookingTable_filter input').val().toLowerCase();

                    if (!searchTerm) {
                        return true;
                    }

                    for (let i = 0; i < searchData.length; i++) {
                        if (ignoredColumns.includes(i)) {
                            continue;
                        }
                        if (searchData[i].toLowerCase().includes(searchTerm)) {
                            return true;
                        }
                    }
                    return false;
                });

                // Custom sorting to ensure first names sort numerically
                $.fn.dataTable.ext.type.order['custom-username-asc'] = function (a, b) {
                    return a.localeCompare(b, undefined, { numeric: true });
                };
                $.fn.dataTable.ext.type.order['custom-username-desc'] = function (a, b) {
                    return b.localeCompare(a, undefined, { numeric: true });
                };

                // Custom sorting to ensure emails sort numerically
                $.fn.dataTable.ext.type.order['custom-email-asc'] = function (a, b) {
                    return a.localeCompare(b, undefined, { numeric: true });
                };
                $.fn.dataTable.ext.type.order['custom-email-desc'] = function (a, b) {
                    return b.localeCompare(a, undefined, { numeric: true });
                }

                // Custom sorting for status (numeric)
                $.fn.dataTable.ext.order['custom-status-asc'] = function (a, b) {
                    return a - b;
                };
                $.fn.dataTable.ext.order['custom-status-desc'] = function (a, b) {
                    return b - a;
                };

                var table = $('#bookingTable').DataTable({
                    responsive: true,
                    searchDelay: 100,
                    dom: '<"d-flex justify-content-between align-items-center"lfB>rtip',
                    buttons: [
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> Export to CSV',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Export to Excel',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> Export to PDF',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        { extend: 'colvis', text: '<i class="fas fa-columns"></i> Column Visibility' }
                    ],
                    columnDefs: [
                        {
                            targets: actionColumnIndex,
                            orderable: false
                        },
                        {
                            targets: usernameColumnIndex,
                            type: 'custom-username'
                        },
                        {
                            targets: emailColumnIndex,
                            type: 'custom-email'
                        },
                        { targets: statusColumnIndex,
                            type: 'custom-status'
                        }
                    ],
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

                $('#bookingTable_filter input').off('keyup').on('keyup', function () {
                    table.search(this.value).draw();
                });

                // Move elements correctly
                if ($('#dataTableButtons').length) {
                    $('.dataTables_length').prependTo('#dataTableButtons');
                    table.buttons().container().appendTo('#dataTableButtons');
                    $('.dataTables_filter').appendTo('#dataTableButtons');
                } else {
                    console.error("Div #dataTableButtons not found.");
                }
            }, 100);
        }
    }

    function refreshTable(response) {
        $('#bookingTable').replaceWith(response.view);
        toastr.success(response.msg);

        setTimeout(function () {
            initDataTable();
        }, 500);
    }
</script> --}}
<script>
    $(document).ready(function () {
        initDataTable();
    });

    function initDataTable() {
        if ($('#bookingTable').length && $('#dataTableButtons').length) {
            if ($.fn.DataTable.isDataTable('#bookingTable')) {
                $('#bookingTable').DataTable().clear().destroy();
                $('#bookingTable').empty();
            }

            let thCount = $('#bookingTable thead th').length;
            let tdCount = $('#bookingTable tbody tr:first td').length;

            $('#bookingTable_wrapper .dataTables_info').remove();
            $('#bookingTable_wrapper .dataTables_paginate').remove();
            $('#dataTableButtons .dt-buttons').remove();
            $('#dataTableButtons .dataTables_filter').remove();
            $('#dataTableButtons .dataTables_length').remove();

            if (thCount !== tdCount) {
                console.error("Mismatch detected! Thead columns:", thCount, "Tbody columns:", tdCount);
                return;
            }

            if ($('#bookingTable tbody tr').length === 0) {
                console.warn("No data found in table. Skipping DataTables initialization.");
                return;
            }

            setTimeout(function () {
                // Clear old search filters (in case table was destroyed/rebuilt)
                $.fn.dataTable.ext.search.length = 0;

                let actionColumnIndex = -1;
                let usernameColumnIndex = -1;
                let emailColumnIndex = -1;
                let statusColumnIndex = -1;

                let ignoredColumns = [];

                $('#bookingTable thead th').each(function (index) {
                    let columnText = $(this).text().trim().toLowerCase();
                    if (columnText.includes('action')) {
                        actionColumnIndex = index;
                    }
                    if (columnText.includes('username') || columnText.includes('customer name')) {
                        usernameColumnIndex = index;
                    }
                    if (columnText.includes('email')) {
                        emailColumnIndex = index;
                    }
                    if (columnText.includes('status')) {
                        statusColumnIndex = index;
                    }
                    if (columnText === 'image' || columnText === 'images') {
                        ignoredColumns.push(index); // Mark "image" columns to ignore in search
                    }
                });

                // 🔥 Custom global search: Ignore content in "image" and "images" columns
                $.fn.dataTable.ext.search.push(function (settings, searchData, index, rowData, counter) {
                    let searchTerm = $('#bookingTable_filter input').val().toLowerCase().trim();

                    if (searchTerm === "") {
                        return true; // If search is empty, show all rows
                    }

                    for (let i = 0; i < searchData.length; i++) {
                        if (ignoredColumns.includes(i)) {
                            continue; // Skip image/images columns
                        }

                        if (searchData[i].toLowerCase().includes(searchTerm)) {
                            return true; // If any allowed column matches, show the row
                        }
                    }
                    return false; // If nothing matches, hide the row
                });

                // Custom sorting
                $.fn.dataTable.ext.type.order['custom-username-asc'] = function (a, b) {
                    return a.localeCompare(b, undefined, { numeric: true });
                };
                $.fn.dataTable.ext.type.order['custom-username-desc'] = function (a, b) {
                    return b.localeCompare(a, undefined, { numeric: true });
                };

                $.fn.dataTable.ext.type.order['custom-email-asc'] = function (a, b) {
                    return a.localeCompare(b, undefined, { numeric: true });
                };
                $.fn.dataTable.ext.type.order['custom-email-desc'] = function (a, b) {
                    return b.localeCompare(a, undefined, { numeric: true });
                };

                $.fn.dataTable.ext.order['custom-status-asc'] = function (a, b) {
                    return a - b;
                };
                $.fn.dataTable.ext.order['custom-status-desc'] = function (a, b) {
                    return b - a;
                };

                var table = $('#bookingTable').DataTable({
                    responsive: true,
                    searchDelay: 100,
                    dom: '<"d-flex justify-content-between align-items-center"lfB>rtip',
                    buttons: [
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv"></i> Export to CSV',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Export to Excel',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> Export to PDF',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            exportOptions: {
                                columns: ':visible:not(:last-child)',
                                modifier: { page: 'current' }
                            }
                        },
                        { extend: 'colvis', text: '<i class="fas fa-columns"></i> Column Visibility' }
                    ],
                    columnDefs: [
                        { targets: actionColumnIndex, orderable: false },
                        { targets: usernameColumnIndex, type: 'custom-username' },
                        { targets: emailColumnIndex, type: 'custom-email' },
                        { targets: statusColumnIndex, type: 'custom-status' }
                    ],
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

                $('#bookingTable_filter input').off('keyup').on('keyup', function () {
                    table.search(this.value).draw();
                });

                if ($('#dataTableButtons').length) {
                    $('.dataTables_length').prependTo('#dataTableButtons');
                    table.buttons().container().appendTo('#dataTableButtons');
                    $('.dataTables_filter').appendTo('#dataTableButtons');
                } else {
                    console.error("Div #dataTableButtons not found.");
                }
            }, 100);
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("sidebar-search");
        const suggestionsBox = document.getElementById("search-suggestions");
        const menuLinks = Array.from(document.querySelectorAll(".navbar-nav .nav-link"))
            .map(link => ({
                name: link.innerText.trim(),
                url: link.href
            }));

        searchInput.addEventListener("input", function () {
            const query = searchInput.value.toLowerCase();
            suggestionsBox.innerHTML = "";

            if (query.length === 0) {
                suggestionsBox.style.display = "none";
                return;
            }

            const filteredLinks = menuLinks.filter(item => item.name.toLowerCase().includes(query));
            if (filteredLinks.length > 0) {
                suggestionsBox.style.display = "block";
                filteredLinks.forEach(item => {
                    const suggestionItem = document.createElement("a");
                    suggestionItem.classList.add("list-group-item", "list-group-item-action");
                    suggestionItem.innerText = item.name;
                    suggestionItem.href = item.url;
                    suggestionItem.addEventListener("click", function (e) {
                        e.preventDefault();
                        window.location.href = item.url;
                    });

                    suggestionsBox.appendChild(suggestionItem);
                });
            } else {
                const noResultItem = document.createElement("div");
                noResultItem.classList.add("list-group-item", "text-danger", "text-center");
                noResultItem.innerText = "Menu not found";
                suggestionsBox.appendChild(noResultItem);
                suggestionsBox.style.display = "block";
            }
        });

        document.addEventListener("click", function (event) {
            if (!searchInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
                suggestionsBox.style.display = "none";
            }
        });
    });
</script>
<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     // Find all nav items with submenus
    //     document.querySelectorAll('.nav-item').forEach(function(navItem) {
    //         let navLink = navItem.querySelector('.nav-link');
    //         let subMenu = navItem.querySelector('.nav-treeview');

    //         if (subMenu) {
    //             // Only handle click for parent with dropdown
    //             navLink.addEventListener('click', function(e) {
    //                 e.preventDefault(); // Don't navigate, only toggle
    //                 navItem.classList.toggle('menu-open');

    //                 // Toggle visibility of submenu
    //                 if (navItem.classList.contains('menu-open')) {
    //                     subMenu.style.display = 'block';
    //                 } else {
    //                     subMenu.style.display = 'none';
    //                 }
    //             });
    //         }
    //     });
    // });
    document.addEventListener("DOMContentLoaded", function() {
        const SPEED = 300; // Animation speed in milliseconds (adjust as needed)

        document.querySelectorAll('.nav-item').forEach(function(navItem) {
            let navLink = navItem.querySelector('.nav-link');
            let subMenu = navItem.querySelector('.nav-treeview');
            let arrowIcon = navItem.querySelector('.menu-arrow');

            if (subMenu) {
                // Set initial state for menus
                if (navItem.classList.contains('menu-open')) {
                    subMenu.style.display = 'block';
                    subMenu.style.height = subMenu.scrollHeight + 'px';
                    if (arrowIcon) arrowIcon.style.transform = 'rotate(-180deg)';
                } else {
                    subMenu.style.display = 'none';
                    subMenu.style.height = '0';
                    if (arrowIcon) arrowIcon.style.transform = 'rotate(0deg)';
                }

                navLink.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (navItem.classList.contains('menu-open')) {
                        closeMenu(navItem, subMenu, arrowIcon);
                    } else {
                        document.querySelectorAll('.nav-item.menu-open').forEach(function(openItem) {
                            let openSubMenu = openItem.querySelector('.nav-treeview');
                            let openArrow = openItem.querySelector('.menu-arrow');
                            if (openSubMenu && openItem !== navItem) {
                                closeMenu(openItem, openSubMenu, openArrow);
                            }
                        });

                        openMenu(navItem, subMenu, arrowIcon);
                    }
                });
            }
        });

        function openMenu(navItem, subMenu, arrowIcon) {
            navItem.classList.add('menu-is-opening');
            subMenu.style.display = 'block';
            subMenu.style.height = '0';
            setTimeout(() => {
                subMenu.style.transition = `height ${SPEED}ms ease`;
                subMenu.style.height = subMenu.scrollHeight + 'px';
            }, 10);

            setTimeout(() => {
                subMenu.style.height = 'auto';
                navItem.classList.add('menu-open');
                navItem.classList.remove('menu-is-opening');
            }, SPEED);

            if (arrowIcon) {
                arrowIcon.style.transform = 'rotate(-180deg)';
            }
        }

        function closeMenu(navItem, subMenu, arrowIcon) {
            navItem.classList.remove('menu-open');
            subMenu.style.transition = `height ${SPEED}ms ease`;
            subMenu.style.height = subMenu.scrollHeight + 'px';

            setTimeout(() => {
                subMenu.style.height = '0';
            }, 10);

            setTimeout(() => {
                subMenu.style.display = 'none';
                subMenu.style.height = '0';
            }, SPEED);

            if (arrowIcon) {
                arrowIcon.style.transform = 'rotate(0deg)';
            }
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
        const compressor = new window.Compress();

        $('.custom-file-input').change(async function (e) {
            const fileInput = $(this);
            const imageNamesHidden = fileInput.closest('.form-group').find('.image_names_hidden');

            const file = e.target.files[0];
            const formData = new FormData();

            try {
                const options = {
                    maxSizeMB: 0.05,
                    quality: 1.0,
                    maxWidthOrHeight: 1024,
                    useWebWorker: true,
                    fileType: file.type
                };

                const compressedFile = await imageCompression(file, options);

                formData.append('image', compressedFile);
                formData.append('_token', '{{ csrf_token() }}');

                $.post({
                    url: "{{ route('save_temp_file') }}",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(response => {
                    if (response.status === 1) {
                        imageNamesHidden.val(response.temp_files);
                    } else {
                        toastr.error(response.msg);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    toastr.error(`Upload failed: ${jqXHR.status} ${errorThrown}`);
                    console.log(jqXHR.responseText);
                });

            } catch (error) {
                toastr.error("Image compression failed.");
                console.error(error);
            }
        });

        // dropifyInput.on('dropify.afterClear', function (event) {
        //     $(this).closest('.form-group').find('.image_names_hidden').val('');
        // });
    });
</script>
@stack('js')
