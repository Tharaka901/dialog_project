@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-plus"></i>
       </div>
       <div class="header-title">
          <h1>Items</h1>
          <small></small>
       </div>
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="row">
             <div class="col-lg-12 pinpin">
                   <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
                       <div class="card-header">
                           <div class="card-title custom_title">
                               <h4>Item Details</h4>
                           </div>
                       </div>
                       <div class="card-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                               <div class="btn-group d-flex" role="group">
                                  <div class="buttonexport">
                                     <a href="#" class="btn btn-add" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"></i> Add Items</a>
                                  </div>
                               </div>
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
                                        <tr class="info">
                                           <th>No</th>
                                           <th>Item Name</th>
                                           <th>Purchasing Price</th>
                                           <th>Selling Price</th>
                                           <th>Balance Qty</th>
                                           <th>Action</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                           <td>01</td>
                                           <td>Internet Card 49</td>
                                           <td>45</td>
                                           <td>49</td>
                                           <td>150</td>
                                           <td>
                                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>Internet Card 99</td>
                                            <td>95</td>
                                            <td>99</td>
                                            <td>250</td>
                                           <td>
                                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>KIT 50</td>
                                            <td>45</td>
                                            <td>50</td>
                                            <td>300</td>
                                           <td>
                                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </div>
                            </div>
                   </div>
               </div>
       </div>
       <!-- User Modal1 -->
       <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header modal-header-primary">
                   <h3><i class="fa fa-plus m-r-5"></i> Update Item</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                           <div class="row">
                                    <!-- Text input-->
                                  <div class="col-md-6 form-group">
                                     <label class="control-label">No</label>
                                     <input type="text" placeholder="Type" class="form-control">
                                  </div>
                                  <!-- Text input-->
                                  <div class="col-md-6 form-group">
                                     <label class="control-label">Item Name</label>
                                     <input type="text" placeholder="Item Name" class="form-control">
                                  </div>
                                  <!-- Text input-->
                                  <div class="col-md-6 form-group">
                                     <label class="control-label">Purchasing Price</label>
                                     <input type="text" placeholder="Type" class="form-control">
                                  </div>
                                  <div class="col-md-6 form-group">
                                     <label class="control-label">Selling Price</label>
                                     <input type="text" placeholder="Type" class="form-control">
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <label class="control-label">Balance Qty</label>
                                    <input type="text" placeholder="Type" class="form-control">
                                 </div>
                                  <div class="col-md-12 form-group user-form-group">
                                     <div class="float-right">
                                        <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                        <button type="submit" class="btn btn-add btn-sm">Update</button>
                                     </div>
                                  </div>
                           </div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
       <!-- Modal -->
       <!-- User Modal1 -->
       <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header modal-header-primary">
                   <h3><i class="fa fa-plus m-r-5"></i> Add New Item</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                            <div class="row">
                                <!-- Text input-->
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">No</label>
                                    <input type="text" placeholder="Type" class="form-control">
                                 </div>
                                 <!-- Text input-->
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">Item Name</label>
                                    <input type="text" placeholder="Item Name" class="form-control">
                                 </div>
                                 <!-- Text input-->
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">Purchasing Price</label>
                                    <input type="text" placeholder="Type" class="form-control">
                                 </div>
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">Selling Price</label>
                                    <input type="text" placeholder="Type" class="form-control">
                                 </div>
                                 <div class="col-md-6 form-group">
                                   <label class="control-label">Balance Qty</label>
                                   <input type="text" placeholder="Type" class="form-control">
                                 </div>
                               <div class="col-md-12 form-group user-form-group">
                                  <div class="float-right">
                                     <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                     <button type="submit" class="btn btn-add btn-sm">Add Item</button>
                                  </div>
                               </div>
                            </div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
       <!-- Modal -->
       <!-- delete user Modal2 -->
       <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header modal-header-primary">
                   <h3><i class="fa fa-user m-r-5"></i> Delete Item</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                            <fieldset>
                               <div class="col-md-12 form-group user-form-group">
                                  <label class="control-label">Delete Item</label>
                                  <div class="float-right">
                                     <button type="button" class="btn btn-danger btn-sm">NO</button>
                                     <button type="submit" class="btn btn-add btn-sm">YES</button>
                                  </div>
                               </div>
                            </fieldset>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
             <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
       </div>
       <!-- /.modal -->
    </section>
    <!-- /.content -->
 </div>

@endsection
