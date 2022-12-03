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
            <i class="fa fa-users"></i><span>Manage Users</span>
            <span class="pull-right-container">
               <i class="fa fa-angle-left float-right"></i>
            </span>
         </a>
         <ul class="treeview-menu active">
            <li class="active">
              <li><a href="{{ asset('/user') }}">View Users</a></li>
           </li>
        </ul>
     </li>

     <li class="treeview">
      <a href="#">
         <i class="fa fa-users"></i><span>Manage Banks</span>
         <span class="pull-right-container">
            <i class="fa fa-angle-left float-right"></i>
         </span>
      </a>
      <ul class="treeview-menu active">
         <li class="active">
          <li><a href="{{ asset('/bank') }}">Add Banks</a></li>
       </li>
    </ul>
 </li>

 <li class="treeview">
   <a href="#">
      <i class="fa fa-shopping-bag"></i><span>Manage Items</span>
      <span class="pull-right-container">
         <i class="fa fa-angle-left float-right"></i>
      </span>
   </a>
   <ul class="treeview-menu active">
      <li class="active">
        <li><a href="{{ asset('/item') }}">Item List</a></li>
        <li><a href="{{ asset('/send_inventry') }}">Send Inventory</a></li>
        <li><a href="{{ asset('/dsr_receive') }}">DSR Returns</a></li>
        <li><a href="{{ asset('/transfer_status') }}">Transfer Status</a></li>
        <li><a href="{{ asset('/view_balance') }}">View Balance</a></li>
     </li>
  </ul>
</li>

<li class="treeview">
   <a href="#">
      <i class="fa fa-list-alt"></i><span>Day Summaries</span>
      <span class="pull-right-container">
         <i class="fa fa-angle-left float-right"></i>
      </span>
   </a>
   <ul class="treeview-menu active">
      <li class="active">
         <li><a href="{{ asset('/pending_dsr') }}">Pending DSR Summary</a></li>
         <li><a href="{{ asset('/complete_dsr') }}">Complete DSR Summary</a></li>
      </li>
   </ul>
</li>

<li class="treeview">
   <a href="#">
      <i class="fa fa-file"></i><span>Reports</span>
      <span class="pull-right-container">
         <i class="fa fa-angle-left float-right"></i>
      </span>
   </a>
   <ul class="treeview-menu active">
      <li class="active">
         <li><a href="{{ asset('/collection') }}">Collection</a></li>
         <li><a href="{{ asset('/banking_details') }}">Banking</a></li>
         <li><a href="{{ asset('/additional_details') }}">Additional Details</a></li>
      </li>
   </ul>
</li>

</ul>
</div>
<!-- /.sidebar -->
</aside>
