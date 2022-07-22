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
       <h1>Complete DSR Summery </h1>
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
      <a href="#"> <h4>Complete DSR Details</h4></a>
   </div>
</div>
<div class="card-body">
 <!-- Plugin content:pdf,excel -->
                       <!--      <div class="btn-group">
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
                                       <td>Rs. {{ number_format($dd->sales_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->inhand_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->banking_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->direct_banking_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->credit_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->credit_collection_sum,2)  }}</td>
                                       <td>Rs. {{ number_format($dd->retialer_sum ,2) }}</td>
                                    </tr>
                                    <?php $count++ ?>

                                    @endforeach
                                    @endif
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
