@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-dashboard"></i>
     </div>
     <div class="header-title">
        <h1>Jayawardena Network Dashboard</h1>
        <small></small>
     </div>
  </section>
  <!-- Main content -->

  <section class="content">
     <div class="row">
       <div class=" col-sm-12 col-md-6 col-lg-3">
        <div id="cardbox1">
           <div class="statistic-box">
              <i class="fa fa-handshake-o fa-3x"></i>
              <div class="counter-number pull-right">
                 <span class="count-number" style="font-size: 14px;" >Rs. {{  number_format($summaryData[0]->inhand,2) }}</span>
              </div>
              <h5 style="font-size: 14px;">Inhand</h5>
           </div>
        </div>
     </div>
     <div class=" col-sm-12 col-md-6 col-lg-3">
        <div id="cardbox2">
           <div class="statistic-box">
              <i class="fa fa-bank fa-3x"></i>
              <div class="counter-number pull-right">
                 <span class="count-number" style="font-size: 14px;" >Rs. {{  number_format($summaryData[0]->bank,2) }}</span>
              </div>
              <h5 style="font-size: 14px;">Bank</h5>
           </div>
        </div>
     </div>
     <div class=" col-sm-12 col-md-6 col-lg-3">
        <div id="cardbox3">
           <div class="statistic-box">
              <i class="fa fa-money fa-3x"></i>
              <div class="counter-number pull-right">
                 <span class="count-number" style="font-size: 14px;" >Rs. {{  number_format($summaryData[0]->creditcol,2) }}</span>
              </div>
              <h5 style="font-size: 14px;">Credit Collection</h5>
           </div>
        </div>
     </div>
     <div class=" col-sm-12 col-md-6 col-lg-3">
        <div id="cardbox4">
           <div class="statistic-box">
              <i class="fa fa-credit-card fa-3x"></i>
              <div class="counter-number pull-right">
                 <span class="count-number" style="font-size: 14px;" >Rs. {{  number_format($summaryData[0]->credit,2) }}</span>
              </div>
              <h5 style="font-size: 14px;"> Credit</h5>
           </div>
        </div>
     </div>
  </div>

  <div class="col-lg-12 pinpin">
    <div class="card lobicard lobicard-custom-control" data-sortable="true">
      <div class="card-header">
        <div class="card-title custom_title">
           <a href="#"> <h4>DSR Status For Today</h4></a>
        </div>
     </div>
     <div class="card-body">
       <div class="table-responsive">
          <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
             <thead class="back_table_color">
                <tr class="info">
                   <th>Image</th>
                   <th>Name</th>
                   <th>Sales</th>
                   <th>Inhand</th>
                   <th>Banking</th>
                   <th>Direct Banking</th>
                   <th>Credit</th>
                   <th>Retailer Return</th>
                   <th>Credit Collection</th>
                </tr>
             </thead>
             <tbody>

               @if($usersData)
               @foreach($usersData as $udata)

               <tr>
                <td><img src="{{  $udata->profile_photo_path }}" class="img-circle" alt="User Image" width="50" height="50"></td>
                <td>{{  $udata->name }}</td>
                <td>Rs. {{  number_format($udata->sales_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->inhand_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->banking_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->direct_banking_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->credit_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->retialer_sum,2) }}</td>
                <td>Rs. {{  number_format($udata->credit_collection_sum,2) }}</td>
             </tr>

             @endforeach
             @endif


          </tbody>
       </table>
    </div>

    <div class="d-flex justify-content-center">
        <div>{!! $usersData->links() !!}</div>
     </div>

 </div>
</div>
</div>

</section>
<!-- /.content -->
</div>


@endsection
