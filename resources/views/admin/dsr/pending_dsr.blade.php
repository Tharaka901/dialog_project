@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-bar-chart"></i>
     </div>
     <div class="header-title">
        <h1>Pending DSR Summery </h1>
        <small></small>
     </div>
  </section>
  <!-- Main content -->
  <section class="content">
     <div class="row">
       <div class="col-md-3">
         <div class="position-relative form-group"><label
          for="search" class="">Search</label><input
          name="search"
          placeholder="Search" type="text" class="form-control">
       </div>
    </div>
    <div class="col-md-3">
      <div class="position-relative form-group"><label
       for="fromdate" class="">From</label><input
       name="fromdate" id="fromdate" placeholder="Date"
       type="date" class="form-control">
    </div>
 </div>
 <div class="col-md-3">
   <div class="position-relative form-group"><label
    for="todate" class="">To</label><input
    name="todate" id="todate" placeholder="Date"
    type="date" class="form-control">
 </div>
</div>

<!-- running time -->
<div class="col-lg-12 pinpin">
  <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
    <div class="card-header">
      <div class="card-title custom_title">
         <a href="#"> <h4>Pending DSR Details</h4></a>
      </div>
   </div>
   <div class="card-body">

    <div class="table-responsive">
     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>Date</th>
              <th>Name</th>
              <th>Sales</th>
              <th>Inhand</th>
              <th>Banking</th>
              <th>Direct Banking</th>
              <th>Credit</th>
              <th>Retailer Return</th>
              <th>Credit Collection</th>
              <th>Approve</th>
           </tr>
        </thead>
        <tbody>
           <tr>
              <td>28/06/2022</td>
              <td>Chathuranga</td>
              <td>Rs.450,000.00</td>
              <td>Rs.150,000.00</td>
              <td>Rs.300,000.00</td>
              <td>Rs. 50,000.00</td>
              <td>Rs.100,000.00</td>
              <td> 00</td>
              <td>Rs.150,000.00</td>
              <td>
                 <button type="button" class="btn btn-add btn-sm text-center" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
              </td>
           </tr>
           <tr>
              <td>28/06/2022</td>
              <td>Viduranga</td>
              <td>Rs.650,000.00</td>
              <td>Rs. 50,000.00</td>
              <td>Rs.400,000.00</td>
              <td>Rs. 50,000.00</td>
              <td>Rs.100,000.00</td>
              <td> 00</td>
              <td>Rs.150,000.00</td>
              <td>
                 <button type="button" class="btn btn-add btn-sm text-center" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
              </td>
           </tr>
        </tbody>
     </table>
  </div>
</div>
</div>
</div>
</div>


<!-- Modal1 -->
<div class="modal fade" id="update" tabindex="-1" role="dialog">
   <div class="modal-lg modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-plus m-r-5"></i> Approve Form</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">

               <ul class="nav nav-tabs" id="myTab" role="tablist">
                 <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#credit" role="tab" aria-controls="home" aria-selected="true">Credit</a>
               </li>
               <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#credit_collection" role="tab" aria-controls="profile" aria-selected="false">Credit Collection</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ret_return" role="tab" aria-controls="contact" aria-selected="false">Retailer Return</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="contact" aria-selected="false">Banking</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#direct_banking" role="tab" aria-controls="contact" aria-selected="false">Direct Banking</a>
             </li>
          </ul>

          <div class="tab-content" id="myTabContent">

            <form action="#" method="post">
               <div class="tab-pane fade show active" id="credit" role="tabpanel" aria-labelledby="home-tab">
                  <p>Credit</p>
                  <div class="input-group mb-3 group-end text-end">
                     <a class="btn btn-add btnNext text-white">Next</a>
                  </div>
               </div>
               <div class="tab-pane fade" id="credit_collection" role="tabpanel" aria-labelledby="profile-tab">
                <p>Credit Collection</p>
                <div class="input-group mb-3 group-end">
                  <a class="btn btn-danger btnPrevious text-white">Previous</a>
                  <a class="btn btn-add btnNext text-white">Next</a>
               </div>
            </div>
            <div class="tab-pane fade" id="ret_return" role="tabpanel" aria-labelledby="contact-tab">
             <p>R Return</p>
             <div class="input-group mb-3 group-end">
               <a class="btn btn-danger btnPrevious text-white">Previous</a>
               <a class="btn btn-add btnNext text-white">Next</a>
            </div>
         </div>
         <div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="contact-tab">
            <p>Banking</p>
            <div class="input-group mb-3 group-end">
               <a class="btn btn-danger btnPrevious text-white">Previous</a>
               <a class="btn btn-add btnNext text-white">Next</a>
            </div>
         </div>
         <div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">
            <p>Direct Banking</p>
            <div class="input-group mb-3 group-end">
               <a class="btn btn-danger btnPrevious text-white">Previous</a>
               <a class="btn btn-add btnSubmit text-white">Submit</a>
            </div>
         </div>
      </form>

   </div>

</div>
</div>
</div>


</div>
</div>
</div>


</section>
<!-- /.content -->
</div>

@endsection
