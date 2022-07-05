@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-undo"></i>
     </div>
     <div class="header-title">
        <h1>Return Inventry</h1>
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
         <a href="#"> <h4>DSR Return</h4></a>
      </div>
   </div>
   <div class="card-body">

    <div class="table-responsive">
     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>Date & Time</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Approve</th>
           </tr>
        </thead>
        <tbody>
           <tr>
              <td>28/06/2022</td>
              <td>Chathuranga</td>
              <td>Rs.450,000.00</td>
              <td>
                 <button type="button" class="btn btn-add btn-sm text-center" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
              </td>
           </tr>
           <tr>
              <td>28/06/2022</td>
              <td>Viduranga</td>
              <td>Rs.650,000.00</td>
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
        <div class="col-lg-12 pinpin">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Return Items</h4>
                    </div>
                </div>
                <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                           <thead class="back_table_color">
                              <tr class="info">
                                 <th>Item Name</th>
                                 <th style="width: 100px">Qty</th>
                                 <th>Amount</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Internet Card 49</td>
                                 <td>100</td>
                                 <td>4,900.00</td>
                              </tr>
                              <tr>
                                <td>Internet Card 99</td>
                                <td>1000</td>
                                <td>99,000.00</td>
                             </tr>
                             <tr>
                                <td>KIT 50</td>
                                <td>500</td>
                                <td>25,000.00</td>
                             </tr>
                             <tr>
                                <td>KIT 100</td>
                                <td>500</td>
                                <td>50,000.00</td>
                             </tr>
                             <tr>
                                <td>Dialog TV</td>
                                <td>5</td>
                                <td>75,000.00</td>
                             </tr>
                           </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-add"><i class="fa fa-check"></i>Approve
                            </button>
                         </div>
                     </div>
                  </div>
            </div>
        </div>



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
