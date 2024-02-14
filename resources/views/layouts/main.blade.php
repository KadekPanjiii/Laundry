<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<style>
.main-sidebar{
  background: #F4F4F4;
}
.nav-item > a.nav-link{
  color: #333333;
}
.nav-header{
  color: #0056b3 !important; 
}
.nav-item:hover > a.nav-link{
  background: #FFFFFF !important;
  color: #0056b3 !important;
}
.nav-link.active {
  background: #FFFFFF !important;
  color: #007BFF !important;
  border-right: 5px solid #007BFF;
}

.kapan-card{
  
}
</style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Content -->
    @yield('container')

    
	<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/jszip/jszip.min.js"></script>
<script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="/assets/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $("#example1").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    });
});
</script>

<script>
$(".form-delete").on("submit", function(e) {
    e.preventDefault();
    var dataName = $(this).data('name');
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "{{ $title }} " + dataName + " akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).unbind("submit").submit();
       }
    });
});

$(".form-tdelete").on("submit", function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Transaksi ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
        // focusCancel: true // $$ Default hapus akan ke cancel
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Konfirmasi menghapus',
                text: "Transaksi akan segera dihapus!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).unbind("submit").submit();
                }
            });
        }
    });
  });
</script>

@if(session('toastr'))
<script>
    toastr.{{ session('toastr.type') }}('{{ session('toastr.message') }}');
</script>
@endif

</body>
</html>