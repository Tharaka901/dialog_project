@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="header-icon">
       <i class="fa fa-bar-chart"></i>
    </div>
    <div class="header-title">
       <h1>Pending DSR Summary </h1>
       <small></small>
    </div>
 </section>
 <!-- Main content -->


 <section class="content" style="position: relative;padding: 12px 30px;margin-bottom: -190px;">
  <form action="{{ route('search_pending_dsr') }}" method="get">
   @csrf
   <div class="row">
      <div class="col-lg-4">
         <input placeholder="Search" type="text" class="form-control" id="name" name="name" value="{{ request()->get('name') }}">
      </div>

      <div class="col-lg-2">
         <input type="submit" class="btn btn-sm btn-success" value="Search">
      </div>
   </div>
</form>
</section>



<section class="content">
 <div class="row">

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
               <th>Variance</th>
               <th>Actions</th>
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
               <td> {{ number_format($dd->sales_sum,2)  }}</td>
               <td> {{ number_format($dd->inhand_sum,2)  }}</td>
               <td> {{ number_format($dd->banking_sum,2)  }}</td>
               <td> {{ number_format($dd->direct_banking_sum,2)  }}</td>
               <td> {{ number_format($dd->credit_sum,2)  }}</td>
               <td> {{ number_format($dd->retialer_sum ,2) }}</td>
               <td> {{ number_format($dd->credit_collection_sum,2)  }}</td>
               <td> {{ number_format( (($dd->sales_sum + $dd->credit_collection_sum) - ($dd->inhand_sum + $dd->banking_sum + $dd->direct_banking_sum + $dd->credit_sum)),2 ) }}</td>
               <td class="text-center">
                  <button type="button" class="btn btn-add btn-sm" onclick="viewDsr({{ $dd->id  }},{{ $dd->dsr_id  }},{{ $dd->status  }});"><i class="fa fa-pencil"></i></button>
                  @if($dd->status == 0)
                  <button type="button" class="btn btn-danger btn-sm" disabled onclick="rejectApprove({{ $dd->id  }},{{ $dd->dsr_id  }},{{ $dd->status  }});"><i class="fa fa-times"></i></button>
                  @else
                  <a href="{{ url('reject_approve/'.$dd->id) }}" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i>
                 </a>
                 @endif
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
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="contact" aria-selected="false">Banking</a>
                 </li>
                 <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#direct_banking" role="tab" aria-controls="contact" aria-selected="false">Direct Banking</a>
                 </li>
                 <li class="nav-item">
                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#credit" role="tab" aria-controls="home" aria-selected="true">Credit</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ret_return" role="tab" aria-controls="contact" aria-selected="false">Retailer Return</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#credit_collection" role="tab" aria-controls="profile" aria-selected="false">Credit Collection</a>
              </li>
           </ul>

           <div class="tab-content" id="myTabContent">

            <input type="hidden" value="0" id="txt_drs_id">
            <input type="hidden" value="0" id="txt_pending_sum_id">
            <input type="hidden" value="0" id="txt_pending_sum_status">
            <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="contact-tab">

               <div class="table-responsive mt-3">
                <table id="salesTable" class="table table-bordered table-striped table-hover">
                   <thead class="back_table_color">
                      <tr class="info">
                         <th>#</th>
                         <th style='display:none;'>Id</th>
                         <th>Item Name</th>
                         <th>Quantity</th>
                         <th>Amount</th>
                         <th>Total</th>
                         <th style='display:none;'>Item Id</th>
                         <th style='display:none;'>Sum Id</th>
                         <th style='display:none;'>Dsr Id</th>
                         <th style='display:none;'>Dsr Stock Id</th>
                         <th>Remove</th>
                      </tr>
                   </thead>
                   <tbody>
                   </tbody>
                </table>
             </div>

             <div class="float-right">
               <div class="input-group mb-3 group-end text-end">
                  <button class="btn btn-info text-white" id="btnSaleEdit">Edit</button>
                  <a class="btn btn-add btnNext text-white">Next</a>
               </div>
            </div>
         </div>

         <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="contact-tab">

            <div class="row">
               <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                  <div class="table-responsive mt-3">
                   <table id="inHandTable" class="table table-bordered table-striped table-hover">
                      <thead class="back_table_color">
                         <tr class="info">
                            <th>#</th>
                            <th style='display:none;'>Id</th>
                            <th>In-Hand</th>
                            <th>Cash</th>
                            <th>Cheque</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                      </tbody>
                   </table>
                </div>
             </div>
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
               <div class="table-responsive mt-3">
                <table id="inHandChequeTable" class="table table-bordered table-striped table-hover">
                   <thead class="back_table_color">
                      <tr class="info">
                         <th>#</th>
                         <th style='display:none;'>Id</th>
                         <th>Cheque No</th>
                         <th>Cheque Amount</th>
                         <th>Remove</th>
                      </tr>
                   </thead>
                   <tbody>
                   </tbody>
                </table>
             </div>
          </div>
       </div>

       <div class="float-right">
         <div class="input-group mb-3 group-end">
          <button class="btn btn-info text-white" id="btnInhandEdit">Edit</button>
          <a class="btn btn-danger btnPrevious text-white">Previous</a>
          <a class="btn btn-add btnNext text-white">Next</a>
       </div>
    </div>
 </div>

 <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="home-tab">

  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="table-responsive mt-3">
          <table id="creditTable" class="table table-bordered table-striped table-hover">
             <thead class="back_table_color">
                <tr class="info">
                 <th>#</th>
                 <th style="display: none">id</th>
                 <th style='display: none'>Old Customer Name</th>
                 <th>Customer Name</th>
                 <th style='display: none'>Old Amount</th>
                 <th>Amount</th>
                 <th>Remove</th>
              </tr>
           </thead>
           <tbody>
           </tbody>
        </table>
     </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
     <div class="table-responsive mt-3">
      <table id="creditItemTable" class="table table-bordered table-striped table-hover">
       <thead class="back_table_color">
          <tr class="info">
           <th>#</th>
           <th style="display: none">id</th>
           <th style="display: none">credit_id</th>
           <th>Item</th>
           <th>Price</th>
           <th>Old Price</th>
           <th>Remove</th>
        </tr>
     </thead>
     <tbody>
     </tbody>
  </table>
</div>
</div>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
     <button class="btn btn-info text-white" id="btnCreditEdit">Edit</button>
     <a class="btn btn-danger btnPrevious text-white">Previous</a>
     <a class="btn btn-add btnNext text-white">Next</a>
  </div>
</div>
</div>

<div class="tab-pane fade" id="credit_collection" role="tabpanel" aria-labelledby="profile-tab">

  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="table-responsive mt-3">
          <table id="creditCollectionTable" class="table table-bordered table-striped table-hover">
             <thead class="back_table_color">
                <tr class="info">
                 <th>#</th>
                 <th style='display:none'>id</th>
                 <th style='display: none'>Old Customer Name</th>
                 <th>Customer Name</th>
                 <th style='display: none'>Old Amount</th>
                 <th>Amount</th>
                 <th>Option</th>
                 <th>Remove</th>
              </tr>
           </thead>
           <tbody>
           </tbody>
        </table>
     </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
     <div class="table-responsive mt-3">
      <table id="creditCollectionItemTable" class="table table-bordered table-striped table-hover">
       <thead class="back_table_color">
          <tr class="info">
           <th>#</th>
           <th style="display: none">id</th>
           <th style="display: none">credit_collection_id</th>
           <th>Item</th>
           <th>Price</th>
           <th>Old Price</th>
           <th>Remove</th>
        </tr>
     </thead>
     <tbody>
     </tbody>
  </table>
</div>
</div>
</div>

<div class="float-right">
   <div class="input-group mb-3 group-end">
     <button class="btn btn-info text-white" id="btnCreditColEdit">Edit</button>
     <a class="btn btn-danger btnPrevious text-white">Previous</a>
     <button type="button" class="btn btn-add btnSubmit text-white" id="btnDsrApprove">Approve</button>
  </div>
</div>

</div>


<div class="tab-pane fade" id="ret_return" role="tabpanel" aria-labelledby="contact-tab">
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
              <th>Total</th>
              <th style='display:none'>dsr_stock_id</th>
              <th>Remove</th>
           </tr>
        </thead>
        <tbody>
        </tbody>
     </table>
  </div>

  <div class="float-right">
   <div class="input-group mb-3 group-end">
     <button class="btn btn-info text-white" id="btnRetailerEdit">Edit</button>
     <a class="btn btn-danger btnPrevious text-white">Previous</a>
     <a class="btn btn-add btnNext text-white">Next</a>
  </div>
</div>
</div>

<div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="contact-tab">

   <div class="table-responsive mt-3">
     <table id="bankTable" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
             <th>#</th>
             <th style='display:none;'>id</th>
             <th>Bank Name</th>
             <th style='display:none;'>Old Ref #</th>
             <th>Ref #</th>
             <th style='display:none;'>Old Amount</th>
             <th>Amount</th>
             <th style='display:none;'>Bank_id</th>
             <th>Remove</th>
          </tr>
       </thead>
       <tbody>
       </tbody>
    </table>
 </div>

 <div class="float-right">
   <div class="input-group mb-3 group-end">
     <button class="btn btn-info text-white" id="btnBankEdit">Edit</button>
     <a class="btn btn-danger btnPrevious text-white">Previous</a>
     <a class="btn btn-add btnNext text-white">Next</a>
  </div>
</div>
</div>

<div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">

   <div class="table-responsive mt-3">
     <table id="directBankTable" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
             <th>#</th>
             <th style='display:none;'>id</th>
             <th>Customer Name</th>
             <th>Bank Name</th>
             <th style='display:none;'>Old Ref #</th>
             <th>Ref #</th>
             <th style='display:none;'>Old Amount</th>
             <th>Amount</th>
             <th style='display:none;'>Bank_id</th>
             <th>Remove</th>
          </tr>
       </thead>
       <tbody>
       </tbody>
    </table>
 </div>

 <div class="float-right">
   <div class="input-group mb-3 group-end">
      <button class="btn btn-info text-white" id="btnDBankEdit">Edit</button>
      <a class="btn btn-danger btnPrevious text-white">Previous</a>
      <a class="btn btn-add btnNext text-white">Next</a>
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
