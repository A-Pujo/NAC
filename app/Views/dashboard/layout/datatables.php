<!-- Datatables -->

    <!-- <link rel="stylesheet" href="/css/datatables.css"> -->
    <!-- Main Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js"></script>
    <!-- Download Data -->
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
    <!-- Script -->
    <script>
    $(document).ready( function () {
        $('#tabel').DataTable({
            "scrollX": true,
            dom: `  <"flex justify-between items-center text-base-100 text-16"
                        <"flex items-center"
                            <"length" l>
                            B
                        >
                        <"find"f>
                    > 
                    <"text-base-100" rt>
                    <"flex justify-between text-base-100 text-16"ip>`,
            buttons: [
                { extend: 'excel', className: 'btn btn-primary ml-4' },
                { extend: 'pdf', className: 'btn btn-primary ml-4' }
            ]
        });
    } );
    </script>
<!-- End of Datatables -->