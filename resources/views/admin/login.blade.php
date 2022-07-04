<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Jayawardena Network (Pvt)Ltd</title>
   <link rel="shortcut icon" href="assets/dist/img/ico/dialog.ico" type="image/x-icon">
   <link rel="stylesheet" href="assets/plugins/lobipanel/css/tether.min.css" />
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="assets/plugins/lobipanel/css/jquery-ui.min.css" />
   <link href="assets/plugins/lobipanel/css/lobicard.min.css" rel="stylesheet" />
   <link href="assets/plugins/lobipanel/css/github.css" rel="stylesheet" />
   <link href="assets/plugins/pace/flash.css" rel="stylesheet" />
   <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
   <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" />
   <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" />
   <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" />
   <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" />
   <link href="assets/dist/css/stylecrm.css" rel="stylesheet" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">



   <style type="text/css">
   .divider:after,
   .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
   }
   .h-custom {
      height: calc(100% - 73px);
   }
   @media (max-width: 450px) {
      .h-custom {
         height: 100%;
      }
   }
   .lgBtn{
      padding-left: 2.5rem; padding-right: 2.5rem;
   }

   .swal2-icon{
      display: flex;
      /*height: 60% !important;*/
      width: 60% !important;
      margin: unset !important;
   }

   .swal2-icon {
     font-size: unset !important;
     width: 18% !important;
     height: 84% !important;
     margin-left: 180px !important;
}
</style>

</head>
<body>

   <!--preloader-->
   <div id="preloader">
      <div id="status"></div>
   </div>
   <!--end preloader-->


   @include('sweetalert::alert')

   <section class="vh-100">
    <div class="container-fluid h-custom">
     <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
       <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
       class="img-fluid" alt="Sample image">
    </div>
    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <div class="mb-3" id="lblGreetings"></div>
      <h5 class="mb-3">Please Sign in to continue..</h5>

      <form method="post" action="{{ route('login') }}">
         @csrf
         <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">User Name</label>
            <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid user name" autofocus/>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
         </div>
         <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" autofocus/>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
         </div>
         <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg lgBtn">Login</button>
         </div>
      </form>
   </div>
</div>
</div>
<div class="flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
   <div class="text-white text-center">
      Copyright © Jayawardena Network 2022. All rights reserved.
   </div>
</div>
</section>

 <!-- <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
             </label>
          </div>
          <a href="#!" class="text-body">Forgot password?</a>
       </div> -->


       <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" ></script>
       <script src="assets/bootstrap/js/popper.min.js" ></script>
       <script src="assets/plugins/lobipanel/js/jquery-ui.min.js" ></script>
       <script src="assets/plugins/lobipanel/js/jquery.ui.touch-punch-improved.js"></script>
       <script src="assets/plugins/lobipanel/js/tether.min.js" ></script>
       <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
       <script src="assets/plugins/lobipanel/js/lobicard.js" ></script>
       <script src="assets/plugins/lobipanel/js/highlight.js" ></script>
       <script src="assets/plugins/pace/pace.min.js" ></script>
       <script src="assets/plugins/table-export/tableExport.js" ></script>
       <script src="assets/plugins/table-export/jquery.base64.js" ></script>
       <script src="assets/plugins/table-export/html2canvas.js" ></script>
       <script src="assets/plugins/table-export/sprintf.js" ></script>
       <script src="assets/plugins/table-export/jspdf.js" ></script>
       <script src="assets/plugins/table-export/base64.js" ></script>
       <script src="assets/plugins/datatables/dataTables.min.js" ></script>
       <script src="assets/plugins/slimScroll/jquery.nicescroll.min.js" ></script>
       <script src="assets/plugins/fastclick/fastclick.min.js" ></script>
       <script src="assets/dist/js/custom.js" ></script>
       <script src="assets/plugins/chartJs/Chart.min.js" ></script>
       <script src="assets/plugins/counterup/waypoints.js" ></script>
       <script src="assets/plugins/counterup/jquery.counterup.min.js" ></script>
       <script src="assets/plugins/monthly/monthly.js" ></script>
       <script src="assets/dist/js/dashboard.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script src="assets/customized_scripts.js"></script>


       <script>
          var myDate = new Date();
          var hrs = myDate.getHours();

          var greet;

          if (hrs < 12)
           greet = 'Good Morning';
        else if (hrs >= 12 && hrs <= 17)
           greet = 'Good Afternoon';
        else if (hrs >= 17 && hrs <= 24)
           greet = 'Good Evening';

        document.getElementById('lblGreetings').innerHTML =
        '<h4><b>' + greet + '</b> and welcome to Dialog!</h4>';
     </script> 

  </body>
  </html>

