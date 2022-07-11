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
                <form method="post" action="{{ route('get_stock_items') }}">
                    @csrf
                    <div class="position-relative form-group">
                        <label for="fromdate" class="">Select Date</label>
                        <input name="fromdate" id="date" name="date" placeholder="Date" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label >Stock</label>
                      <select class="form-control" id="stock_id" name="stock_id" required>
                       <option value="">-Select stock-</option>
                       <option value="0">All</option>
                       <option value="00">Main Stock</option>
                       @if($stockData)
                       @foreach($stockData as $sd)
                       <option value="{{ $sd->id }}">{{ $sd->name }}</option>
                       @endforeach
                       @endif
                   </select>
               </div>
               <div class="form-group">
                 <button type="submit" class="btn btn-add"><i class="fa fa-check"></i> View
                 </button>
             </div>
         </form>
     </div>
 </div>
</div>

<div class="col-lg-8 pinpin">
  <div class="card lobicard lobicard-custom-control"  data-sortable="true">
    <div class="card-header">
        <div class="card-title custom_title">
            <h4>Stock Report</h4>
        </div>
    </div>
    <div class="card-body">
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

            @if($itemData)
            <?php $count = 1; ?>
            @foreach($itemData as $items)
            <tr>
             <td><?php echo $count ?></td>
             <td>{{ $items->name }}</td>
             <td>{{ $items->qty }}</td>
         </tr>
         <?php $count++ ?>
         @endforeach
         @endif

         @if($itemTotal)
         <?php $sum = 0; ?>
         @foreach($itemTotal as $tot)
         <?php $sum =+ $sum + $tot->qty ?>
         @endforeach
         @endif
         <tr class="back_table_color">
            <td colspan="2">Total</td>
            <td colspan="2"><?php echo number_format($sum,2); ?></td>
        </tr>

    </tbody>
</table>
</div>

<div class="d-flex justify-content-center">
    <div>{!! $itemData->links() !!}</div>
</div>

</div>
</div>
</div>


</div>
</section>
<!-- /.content -->
</div>






@endsection

