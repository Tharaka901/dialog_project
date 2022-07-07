@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-send"></i>
       </div>
       <div class="header-title">
          <h1>Send Inventry</h1>
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
                             <select class="form-control" >
                                <option>Main Stock</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <label >DSR</label>
                            <select class="form-control" >
                               <option>Chathuranaga</option>
                               <option>Viduranga</option>
                               <option>Shashika</option>
                               <option>Tharaka</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <label >Item List</label>
                            <select class="form-control" >
                               <option>Internet Card 49</option>
                               <option>Internet Card 99</option>
                               <option>KIT 50</option>
                               <option>KIT 100</option>
                               <option>Dialog TV</option>
                            </select>
                          </div>
                        </div>
                    <div class="card-body">
                         <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                               <thead class="back_table_color">
                                  <tr class="info">
                                     <th>Item Name</th>
                                     <th style="width: 150px">Qty</th>
                                     <th>Balance Stoct</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr>
                                     <td>Internet Card 49</td>
                                     <td><input type="number" class="form-control" placeholder="Qty" required></td>
                                     <td>150</td>
                                  </tr>
                                  <tr>
                                    <td>Internet Card 99</td>
                                    <td><input type="number" class="form-control" placeholder="Qty" required></td>
                                    <td>360</td>
                                 </tr>
                                 <tr>
                                    <td>KIT 50</td>
                                    <td><input type="number" class="form-control" placeholder="Qty" required></td>
                                    <td>450</td>
                                 </tr>
                                 <tr>
                                    <td>KIT 100</td>
                                    <td><input type="number" class="form-control" placeholder="Qty" required></td>
                                    <td>600</td>
                                 </tr>
                                 <tr>
                                    <td>Dialog TV</td>
                                    <td><input type="number" class="form-control" placeholder="Qty" required></td>
                                    <td>950</td>
                                 </tr>
                               </tbody>
                            </table>
                            <div class="form-group">
                                <button type="submit" class="btn btn-add"><i class="fa fa-check"></i>Send Items
                                </button>
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
