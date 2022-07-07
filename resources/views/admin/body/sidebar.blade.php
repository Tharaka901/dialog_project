<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
       <!-- sidebar menu -->
       <ul class="sidebar-menu">
          <li class="active">
             <a href="{{ asset('/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span>
             <span class="pull-right-container">
             </span>
             </a>
          </li>
          <li class="treeview">
             <a href="#">
             <i class="fa fa-user"></i><span>Manage User</span>
             <span class="pull-right-container">
             <i class="fa fa-angle-left float-right"></i>
             </span>
             </a>
             <ul class="treeview-menu">
                <li><a href="{{ asset('/user') }}">View User</a></li>
             </ul>
          </li>
          <li class="treeview">
             <a href="#">
             <i class="fa fa-list-alt"></i><span>Manage Item</span>
             <span class="pull-right-container">
             <i class="fa fa-angle-left float-right"></i>
             </span>
             </a>
             <ul class="treeview-menu">
                <li><a href="{{ asset('/item') }}">Item List</a></li>
             </ul>
             <ul class="treeview-menu">
                <li><a href="{{ asset('/send_inventry') }}">Send Inventry</a></li>
             </ul>
             <ul class="treeview-menu">
                 <li><a href="{{ asset('/dsr_receive') }}">DSR Receive</a></li>
             </ul>
             <ul class="treeview-menu">
                <li><a href="{{ asset('/transfer_status') }}">Transfer Status</a></li>
            </ul>
             <ul class="treeview-menu">
                 <li><a href="{{ asset('/view_balance') }}">View Balance</a></li>
             </ul>
          </li>
          <li class="treeview">
            <a href="#">
            <i class="fa fa-folder"></i><span>Day Summery</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left float-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{ asset('/pending_dsr') }}">Pending DSR Summery</a></li>
            </ul>
            <ul class="treeview-menu">
                <li><a href="{{ asset('/complete_dsr') }}">Complete DSR Summery</a></li>
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
            <i class="fa fa-file"></i><span>Report</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left float-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{ asset('/sales_summery') }}">Sales Summery</a></li>
            </ul>
            <ul class="treeview-menu">
                <li><a href="{{ asset('/collection') }}">Collection</a></li>
            </ul>
         </li>

       </ul>
    </div>
    <!-- /.sidebar -->
 </aside>
