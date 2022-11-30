@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="header-icon">
        <i class="fa fa-exchange"></i>
    </div>
    <div class="header-title">
        <h1>Transfer Status</h1>
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
        <div class="card-header mb-3">
            <div class="card-title custom_title">
                <a href="#"> <h4>Transfer Status Details</h4></a>
            </div>
        </div>



        <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">Pending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#done" role="tab" aria-controls="profile" aria-selected="false">Done</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="profile" aria-selected="false">Rejected</a>
    </li>
</ul>

<div class="tab-content mycontent" id="myTabContent">

    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
       <table class="table table-bordered table-striped table-hover">
         <thead class="back_table_color">
          <tr class="info">
           <th>Date</th>
           <th>Name</th>
           <th>Amount (Rs)</th>
           <th>View</th>
       </tr>
   </thead>
   <tbody>

     @if($pending_data)
     @foreach($pending_data as $ts)
     <tr>
        <td>{{ $ts->created_at }}</td>
        <td>{{ $ts->name }}</td>
        <td>{{ number_format($ts->total,2) }}</td>
        <td>
            <button type="button" class="btn btn-add btn-sm" onclick="viewTransferItems({{ $ts->stockid  }})">
                <i class="fa fa-pencil"></i>
            </button>
        </td>
    </tr>
    @endforeach
    @endif

</tbody>
</table>

<div class="d-flex justify-content-center">
    <div>{!! $pending_data->links() !!}</div>
</div>

</div>



<div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="profile-tab">
   <table class="table table-bordered table-striped table-hover">
     <thead class="back_table_color">
      <tr class="info">
        <th>Date</th>
        <th>Name</th>
        <th>Amount (Rs)</th>
        <th>View</th>
    </tr>
</thead>
<tbody>

 @if($done_data)
 @foreach($done_data as $ts)
 <tr>
    <td>{{ $ts->created_at }}</td>
    <td>{{ $ts->name }}</td>
    <td>{{ number_format($ts->total,2) }}</td>
    <td>
        <button type="button" class="btn btn-add btn-sm" onclick="viewTransferItems({{ $ts->stockid  }})">
            <i class="fa fa-pencil"></i>
        </button>
    </td>
</tr>
@endforeach
@endif

</tbody>
</table>

<div class="d-flex justify-content-center">
    <div>{!! $done_data->links() !!}</div>
</div>

</div>



<div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="profile-tab">
   <table class="table table-bordered table-striped table-hover">
     <thead class="back_table_color">
      <tr class="info">
          <th>Date</th>
          <th>Name</th>
          <th>Amount (Rs)</th>
          <th>View</th>
      </tr>
  </thead>
  <tbody>

   @if($rejected_data)
   @foreach($rejected_data as $ts)
   <tr>
    <td>{{ $ts->created_at }}</td>
    <td>{{ $ts->name }}</td>
    <td>{{ number_format($ts->total ,2) }}</td>
    <td>
        <button type="button" class="btn btn-add btn-sm" onclick="viewTransferRejectedItems({{ $ts->stockid  }})">
            <i class="fa fa-pencil"></i>
        </button>
    </td>
</tr>
@endforeach
@endif


</tbody>
</table>

<div class="d-flex justify-content-center">
    <div>{!! $rejected_data->links() !!}</div>
</div>

</div>




</div>





</div>
</div>
</div>
</section>
</div>


<!-- User Modal1 -->
<div class="modal fade" id="transferItemModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-eye m-r-5"></i> Relevent Items</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
          <div class="row">
             <div class="col-md-12">

              <div class="table-responsive">
                <table id="transfer_status_table" class="table table-bordered table-striped table-hover">
                    <thead class="back_table_color">
                        <tr class="info">
                            <th>#</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <!-- <th>Deducted qty</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>



@endsection