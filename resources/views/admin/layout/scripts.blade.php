<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('admin/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!-- OPTIONAL SCRIPTS -->
<!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
<!-- sortablejs -->
<script>
    const connectedSortables = document.querySelectorAll('.connectedSortable');
    connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
            group: 'shared',
            handle: '.card-header',
        });
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
    });
</script>
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    const sales_chart_options = {
        series: [{
                name: 'Digital Goods',
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                name: 'Electronics',
                data: [65, 59, 80, 81, 56, 55, 40],
            },
        ],
        chart: {
            height: 300,
            type: 'area',
            toolbar: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            type: 'datetime',
            categories: [
                '2023-01-01',
                '2023-02-01',
                '2023-03-01',
                '2023-04-01',
                '2023-05-01',
                '2023-06-01',
                '2023-07-01',
            ],
        },
        tooltip: {
            x: {
                format: 'MMMM yyyy',
            },
        },
    };

    const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
    );
    sales_chart.render();
</script>
<!-- jsvectormap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
<!-- jsvectormap -->
<script>
    const visitorsData = {
        US: 398, // USA
        SA: 400, // Saudi Arabia
        CA: 1000, // Canada
        DE: 500, // Germany
        FR: 760, // France
        CN: 300, // China
        AU: 700, // Australia
        BR: 600, // Brazil
        IN: 800, // India
        GB: 320, // Great Britain
        RU: 3000, // Russia
    };

    // World map by jsVectorMap
    const map = new jsVectorMap({
        selector: '#world-map',
        map: 'world',
    });

    // Sparkline charts
    const option_sparkline1 = {
        series: [{
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
    sparkline1.render();

    const option_sparkline2 = {
        series: [{
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
    sparkline2.render();

    const option_sparkline3 = {
        series: [{
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
        }, ],
        chart: {
            type: 'area',
            height: 50,
            sparkline: {
                enabled: true,
            },
        },
        stroke: {
            curve: 'straight',
        },
        fill: {
            opacity: 0.3,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#DCE6EC'],
    };

    const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
    sparkline3.render();
</script>

<!-- jQuery with SRI -->

<!-- jQuery with SRI -->
<script src="{{ url('admin/js/jquery-3.7.1.min.js') }}"></script>

<!-- Custom Script -->
<script src="{{ url('admin/js/custom.js') }}"></script>

<!-- Datatable -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $("#categories").DataTable();
        $("#subadmins").DataTable();
        $("#products").DataTable();
        $("#trips").DataTable();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>



<script>
    Dropzone.autoDiscover = false;

    // Main Image Dropzone
    let mainImageDropzone = new Dropzone("#mainImageDropzone", {
        url: "{{ route('product.upload.image') }}",
        maxFiles: 1,
        acceptedFiles: "image/*",
        maxFilesize: 0.5, // Max file size in MB
        addRemoveLinks: true,
        dictDefaultMessage: "Drag & drop product image or click to upload",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            // Set the value of the hidden input field with the uploaded file name
            document.getElementById('main_image_hidden').value = response.fileName;
        },
        error: function(file, message) {
            // Display an alert with the error message (Note: For production, consider using a custom modal instead of alert())
            alert(message);
            // Remove the file from the Dropzone area
            this.removeFile(file);
        },
        init: function() {
            // Event listener for when the maximum number of files is exceeded
            this.on("maxfilesexceeded", function(file) {
                // Remove all existing files
                this.removeAllFiles();
                // Add the new file
                this.addFile(file);
            });
        }
    });

    // Product Images Dropzone
    let productimagesDropzone = new Dropzone("#productImagesDropzone", {
        url: "{{ route('product.upload.images') }}",
        maxFiles: 10,
        acceptedFiles: "image/*",
        parallelUploads: 10, // Add this line to allow parallel uploads
        uploadMultiple: false, // Keep this false unless you want to send all files in one request
        maxFilesize: 0.5,
        addRemoveLinks: true,
        dictDefaultMessage: "Drag & drop product images or click to upload",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        init: function() {
            this.on("success", function(file, response) {
                // Append filename to hidden input
                let hiddenInput = document.getElementById('product_images_hidden');
                let currentVal = hiddenInput.value;

                if (currentVal === '') {
                    hiddenInput.value = response.fileName;
                } else {
                    hiddenInput.value = currentVal + ',' + response.fileName;
                }
                file.uploadedFileName = response.fileName;
            });

            this.on("removedfile", function(file) {
                if (file.uploadedFileName) {
                    let hiddenInput = document.getElementById('product_images_hidden');
                    let currentVal = hiddenInput.value;
                    let files = currentVal.split(',');
                    files = files.filter(name => name !== file.uploadedFileName);
                    hiddenInput.value = files.join(',');

                    // Optional: Delete the file from server
                    $.ajax({
                        url: "{{ route('product.delete.temp.image') }}",
                        type: 'POST',
                        data: {
                            filename: file.uploadedFileName
                        },
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                }
            });
            // Further Dropzone event listeners for other functionalities will go here
        }
    });



    // Product Video Dropzone
    let productVideoDropzone = new Dropzone("#productVideoDropzone", {
        url: "{{ route('product.upload.video') }}",
        maxFiles: 1,
        acceptedFiles: "video/*",
        maxFilesize: 2, // Max file size in MB
        addRemoveLinks: true,
        dictDefaultMessage: "Drag & drop product video or click to upload",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            // Set the value of the hidden input field with the uploaded file name
            document.getElementById('product_video_hidden').value = response.fileName;
        },
        error: function(file, message) {
            // Display an alert with the error message (Note: For production, consider using a custom modal instead of alert())
            alert(message);
            // Remove the file from the Dropzone area
            this.removeFile(file);
        },
        init: function() {
            // Event listener for when the maximum number of files is exceeded
            this.on("maxfilesexceeded", function(file) {
                // Remove all existing files
                this.removeAllFiles();
                // Add the new file
                this.addFile(file);
            });
        }
    });
</script>

<script>
    function openRejectModal(tripId) {
        $('#denyTripId').val(tripId);
        $('#denyTripModal').modal('show');
    }

    $('#denyTripForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('admin.trips.deny') }}", // Use route helper
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON.message || 'Something went wrong.'));
            }
        });
    });
</script>
