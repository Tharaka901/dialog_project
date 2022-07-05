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
                 <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update">Approve</i></button>
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
                 <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update">Approve</i></button>
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
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-plus m-r-5"></i> Approve Form</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">
                 <form class="form-horizontal">
                    <div class="row">
                       <!-- Text input-->
                       <div class="col-md-6 form-group">
                          <label class="control-label">Date</label>
                          <input type="date" placeholder="Date" class="form-control">
                       </div>
                       <div class="col-md-6 form-group">
                          <label class="control-label">Name</label>
                          <input type="text" placeholder="Name" class="form-control">
                       </div>
                       <div class="col-md-6 form-group">
                          <label class="control-label">Inhand</label>
                          <input type="text" placeholder="Description" class="form-control">
                       </div>
                       <div class="col-md-6 form-group">
                         <label class="control-label">Credit</label>
                         <input type="text" placeholder="Credit" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                         <label class="control-label">Credit Collection</label>
                         <input type="text" placeholder="Credit Collection" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                         <label class="control-label">Retailer Return</label>
                         <input type="text" placeholder="Retailer Return" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                         <label class="control-label">Banking</label>
                         <input type="text" placeholder="Banking" class="form-control">
                         <div style="margin-left: 25px">
                          <label class="control-label">Sampath</label>
                          <input type="text" placeholder="Sampath" class="form-control">
                       </div>
                       <div style="margin-left: 25px">
                          <label class="control-label">Peoples</label>
                          <input type="text" placeholder="Peples" class="form-control">
                       </div>
                       <div style="margin-left: 25px">
                          <label class="control-label">Cargills</label>
                          <input type="text" placeholder="Cargils" class="form-control">
                       </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="control-label">Direct Banking</label>
                      <input type="text" placeholder="Banking" class="form-control">
                      <div style="margin-left: 25px">
                       <label class="control-label">Sampath</label>
                       <input type="text" placeholder="Sampath" class="form-control">
                    </div>
                    <div style="margin-left: 25px">
                       <label class="control-label">Peoples</label>
                       <input type="text" placeholder="Peples" class="form-control">
                    </div>
                    <div style="margin-left: 25px">
                       <label class="control-label">Cargills</label>
                       <input type="text" placeholder="Cargils" class="form-control">
                    </div>
                 </div>
                 <div class="col-md-12 form-group user-form-group">
                    <div class="float-right">
                       <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                       <button type="submit" class="btn btn-add btn-sm">Approve</button>
                    </div>
                 </div>
              </div>
           </form>
        </div>
     </div>
  </div>
  <div class="modal-footer">
     <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>


</section>
<!-- /.content -->
</div>

@endsection
