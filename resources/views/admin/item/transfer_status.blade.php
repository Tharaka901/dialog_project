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
            <div class="card-header">
                <div class="card-title custom_title">
                    <a href="#"> <h4>Transfer Status Details</h4></a>
                </div>
            </div>
      <div class="card-body">
      <div class="table-responsive">
        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
            <thead class="back_table_color">
            <tr class="info">
                <th>Date</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>28/06/2022</td>
                <td>Chathuranga</td>
                <td>Rs.450,000.00</td>
                <td><span class="label-success label label-default" style="font-size: 13px" >Done</span></td>
            </tr>
            <tr>
                <td>28/06/2022</td>
                <td>Viduranga</td>
                <td>Rs.650,000.00</td>
                <td><span class="label-danger label label-default" style="font-size: 13px" >Reject</span></td>
            </tr>
            <tr>
                <td>28/06/2022</td>
                <td>Chathuranga</td>
                <td>Rs.650,000.00</td>
                <td><span class="label-warning label label-default" style="font-size: 13px" >Pending</span></td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
        </div>
      </div>
        </div>
    </section>
</div>



@endsection

