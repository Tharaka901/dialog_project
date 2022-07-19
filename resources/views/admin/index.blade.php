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
                      <span class="count-number" style="font-size: 14px;" >Rs.1,015,789.00</span>
                      <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                      </span>
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
                      <span class="count-number" style="font-size: 14px;" >Rs.315,400.00</span>
                      <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                      </span>
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
                      <i class="ti ti-money"></i><span class="count-number" style="font-size: 14px;" >Rs.615,000.00</span>
                      <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                      </span>
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
                      <span class="count-number" style="font-size: 14px;" >Rs.300,000.00</span>
                      <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                      </span>
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
                   <a href="#"> <h4>DSR Status</h4></a>
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
                             <tr>
                                <td><img src="assets/dist/img/m1.png" class="img-circle" alt="User Image" width="50" height="50"></td>
                                <td>Chathuranga</td>
                                <td>Rs.450,000.00</td>
                                <td>Rs.150,000.00</td>
                                <td>Rs.300,000.00</td>
                                <td>Rs. 50,000.00</td>
                                <td>Rs.100,000.00</td>
                                <td> 00</td>
                                <td>Rs.150,000.00</td>

                             </tr>
                             <tr>
                                <td><img src="assets/dist/img/m2.png" class="img-circle" alt="User Image" width="50" height="50"></td>
                                <td>Viduranga</td>
                                <td>Rs.650,000.00</td>
                                <td>Rs. 50,000.00</td>
                                <td>Rs.400,000.00</td>
                                <td>Rs. 50,000.00</td>
                                <td>Rs.100,000.00</td>
                                <td> 00</td>
                                <td>Rs.150,000.00</td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                 </div>
        </div>
     </div>

    </section>
    <!-- /.content -->
 </div>


@endsection
