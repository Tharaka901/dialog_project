<?php
if(!Session::has('user_id')){
   header("Location: https://jayawardenanetwork.lk");
  die();
}
?>
<div class="wrapper">
 <header class="main-header">
    <a href="/" class="logo">
       <!-- Logo -->
       <span class="logo-mini">
          <img src="assets/dist/img/dialog.png" alt="">
       </span>
       <span class="logo-lg">
          <img src="assets/dist/img/dialog.png" alt="">
       </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-expand py-0">
       <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <!-- Sidebar toggle button-->
          <span class="sr-only">Toggle navigation</span>
          <span class="pe-7s-angle-left-circle"></span>
       </a>
       <!-- searchbar-->
       <a href="#search"><span class="pe-7s-search"></span></a>
       <div id="search">
          <button type="button" class="close">×</button>
          <form>
             <input type="search" value="" placeholder="Search.." />
             <button type="submit" class="btn btn-add">Search...</button>
          </form>
       </div>
       <div class="collapse navbar-collapse navbar-custom-menu" >
         <ul class="navbar-nav ml-auto">
          <!-- User -->
          <li style="color: white;padding-top: 15px;">
            <h6>
               @if(session()->get('user_name'))
               Welcome: {{ session()->get('user_name') }}
               @endif
            </h6>
         </li>
         <li class="nav-item dropdown dropdown-user">
            <a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="assets/dist/img/avatar5.png" class="rounded-circle" width="50" height="50" alt="user"></a>
              <div class="dropdown-menu drop_down">
               <div class="menus">
               <!--   <a class="dropdown-item" href="#"><i class="fa fa-user"></i> User Profile</a>
                <a class="dropdown-item" href="#"><i class="fa fa-inbox"></i> Inbox</a> -->
                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Signout</a>
             </div>
          </div>
       </li>
    </ul>
 </div>
</nav>
</header>
<!-- =============================================== -->
