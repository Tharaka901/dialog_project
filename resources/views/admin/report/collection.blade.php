@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="header-icon">
      <i class="fa fa-money"></i>
  </div>
  <div class="header-title">
      <h1>Collection Report</h1>
      <small></small>
  </div>
</section>
<!-- Main content -->
<section class="content">
 <div class="row">

   <div class="col-lg-12 col-md-12 col-sm-12 mb-3">

    <form method="get" action="{{ url('search_collection')  }}">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text"  name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
            </div>
            <div class="col">
                <input name="fromdate" id="fromdate" placeholder="From Date" type="date" class="form-control" value="{{ request()->get('fromdate') }}">
            </div>
            <div class="col">
              <input name="todate" id="todate" placeholder="To Date" type="date" class="form-control" value="{{ request()->get('todate') }}">
          </div>
          <div class="col">
            <input name="submit" type="submit" value="Search" class="btn btn-sm btn-success">
        </div>
    </div>
</form>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 mb-3">
    @if($errors->any())
    <h5 class="label label-danger">{{$errors->first()}}</h5>
    @endif
</div>


<div class="col-lg-12 pinpin">
 <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
     <div class="card-header">
         <div class="card-title custom_title">
             <h4>Collection Details</h4>
         </div>
     </div>
     <div class="card-body">
        <!-- Plugin content:pdf,excel -->
        <div class="btn-group">
          <button class="btn btn-exp btn-sm" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
          <ul class="dropdown-menu exp-drop" role="menu">
            <li class="dropdown-divider"></li>
            <li>
                <a href="#" onclick="$('#dataTableExample1').tableExport({type:'xlsx',escape:'false'});">
                    <img src="assets/dist/img/excel.png" width="24" alt="logo"> Excel</a>
                </li>
                <!--<li>-->
                    <!--    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">-->
                        <!--        <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>-->
                        <!--    </li>-->
                    </ul>
                </div>
                <!-- ./Plugin content:pdf,excel -->

                <div class="table-responsive">
                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                   <thead class="back_table_color">
                    <tr>
                        <th style="min-width: 100px">Date</th>
                        <th style="min-width: 100px">Name</th>
                        <th style="min-width: 100px">Cash</th>
                        <th style="min-width: 100px">Cheque</th>
                        <th style="min-width: 150px">Credits</th>
                        <th style="min-width: 150px">Credit Collection</th>
                        <th style="min-width: 150px">Banking - Sampath</th>
                        <th style="min-width: 150px">Banking - Peoples</th>
                        <th style="min-width: 150px">Banking - Cargils</th>
                        <th style="min-width: 150px">Banking - Sampath Online</th>
                        <th style="min-width: 200px">Direct Banking - Sampath</th>
                        <th style="min-width: 200px">Direct Banking - Peoples</th>
                        <th style="min-width: 200px">Direct Banking - Cargils</th>
                        <th style="min-width: 200px">Direct Banking - Sampath Online</th>
                        <th style="min-width: 200px">Sampath Bank - All</th>
                        <th style="min-width: 200px">Peoples Bank - All</th>
                        <th style="min-width: 200px">Cargils Bank - All</th>
                        <th style="min-width: 100px">Balance</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($collectionData as $collection)
                    <tr>
                        <td>{{ $collection->date }}</td>
                        <td>{{ $collection->name }}</td>
                        <td>{{ number_format($collection->inhand_cash,2) }}</td>
                        <td>{{ number_format($collection->inhand_cheque,2) }}</td>
                        <td>{{ number_format($collection->credit_sum,2) }}</td>
                        <td>{{ number_format($collection->credit_collection_sum,2) }}</td>
                        <td>{{ number_format($collection->banking_sampath,2) }}</td>
                        <td>{{ number_format($collection->banking_peoples,2) }}</td>
                        <td>{{ number_format($collection->banking_cargils,2) }}</td>
                        <td>{{ number_format($collection->banking_sampth_online,2) }}</td>
                        <td>{{ number_format($collection->direct_banking_sampath,2) }}</td>
                        <td>{{ number_format($collection->direct_banking_peoples,2) }}</td>
                        <td>{{ number_format($collection->direct_banking_cargils,2) }}</td>
                        <td>{{ number_format($collection->direct_banking_sampth_online,2) }}</td>
                        <td>{{ number_format( ( $collection->banking_sampath + $collection->direct_banking_sampath ) ,2) }}</td>
                        <td>{{ number_format( ( $collection->banking_peoples + $collection->direct_banking_peoples ) ,2) }}</td>
                        <td>{{ number_format( ( $collection->banking_cargils + $collection->direct_banking_cargils ) ,2) }}</td>
                        <td>{{ number_format( $collection->inhand_cash + $collection->inhand_cheque + $collection->banking_sampath + $collection->banking_peoples + $collection->banking_cargils + $collection->direct_banking_sampath + $collection->direct_banking_peoples + $collection->direct_banking_cargils + $collection->credit_sum - $collection->credit_collection_sum ,2) }}</td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot class="back_table_color" >
                 <tr>
                    <th colspan="2">Total</th>
                    <?php 

                    $cashtot = 0;   
                    $cheque = 0;
                    $credit_tot = 0;
                    $credit_collection_tot = 0;
                    $banking_sampath_tot = 0; 
                    $banking_peoples_tot = 0;  
                    $banking_cargils = 0;
                    $banking_sampath_online = 0;
                    $direct_banking_sampath_tot = 0;
                    $direct_banking_peoples_tot = 0;   
                    $direct_banking_cargils_tot = 0;
                    $direct_banking_sampath_online_tot = 0;
                    $all_sampath_bank_tot = 0;
                    $all_peoples_bank_tot = 0;
                    $all_cargils_bank_tot = 0;
                    $sub_total = 0;

                    foreach($collectionData as $collection1){
                        $cashtot += $collection1->inhand_cash;
                        $cheque += $collection1->inhand_cheque;
                        $credit_tot += $collection1->credit_sum;
                        $credit_collection_tot += $collection1->credit_collection_sum;
                        $banking_sampath_tot += $collection1->banking_sampath;
                        $banking_peoples_tot += $collection1->banking_peoples;
                        $banking_cargils += $collection1->banking_cargils;
                        $banking_sampath_online += $collection1->banking_sampth_online;
                        $direct_banking_sampath_tot += $collection1->direct_banking_sampath;
                        $direct_banking_peoples_tot += $collection1->direct_banking_peoples;
                        $direct_banking_cargils_tot += $collection1->direct_banking_cargils;
                        $direct_banking_sampath_online_tot += $collection1->direct_banking_sampth_online;
                        $all_sampath_bank_tot += ($collection1->banking_sampath + $collection1->direct_banking_sampath);
                        $all_peoples_bank_tot += ($collection1->banking_peoples + $collection1->direct_banking_peoples);
                        $all_cargils_bank_tot += ($collection1->banking_cargils + $collection1->direct_banking_cargils);
                        $sub_total += $collection1->inhand_cash+$collection1->inhand_cheque+$collection1->banking_sampath+$collection1->credit_sum+$collection1->banking_peoples+$collection1->banking_cargils+$collection1->direct_banking_sampath+$collection1->direct_banking_peoples+$collection1->direct_banking_cargils-$collection1->credit_collection_sum;
                    }
                    ?>

                    <th><?php echo number_format($cashtot,2)  ?></th>
                    <th><?php echo number_format($cheque,2)  ?></th>
                    <th><?php echo number_format($credit_tot,2)  ?></th>
                    <th><?php echo number_format($credit_collection_tot,2)  ?></th>
                    <th><?php echo number_format($banking_sampath_tot,2)  ?></th>
                    <th><?php echo number_format($banking_peoples_tot,2)  ?></th>
                    <th><?php echo number_format($banking_cargils,2)  ?></th>
                    <th><?php echo number_format($banking_sampath_online,2)  ?></th>
                    <th><?php echo number_format($direct_banking_sampath_tot,2)  ?></th>
                    <th><?php echo number_format($direct_banking_peoples_tot,2)  ?></th>
                    <th><?php echo number_format($direct_banking_cargils_tot,2)  ?></th>
                    <th><?php echo number_format($direct_banking_sampath_online_tot,2)  ?></th>
                    <th><?php echo number_format($all_sampath_bank_tot,2)  ?></th>
                    <th><?php echo number_format($all_peoples_bank_tot,2)  ?></th>
                    <th><?php echo number_format($all_cargils_bank_tot,2)  ?></th>
                    <th><?php echo number_format($sub_total,2)  ?></th>

                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
     <div>{!! $collectionData->links() !!}</div>
 </div>


</div>
</div>
</div>
</div>

</section>
<!-- /.content -->
</div>

@endsection
