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
                         <form>
                            <div class="position-relative form-group"><label
                                for="fromdate" class="">Select Date</label><input
                                name="fromdate" id="fromdate" placeholder="Date"
                                type="date" class="form-control">
                             </div>
                            <div class="form-group">
                                  <label >Stock</label>
                                  <select class="form-control" >
                                     <option>All</option>
                                     <option>Main Stock</option>
                                     <option>Chathuranga</option>
                                     <option>Viduranga</option>
                                     <option>Shashika</option>
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
                                     <th>Item Name</th>
                                     <th style="width: 100px">Qty</th>
                                     <th>Amount</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr>
                                     <td>Internet Card 49</td>
                                     <td>1000</td>
                                     <td>49,000.00</td>
                                  </tr>
                                  <tr>
                                    <td>Internet Card 99</td>
                                    <td>500</td>
                                    <td>49,500.00</td>
                                 </tr>
                                 <tr>
                                    <td>KIT 50</td>
                                    <td>1500</td>
                                    <td>75,000.00</td>
                                 </tr>
                                 <tr>
                                    <td>KIT 100</td>
                                    <td>1000</td>
                                    <td>100,000.00</td>
                                 </tr>
                                 <tr>
                                    <td>Dialog TV</td>
                                    <td>10</td>
                                    <td>89,000.00</td>
                                 </tr>
                               </tbody>
                               <tfoot class="back_table_color">
                                <tr>
                                    <th>Total</th>
                                    <th>4010</th>
                                    <th>362,500.00</th>
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
