@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-folder"></i>
        <small></small>
     </div>
     <div class="header-title">
        <h1>Complete DSR Summary </h1>
     </div>
  </section>
  <!-- Main content -->
  <section class="content">
     <div class="">

      <form action="{{ route('search_complete_dsr') }}" method="get">
         @csrf
         <div class="row">
            <div class="col-lg-4">
               <input placeholder="Search" type="text" class="form-control" id="name" name="name" style="margin-left: 14px;margin-bottom: 10px;" value="{{ request()->get('name') }}">
            </div>
            <div class="col-lg-3">
             <input name="from"  placeholder="Date" type="date" class="form-control" id="from" style="margin-left: 14px;margin-bottom: 10px;" value="{{ request()->get('from') }}">
          </div>

          <div class="col-lg-3">
            <input name="to"  placeholder="Date" type="date" class="form-control" id="to" style="margin-left: 14px;margin-bottom: 10px;" value="{{ request()->get('to') }}">
         </div>

         <div class="col-lg-2">
            <input type="submit" class="btn btn-sm btn-success" value="Search">
         </div>
      </div>
   </form>



   <!-- running time -->
   <div class="col-lg-12 pinpin">
     <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
       <div class="card-header">
         <div class="card-title custom_title">
            <a href="#"> <h4>Complete DSR Details</h4></a>
         </div>
      </div>
      <div class="card-body">

        <!-- Plugin content:pdf,excel -->
           <!-- <div class="btn-group">
              <button class="btn btn-exp btn-sm" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
              <ul class="dropdown-menu exp-drop" role="menu">
                <li class="dropdown-divider"></li>
                <li>
                  <a href="#" onclick="$('#dataTableExample1').tableExport({type:'xlsx',escape:'false'});">
                     <img src="assets/dist/img/excel.png" width="24" alt="logo"> Excel</a>
                  </li>
                  <li>
                     <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                        <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                     </li>
                  </ul>
               </div> -->
               <!-- ./Plugin content:pdf,excel -->


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
                        <th>View</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if($dsrData)
                     
                     @foreach($dsrData as $dd)

                     <tr>
                        <td>{{ $dd->id }}</td>
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
                           <button type="button" class="btn btn-add btn-sm" onclick="viewCompleteDsr({{ $dd->id  }},{{ $dd->dsr_id  }},{{ $dd->status  }});"><i class="fa fa-eye"></i></button>
                        </td>
                     </tr>
                     

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
</section>
<!-- /.content -->
</div>


<div class="modal" tabindex="-1" role="dialog" id="dsrCompleteModal">
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">Complete Dsr Details</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
     </button>
  </div>
  <div class="modal-body">

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
       <table id="salesTable1" class="table table-bordered table-striped table-hover">
          <thead class="back_table_color">
             <tr class="info">
                <th>#</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Total</th>
             </tr>
          </thead>
          <tbody>
          </tbody>
       </table>
    </div>

 </div>

 <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="contact-tab">

   <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <div class="table-responsive mt-3">
            <table id="inHandTable1" class="table table-bordered table-striped table-hover">
               <thead class="back_table_color">
                  <tr class="info">
                     <th>#</th>
                     <th>In-Hand</th>
                     <th>Cash</th>
                     <th>Cheque</th>
                     <th>View</th>
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
                     <th style="display:none;">Id</th>
                     <th>Cheque No</th>
                     <th>Cheque Amount</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>

</div>

<div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="home-tab">

  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="table-responsive mt-3">
          <table id="creditTable1" class="table table-bordered table-striped table-hover">
             <thead class="back_table_color">
                <tr class="info">
                   <th>#</th>
                   <th>Customer Name</th>
                   <th>Amount</th>
                   <th>View</th>
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
        </tr>
     </thead>
     <tbody></tbody>
  </table>
</div>
</div>
</div>

</div>

<div class="tab-pane fade" id="credit_collection" role="tabpanel" aria-labelledby="profile-tab">

  <div class="row">

   <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="table-responsive mt-3">
       <table id="creditCollectionTable1" class="table table-bordered table-striped table-hover">
          <thead class="back_table_color">
             <tr class="info">
                <th>#</th>
                <th>Customer Name</th>
                <th>Amount</th>
                <th>View</th>
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
        <th>Item</th>
        <th>Price</th>
     </tr>
  </thead>
  <tbody></tbody>
</table>
</div>
</div>

</div>

</div>


<div class="tab-pane fade" id="ret_return" role="tabpanel" aria-labelledby="contact-tab">
   <div class="table-responsive mt-3">
     <table id="retailerTable1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>#</th>
              <th>Customer Name</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Amount</th>
              <th>Total</th>
           </tr>
        </thead>
        <tbody>
        </tbody>
     </table>
  </div>

</div>

<div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="contact-tab">

   <div class="table-responsive mt-3">
     <table id="bankTable1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>#</th>
              <th>Bank Name</th>
              <th>Ref #</th>
              <th>Amount</th>
           </tr>
        </thead>
        <tbody>
        </tbody>
     </table>
  </div>


</div>

<div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">

   <div class="table-responsive mt-3">
     <table id="directBankTable1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>#</th>
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

</div>



</div>
</form>


</div>


</div>
</div>
</div>

@endsection
