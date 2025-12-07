<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ $title }}</title>
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/Highcharts-10.3.3/code/css/highcharts.css') }}"> --}}
   <!-- Bootstrap4 Duallistbox -->
   <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
   <link rel="stylesheet" href="{{ asset("/plugins/datetimepicker/datetimepicker.min.css")}}">

   <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <script src="/plugins/moment/moment.min.js"></script>
  <script src="/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('layouts.navbar')
  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/images/logo-solite-interior.jpg" alt="logo-solite-interior" height="60" width="60">
  </div> --}}

  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('container')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">IT Department PT. SOS Indonesia</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<script>
$(document).ready(function(){
  $('.nav-sidebar').addClass('nav-compact');
  $('.nav-sidebar').addClass('nav-child-indent');
  $('body').addClass('text-sm');
  
});
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Javascript validation-->
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Jquery Datatable -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https:////cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap.js"></script> --}}
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/jeffreydwalter/ColReorderWithResize@9ce30c640e394282c9e0df5787d54e5887bc8ecc/ColReorderWithResize.js"></script>
{{-- <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap.min.js"></script> --}}
<!-- Select2 -->
<script src="/plugins/select2/js/select2.full.min.js"></script>
<!-- Sweet Alert -->
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/plugins/toastr/toastr.min.js"></script>
<!--Input Mask-->
<script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- InputMask -->

<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="/plugins/require/require.js"></script>
<script>
var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer:3000
});
$('.select2').select2();
$('[data-mask]').inputmask();

$('#dateContract').daterangepicker({
  locale: {
    format:'YYYY/MM/DD'
  },
  minDate: new Date(currentYear, currentMonth, currentDate),
  dateFormat: 'yy-mm-dd',
  startDate: moment(date).add(1,'days'),
  endDate: moment(date).add(2,'days')
});

var date = new Date();
var currentMonth = date.getMonth();
var currentDate = date.getDate();
var currentYear = date.getFullYear();

// function groupBy(list, keyGetter) {
//     const map = new Map();
//     list.forEach((item) => {
//          const key = keyGetter(item);
//          const collection = map.get(key);
//          if (!collection) {
//              map.set(key, [item]);
//          } else {
//              collection.push(item);
//          }
//     });
//     return map;
// }

//$('.date-picker').datetimepicker({
  //      format: 'YYYY-MM-DD'
    //});

 //Date picker
//  $('#reservationdate').datetimepicker({
//         format: 'YYYY-MM-DD',
//     });
    
$('#range_date').daterangepicker({
  locale: {
    format: 'YYYY-MM-DD'
  },
  showDropdowns: true,
  startDate: moment(),           // Tanggal awal default
  endDate: moment(),             // Tanggal akhir default
  autoUpdateInput: false         // Biar kamu bisa kontrol input value secara manual
}, function(start, end, label) {
  $('#range_date').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
});

//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox()


function monthIndonesiaVers(month){
    let name;
    switch(month){
        case 1:
            name = "January";
            break;
        case 2:
            name = "February";
            break;
        case 3:
            name = "March";
            break;
        case 4:
            name = "April";
            break;
        case 5:
            name = "May";
            break;
        case 6:
            name = "June";
            break;
        case 7:
            name = "July";
            break;
        case 8:
            name = "August";
            break;
        case 9:
            name = "September";
            break;
        case 10:
            name = "October";
            break;
        case 11:
            name = "November";
            break;
        case 12:
            name = "December";
            break;
        default:
            name = "Invalid Month";
            break;
        
    }
    return name;
}

function bin2hex(str) {
  return Array.from(str).map(c => 
    c.charCodeAt(0).toString(16).padStart(2, '0')
  ).join('');
}

function goBack(){
  window.history.back();
}
</script>
@yield('script')
</body>
</html>