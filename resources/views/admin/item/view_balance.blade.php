@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="header-icon">
      <i class="fa fa-bitbucket-square"></i>
  </div>
  <div class="header-title">
      <h1>View Stock</h1>
      <small></small>
  </div>
</section>

<!-- Main content -->
<section class="content">
 <div class="row">

  <div class="col-lg-4 pinpin">
    <div class="card lobicard lobicard-custom-control"  data-sortable="true">
        <div class="card-header">
            <div class="card-title custom_title">
                <h4>Stock</h4>
            </div>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('get_view_balance') }}">
                @csrf

                <div class="position-relative form-group">
                    <label for="fromdate" class="">Select Date</label>
                    <input id="date" name="date" placeholder="Date" type="date" class="form-control" >
                </div>

                <div class="position-relative form-group">
                    <label for="fromdate" class="">Select Time</label>
                    <input id="time" name="time" placeholder="Date" type="time" class="form-control" >
                </div>

                <div class="form-group">
                  <label >Stock</label>
                  <select class="form-control" id="stock_id" name="stock_id" required>
                     <option value="">-Select stock-</option>
                     <option value="all">All</option>
                     <option value="main">Main Stock</option>
                     @if($dsrList)
                     @foreach($dsrList as $dsr)
                     <option value="{{ $dsr->id }}">{{ $dsr->name }}</option>
                     @endforeach
                     @endif
                 </select>
             </div>

             <div class="form-group">
               <button type="submit" class="btn btn-add"><i class="fa fa-check"></i>View</button>
           </div>

       </form>

   </div>
</div>
</div>

<div class="col-lg-8 pinpin">
  <div class="card lobicard lobicard-custom-control"  data-sortable="true">
    <div class="card-header">
        <div class="card-title custom_title">
            <h4>Stock Items Report</h4>
        </div>
    </div>

    <div class="card-body">

      <?php 
      if(isset($selected_date) && isset($selected_time) && isset($stock_name)){
        ?>
        <div class="row">
            <div class="col-lg-4"><b>Stock : <?php echo $stock_name ?> </b></div>
            <div class="col-lg-4"><b>Date : <?php echo $selected_date ?> </b></div>
            <div class="col-lg-4"><b>Time : <?php echo $selected_time ?> </b></div>
        </div>
        <?php
    }

    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
         <thead class="back_table_color">
          <tr class="info">
           <th>#</th>
           <th>Item Name</th>
           <th style="width: 150px">Qty</th>
       </tr>
   </thead>
   <tbody>
    <?php $count = 1; $sum=0;?>
    @if($dsrStockData)
    @foreach($dsrStockData as $dsr_items)

    <tr>
        <td><?php echo $count ?></td>
        <td>{{ $dsr_items['name'] }}</td>
        <td>{{ number_format($dsr_items['qty'],2) }}</td>
    </tr>
    <?php $count++; $sum=$sum+$dsr_items['qty']; ?>
    @endforeach
    @endif

    <tr class="back_table_color">
        <td colspan="2">Total</td>
        <td colspan="2">{{ number_format($sum,2) }}</td>
    </tr>

</tbody>
</table>
</div>


</div>
</div>
</div>



</div>

</section>
<!-- /.content -->
</div>






@endsection

