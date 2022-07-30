<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="_token" content="{{ csrf_token() }}">
   <title>Jayawardena Network (Pvt)Ltd</title>
   <!-- Favicon and touch icons -->
   <link rel="shortcut icon" href="assets/dist/img/ico/dialog.ico" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->

         <!-- lobicard tather css -->
         <link rel="stylesheet" href="assets/plugins/lobipanel/css/tether.min.css" />
         <!-- Bootstrap -->
         <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
         <!-- lobicard tather css -->
         <link rel="stylesheet" href="assets/plugins/lobipanel/css/jquery-ui.min.css" />
         <!-- lobicard min css -->
         <link href="assets/plugins/lobipanel/css/lobicard.min.css" rel="stylesheet" />
         <!-- lobicard github css -->
         <link href="assets/plugins/lobipanel/css/github.css" rel="stylesheet" />
         <!-- Pace css -->
         <link href="assets/plugins/pace/flash.css" rel="stylesheet" />
         <!-- Font Awesome -->
         <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
         <!-- Pe-icon -->
         <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" />
         <!-- Themify icons -->
         <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" />
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start page Label Plugins
         =====================================================================-->
         <!-- Emojionearea -->
         <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" />
         <!-- Monthly css -->
         <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" />
      <!-- End page Label Plugins
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
         <!-- Theme style -->
         <link href="assets/dist/css/stylecrm.css" rel="stylesheet" />
         <!-- Theme style rtl -->
         <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" />-->

         <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

      <!-- End Theme Layout Style
         =====================================================================-->
         
         <style type="text/css">
         .swal2-warning{
            display: flex;
            width: 60% !important;
            margin: unset !important;
            margin: 20px 80px !important;
         }

/*         .swal2-warning {
          font-size: unset !important;
          width: 18% !important;
          height: 84% !important;
          margin-left: 180px !important;*/
          /*}*/
       </style>

    </head>
    <body class="hold-transition sidebar-mini">
      <!--preloader-->
      <div id="preloader">
         <div id="status"></div>
      </div>
      <!-- Site wrapper -->

      @include('sweetalert::alert')

      @include('admin.body.header')

      <!-- Left side column. contains the sidebar -->
      @include('admin.body.sidebar')
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      @yield('admin')
      <!-- /.content-wrapper -->
      @include('admin.body.footer')
      <!-- /.wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->

         <!-- jQuery -->
         <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" ></script>
         <!-- Bootstrap proper -->
         <script src="assets/bootstrap/js/popper.min.js" ></script>
         <!-- lobicard ui min js -->
         <script src="assets/plugins/lobipanel/js/jquery-ui.min.js" ></script>
         <!-- lobicard ui touch-punch-improved js -->
         <script src="assets/plugins/lobipanel/js/jquery.ui.touch-punch-improved.js"></script>
         <!-- lobicard tether min js -->
         <script src="assets/plugins/lobipanel/js/tether.min.js" ></script>
         <!-- Bootstrap -->
         <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
         <!-- lobicard js -->
         <script src="assets/plugins/lobipanel/js/lobicard.js" ></script>
         <!-- lobicard highlight js -->
         <script src="assets/plugins/lobipanel/js/highlight.js" ></script>
         <!-- Pace js -->
         <script src="assets/plugins/pace/pace.min.js" ></script>
         <!-- table-export js -->
         <script src="assets/plugins/table-export/tableExport.js" ></script>
         <script src="assets/plugins/table-export/jquery.base64.js" ></script>
         <script src="assets/plugins/table-export/html2canvas.js" ></script>
         <script src="assets/plugins/table-export/sprintf.js" ></script>
         <script src="assets/plugins/table-export/jspdf.js" ></script>
         <script src="assets/plugins/table-export/base64.js" ></script>
         <!-- dataTables js -->
         <script src="assets/plugins/datatables/dataTables.min.js" ></script>
         <!-- NIceScroll -->
         <script src="assets/plugins/slimScroll/jquery.nicescroll.min.js" ></script>
         <!-- FastClick -->
         <script src="assets/plugins/fastclick/fastclick.min.js" ></script>
         <!-- CRMadmin frame -->
         <script src="assets/dist/js/custom.js" ></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Page Lavel Plugins
         =====================================================================-->
         <!-- ChartJs JavaScript -->
         <!-- <script src="assets/plugins/chartJs/Chart.min.js" ></script> -->
         <!-- Counter js -->
         <script src="assets/plugins/counterup/waypoints.js" ></script>
         <script src="assets/plugins/counterup/jquery.counterup.min.js" ></script>
         <!-- Monthly js -->
         <script src="assets/plugins/monthly/monthly.js" ></script>
      <!-- End Page Lavel Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
         <!-- Dashboard js -->
         <script src="assets/dist/js/dashboard.js" ></script>
      <!-- End Theme label Script
         =====================================================================-->
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <script src="assets/customized_scripts.js"></script>



         <script>

       //      function dash() {
       //   // single bar chart
       //   var ctx = document.getElementById("singelBarChart");
       //   var myChart = new Chart(ctx, {
       //      type: 'bar',
       //      data: {
       //         labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
       //         datasets: [
       //         {
       //            label: "My First dataset",
       //            data: [40, 55, 75, 81, 56, 55, 40],
       //            borderColor: "rgba(0, 150, 136, 0.8)",
       //            width: "1",
       //            borderWidth: "0",
       //            backgroundColor: "rgba(0, 150, 136, 0.8)"
       //         }
       //         ]
       //      },
       //      options: {
       //         scales: {
       //            yAxes: [{
       //              ticks: {
       //                beginAtZero: true
       //             }
       //          }]
       //       }
       //    }
       // });
       //         //monthly calender
       //         $('#m_calendar').monthly({
       //          mode: 'event',
       //           //jsonUrl: 'events.json',
       //           //dataType: 'json'
       //           xmlUrl: 'events.xml'
       //        });

       //   //bar chart
       //   var ctx = document.getElementById("barChart");
       //   var myChart = new Chart(ctx, {
       //      type: 'bar',
       //      data: {
       //         labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
       //         datasets: [
       //         {
       //            label: "My First dataset",
       //            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
       //            borderColor: "rgba(0, 150, 136, 0.8)",
       //            width: "1",
       //            borderWidth: "0",
       //            backgroundColor: "rgba(0, 150, 136, 0.8)"
       //         },
       //         {
       //            label: "My Second dataset",
       //            data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
       //            borderColor: "rgba(51, 51, 51, 0.55)",
       //            width: "1",
       //            borderWidth: "0",
       //            backgroundColor: "rgba(51, 51, 51, 0.55)"
       //         }
       //         ]
       //      },
       //      options: {
       //         scales: {
       //            yAxes: [{
       //              ticks: {
       //                beginAtZero: true
       //             }
       //          }]
       //       }
       //    }
       // });
       //       //counter
       //       $('.count-number').counterUp({
       //          delay: 10,
       //          time: 5000
       //       });
       //    }
       //    dash();
    </script>
 </body>
 </html>

