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
            <th>#</th>
            <th>Date</th>
            <th>Name</th>
            <th>Sales</th>
            <th>Inhand</th>
            <th>Banking</th>
            <th>Direct Banking</th>
            <th>Credit</th>
            <th>Retailer Return</th>
            <th>Credit Collection</th>
            <th>Variation</th>
            <th>Approve</th>
         </tr>
      </thead>
      <tbody>

         @if($dsrData)
         <?php $count = 1; ?>
         @foreach($dsrData as $dd)

         <tr>
            <td><?php echo $count ?></td>
            <td>{{ $dd->date }}</td>
            <td>{{ $dd->name }}</td>
            <td>Rs. {{ number_format($dd->sales_sum,2)  }}</td>
            <td>Rs. {{ number_format($dd->inhand_sum,2)  }}</td>
            <td>Rs. {{ number_format($dd->banking_sum,2)  }}</td>
            <td>Rs. {{ number_format($dd->direct_banking_sum,2)  }}</td>
            <td>Rs. {{ number_format($dd->credit_sum,2)  }}</td>
            <td>Rs. {{ number_format($dd->retialer_sum ,2) }}</td>
            <td>Rs. {{ number_format($dd->credit_collection_sum,2)  }}</td>
            <td>Rs. {{ number_format( (($dd->sales_sum + $dd->credit_collection_sum) - ($dd->inhand_sum + $dd->banking_sum + $dd->direct_banking_sum + $dd->credit_sum)),2 ) }}</td>
            <td class="text-center">
               <button type="button" class="btn btn-add btn-sm" onclick="viewDsr({{ $dd->id  }},{{ $dd->dsr_id  }});"><i class="fa fa-pencil"></i></button>
            </td>
         </tr>
         <?php $count++ ?>

         @endforeach
         @endif

      </tbody>
   </table>



</div>

<div class="d-flex justify-content-center">
 <div>{!! $dsrData->links() !!}</div>
</div>


</div>
</div>
</div>
</div>


<!-- Modal1 -->
<div class="modal fade" id="dsrModal" tabindex="-1" role="dialog">
   <div class="modal-xl modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-plus m-r-5"></i> Approve Form</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">

               <form class="mt-3" method="post" id="dsrSave">

                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                     <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="contact" aria-selected="false">Sales</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="contact-tab" data-toggle="tab" href="#day" role="tab" aria-controls="contact" aria-selected="false">In-Hand</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="home-tab" data-toggle="tab" href="#credit" role="tab" aria-controls="home" aria-selected="true">Credit</a>
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

               <input type="hidden" value="0" id="txt_drs_id">
               <input type="hidden" value="0" id="txt_pending_sum_id">
               <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="contact-tab">
                <!--  <div class="mt-3">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Item Name</label>
                     <input type="text" class="form-control" id="sale_item_name" name="sale_item_name">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Amount</label>
                     <input type="text" class="form-control" id="sale_amount" name="sale_amount">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Quantity</label>
                     <input type="text" class="form-control" id="sale_qty" name="sale_qty">
                  </div>
               </div> -->

               <div class="table-responsive mt-3">
                 <table id="salesTable" class="table table-bordered table-striped table-hover">
                    <thead class="back_table_color">
                       <tr class="info">
                          <th>#</th>
                          <th style="display:none">">Item Id</th>
                          <th>Item Name</th>
                          <th>Quantity</th>
                          <th>Amount</th>
                       </tr>
                    </thead>
                    <tbody>
                    </tbody>
                 </table>
              </div>

              <div class="float-right">
               <div class="input-group mb-3 group-end text-end">
                  <a class="btn btn-add btnNext text-white">Next</a>
               </div>
            </div>
         </div>

         <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="contact-tab">
          <!-- <div class="mt-3">
            <div class="form-group">
               <label for="exampleInputEmail1">Inhand</label>
               <input type="text" class="form-control" id="day_inhand" name="day_inhand">
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1">Cash</label>
               <input type="text" class="form-control" id="day_cash" name="day_cash">
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1">Cheque</label>
               <input type="text" class="form-control" id="day_cheque" name="day_cheque">
            </div>
         </div> -->

         <div class="table-responsive mt-3">
           <table id="inHandTable" class="table table-bordered table-striped table-hover">
              <thead class="back_table_color">
                 <tr class="info">
                    <th>#</th>
                    <th style='display:none;'>Id</th>
                    <th>In-Hand</th>
                    <th>Cash</th>
                    <th>Cheque</th>
                 </tr>
              </thead>
              <tbody>
              </tbody>
           </table>
        </div>

        <div class="float-right">
         <div class="input-group mb-3 group-end">
            <a class="btn btn-danger btnPrevious text-white">Previous</a>
            <a class="btn btn-add btnNext text-white">Next</a>
         </div>
      </div>
   </div>

   <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="home-tab">
     <!-- <div class="mt-3">
        <div class="form-group">
          <label for="exampleInputEmail1">Customer Name</label>
          <input type="text" class="form-control" id="credit_customer_name" name="credit_customer_name">
       </div>
       <div class="form-group">
          <label for="exampleInputPassword1">Amount</label>
          <input type="text" class="form-control" id="credit_amount" name="credit_amount">
       </div>
    </div> -->

    <div class="table-responsive mt-3">
     <table id="creditTable" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>#</th>
              <th style="display: none">id</th>
              <th>Customer Name</th>
              <th>Amount</th>
           </tr>
        </thead>
        <tbody>
        </tbody>
     </table>
  </div>

  <div class="float-right">
   <div class="input-group mb-3 group-end">
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <a class="btn btn-add btnNext text-white">Next</a>
   </div>
</div>
</div>

<div class="tab-pane fade" id="credit_collection" role="tabpanel" aria-labelledby="profile-tab">
   <!-- <div class="mt-3">
      <div class="form-group">
       <label for="exampleInputEmail1">Customer Name</label>
       <input type="text" class="form-control" id="credit_collection_customer_name" name="credit_collection_customer_name">
    </div>
    <div class="form-group">
       <label for="exampleInputPassword1">Amount</label>
       <input type="text" class="form-control" id="credit_collection_amount" name="credit_collection_amount">
    </div>
 </div> -->

 <div class="table-responsive mt-3">
  <table id="creditCollectionTable" class="table table-bordered table-striped table-hover">
     <thead class="back_table_color">
        <tr class="info">
           <th>#</th>
           <th style='display:none'>id</th>
           <th>Customer Name</th>
           <th>Amount</th>
        </tr>
     </thead>
     <tbody>
     </tbody>
  </table>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <a class="btn btn-add btnNext text-white">Next</a>
   </div>
</div>
</div>

<div class="tab-pane fade" id="ret_return" role="tabpanel" aria-labelledby="contact-tab">
   <!-- <div class="mt-3">
      <div class="form-group">
        <label for="exampleInputEmail1">Customer Name</label>
        <input type="text" class="form-control" id="ret_return_customer_name" name="ret_return_customer_name">
     </div>
     <div class="form-group">
        <label for="exampleInputPassword1">Amount</label>
        <input type="text" class="form-control" id="ret_return_amount" name="ret_return_amount">
     </div>
     <div class="form-group">
      <label for="exampleInputPassword1">Quantity</label>
      <input type="text" class="form-control" id="ret_return_qty" name="ret_return_qty">
   </div>
</div> -->

<div class="table-responsive mt-3">
 <table id="retailerTable" class="table table-bordered table-striped table-hover">
    <thead class="back_table_color">
       <tr class="info">
          <th>#</th>
          <th style='display:none'>id</th>
          <th>Customer Name</th>
          <th style='display:none'>Item Id</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Amount</th>
       </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <a class="btn btn-add btnNext text-white">Next</a>
   </div>
</div>
</div>

<div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="contact-tab">
   <!-- <div class="mt-3">
      <div class="form-group">
         <label for="exampleInputEmail1">Bank Name</label>
         <input type="text" class="form-control" id="bank_name" name="bank_name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Ref #</label>
        <input type="text" class="form-control" id="bank_ref_no" name="bank_ref_no">
     </div>
     <div class="form-group">
      <label for="exampleInputPassword1">Amount</label>
      <input type="text" class="form-control" id="bank_amount" name="bank_amount">
   </div>
</div> -->

<div class="table-responsive mt-3">
 <table id="bankTable" class="table table-bordered table-striped table-hover">
    <thead class="back_table_color">
       <tr class="info">
          <th>#</th>
          <th style='display:none;'>id</th>
          <th>Bank Name</th>
          <th>Ref #</th>
          <th>Amount</th>
       </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <a class="btn btn-add btnNext text-white">Next</a>
   </div>
</div>
</div>

<div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">
 <!-- <div class="mt-3">
   <div class="form-group">
      <label for="exampleInputEmail1">Bank Name</label>
      <input type="text" class="form-control" id="direct_banking_name" name="direct_banking_name">
   </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Ref #</label>
    <input type="text" class="form-control" id="direct_banking_ref_no" name="direct_banking_ref_no">
 </div>
 <div class="form-group">
   <label for="exampleInputPassword1">Amount</label>
   <input type="text" class="form-control" id="direct_banking_amount" name="direct_banking_amount">
</div>
<div class="form-group">
   <label for="exampleInputPassword1">Customer Name</label>
   <input type="text" class="form-control" id="direct_banking_customer" name="direct_banking_customer">
</div>
</div> -->

<div class="table-responsive mt-3">
 <table id="directBankTable" class="table table-bordered table-striped table-hover">
    <thead class="back_table_color">
       <tr class="info">
          <th>#</th>
          <th style='display:none;'>id</th>
          <th>Customer Name</th>
          <th>Bank Name</th>
          <th>Ref #</th>
          <th>Amount</th>
       </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <button type="button" class="btn btn-add btnSubmit text-white" id="btnDsrApprove">Approve</button>
   </div>
</div>
</div>



</div>
</form>


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
