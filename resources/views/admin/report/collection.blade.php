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
             <div class="col-lg-12 pinpin">
                   <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
                       <div class="card-header">
                           <div class="card-title custom_title">
                               <h4>Collection Details</h4>
                           </div>
                       </div>
                       <div class="card-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                               <div class="btn-group">
                                  <button class="btn btn-exp btn-sm" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                                  <ul class="dropdown-menu exp-drop" role="menu">
                                     <li>
                                        <a href="#" onclick="$('#dataTableExample1').tableExport({type:'doc',escape:'false'});">
                                        <img src="assets/dist/img/word.png" width="24" alt="logo"> Word</a>
                                     </li>
                                     <li>
                                        <a href="#" onclick="$('#dataTableExample1').tableExport({type:'powerpoint',escape:'false'});">
                                        <img src="assets/dist/img/ppt.png" width="24" alt="logo"> PowerPoint</a>
                                     </li>
                                    <li class="dropdown-divider"></li>
                                     <li>
                                        <a href="#" onclick="$('#dataTableExample1').tableExport({type:'png',escape:'false'});">
                                        <img src="assets/dist/img/png.png" width="24" alt="logo"> Excel</a>
                                     </li>
                                     <li>
                                        <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                        <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                     </li>
                                  </ul>
                               </div>
                               <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                               <div class="table-responsive">
                                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                     <thead class="back_table_color">
                                        <tr>
                                            <th style="min-width: 10px">Date</th>
                                            <th style="min-width: 100px">Name</th>
                                            <th style="min-width: 100px">Cach</th>
                                            <th style="min-width: 100px">Cheque</th>
                                            <th style="min-width: 150px">Credit Collection</th>
                                            <th style="min-width: 150px">Banking - Sampath</th>
                                            <th style="min-width: 150px">Banking - Peoples</th>
                                            <th style="min-width: 150px">Banking - Cargils</th>
                                            <th style="min-width: 200px">Direct Banking - Sampath</th>
                                            <th style="min-width: 200px">Direct Banking - Peoples</th>
                                            <th style="min-width: 200px">Direct Banking - Cargils</th>
                                            <th style="min-width: 100px">Balance</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                            <td>29/06/2022</td>
                                            <td>Chathuranga</td>
                                            <td>Rs.50,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.25,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.     0.00</td>
                                        </tr>
                                        <tr>
                                            <td>29/06/2022</td>
                                            <td>Viduranga</td>
                                            <td>Rs.50,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.25,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.     0.00</td>
                                        </tr>
                                        <tr>
                                            <td>29/06/2022</td>
                                            <td>Tharaka</td>
                                            <td>Rs.50,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.25,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.5,000.00</td>
                                            <td>Rs.10,000.00</td>
                                            <td>Rs.15,000.00</td>
                                            <td>Rs.     0.00</td>
                                        </tr>
                                      </tbody>
                                      <tfoot class="back_table_color" >
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>Rs.150,000.00</th>
                                            <th>Rs.45,000.00</th>
                                            <th>Rs. 15,000.00</th>
                                            <th>Rs. 75,000.00</th>
                                            <th>Rs. 30,000.00</th>
                                            <th>Rs. 30,000.00</th>
                                            <th>Rs. 15,000.00</th>
                                            <th>Rs. 30,000.00</th>
                                            <th>Rs. 45,000.00</th>
                                            <td>Rs.     0.00</td>
                                        </tr>
                                      </tfoot>
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
