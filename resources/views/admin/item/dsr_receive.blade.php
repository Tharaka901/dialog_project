@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-undo"></i>
     </div>
     <div class="header-title">
        <h1>DSR Returns</h1>
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
         <a href="#"> <h4>DSR Receive</h4></a>
      </div>
   </div>
   <div class="card-body">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">To Be Returns</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" id="profile-tab" data-toggle="tab" href="#done" role="tab" aria-controls="profile" aria-selected="false">Returned</a>
    </li>
 </ul>


 <div class="tab-content mycontent" id="myTabContent">

  <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
    <div class="table-responsive">
     <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
        <thead class="back_table_color">
           <tr class="info">
              <th>#</th>
              <th>Date & Time</th>
              <th>Name</th>
              <th>Item</th>
              <th>Quantity</th>
              <th class="text-center">Action</th>
           </tr>
        </thead>
        <tbody>

         @if($returnData)
         <?php $count = 1; ?>
         @foreach($returnData as $return)
         <tr>
            <td><?php echo $count ?></td>
            <td>{{ $return->created_at }}</td>
            <td>{{ $return->user_name }}</td>
            <td>{{ $return->name }}</td>
            <td>{{ $return->qty }}</td>
            <td class="text-center">
               <button type="button" class="btn btn-add btn-sm" onclick="approveQty({{ $return->return_id }},{{ $return->item_id }},{{ $return->qty }})"><i class="fa fa-check"></i></button>
               <a href="{{ url('rolling_return_items/'.$return->return_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>
            </td>
         </tr>
         <?php $count++ ?>
         @endforeach
         @endif

      </tbody>
   </table>
</div>

<div class="d-flex justify-content-center">
 <div>{!! $returnData->links() !!}</div>
</div>
</div>


<div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="profile-tab">
 <div class="table-responsive">
  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
     <thead class="back_table_color">
        <tr class="info">
           <th>#</th>
           <th>Date & Time</th>
           <th>Name</th>
           <th>Item</th>
           <th>Quantity</th>
        </tr>
     </thead>
     <tbody>

      @if($returnedData)
      <?php $count = 1; ?>
      @foreach($returnedData as $return1)
      <tr>
         <td><?php echo $count ?></td>
         <td>{{ $return1->created_at }}</td>
         <td>{{ $return1->user_name }}</td>
         <td>{{ $return1->name }}</td>
         <td>{{ $return1->qty }}</td>
      </tr>
      <?php $count++ ?>
      @endforeach
      @endif

   </tbody>
</table>
</div>

<div class="d-flex justify-content-center">
 <div>{!! $returnedData->links() !!}</div>
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
