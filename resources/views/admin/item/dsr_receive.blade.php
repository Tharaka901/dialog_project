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

         @if($stockData)
         <?php $count = 1; ?>
         @foreach($stockData as $stock)
         <tr>
            <td><?php echo $count ?></td>
            <td>{{ $stock->updated_at }}</td>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->qty }}</td>
        </tr>
        <?php $count++ ?>
        @endforeach
        @endif

     </tbody>
  </table>
</div>

<div class="d-flex justify-content-center">
 <div>{!! $stockData->links() !!}</div>
</div>

</div>
</div>
</div>
</div>


</section>
<!-- /.content -->
</div>


<!-- User Modal1 -->
<div class="modal fade" id="stockItemModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-eye m-r-5"></i> View Stock Items</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">

               <div id="stockItemTable"></div>

            </div>
         </div>
      </div>
   </div>
</div>
</div>

@endsection
