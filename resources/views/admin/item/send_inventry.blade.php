@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <div class="header-icon">
        <i class="fa fa-send"></i>
     </div>
     <div class="header-title">
        <h1>Send Inventory</h1>
        <small></small>
     </div>
  </section>
  <!-- Main content -->
  <section class="content">
     <div class="row">
      <div class="col-lg-12 pinpin">
        <div class="card lobicard lobicard-custom-control"  data-sortable="true">
          <div class="card-header">
            <div class="card-title custom_title">
              <h4>Sending Items</h4>
           </div>
        </div>
        <div class="row" style="margin-left: 10px">
          <div class="col-md-3">
           <div class="position-relative form-group"><label
             for="search" class="">From</label>
             <select class="form-control" id="txtStock" name="txtStock">
               @if($stockData)
               @foreach($stockData as $stock)
               <option value="{{ $stock->id }}">{{ $stock->stock_name }}</option>
               @endforeach
               @endif
            </select>
         </div>
      </div>
      <div class="col-md-3">
        <label >DSR</label>
        <select class="form-control" id="txtDsr" name="txtDsr" required>
         <option value="" selected>-Select Dsr-</option>
         @if($dsrData)
         @foreach($dsrData as $dsr)
         <option value="{{ $dsr->id }}">{{ $dsr->name }}</option>
         @endforeach
         @endif
      </select>
   </div>
   <div class="col-md-3">
     <label >Item List</label>
     <select class="form-control" id="txtItem" name="txtItem" required>
       <option value="" selected>-Select Item-</option>
       @if($itemData)
       @foreach($itemData as $item)
       <option value="{{ $item->id }}">{{ $item->name }}</option>
       @endforeach
       @endif
    </select>
 </div>
</div>
<div class="card-body">
  <div class="table-responsive">
   <table class="table table-bordered table-hover" id="inventoryTable">
     <thead class="back_table_color">
        <tr class="info">
           <th style="display: none;">#</th>
           <th>Item Name</th>
           <th style="width: 150px">Qty</th>
           <th class="text-center">Balance Stock</th>
           <th class="text-center" style='display:none;'>Selling Price</th>
           <th class="text-center">Remove</th>
        </tr>
     </thead>
     <tbody>
     </tbody>
  </table>
  <div class="form-group">
   <button type="submit" class="btn btn-add" id="btnSenditems"><i class="fa fa-check"></i>Send Items</button>
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
