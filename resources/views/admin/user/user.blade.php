@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-user-plus"></i>
       </div>
       <div class="header-title">
          <h1>Users</h1>
          <small>List of User</small>
       </div>
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="row">
             <div class="col-lg-12 pinpin">
                   <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
                       <div class="card-header">
                           <div class="card-title custom_title">
                               <h4>User Details</h4>
                           </div>
                       </div>
                       <div class="card-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                               <div class="btn-group d-flex" role="group">
                                  <div class="buttonexport">
                                     <a href="#" class="btn btn-add" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"></i> Add Users</a>
                                  </div>
                               </div>
                               <div class="btn-group">
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
                               </div>
                               <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                               <div class="table-responsive">
                                  <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                     <thead class="back_table_color">
                                        <tr class="info">
                                           <th>Photo</th>
                                           <th>Full Name</th>
                                           <th>Email</th>
                                           <th>NIC</th>
                                           <th>Contact Number</th>
                                           <th>Route</th>
                                           <th>Password</th>
                                           <th>Action</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                           <td><img src="assets/dist/img/m1.png" class="img-circle" alt="User Image" width="50" height="50"></td>
                                           <td>Chathuranga</td>
                                           <td>chathuranga@gmail.com</td>
                                           <td>865245789V</td>
                                           <td>0768542356</td>
                                           <td>Malabe</td>
                                           <td>********</td>
                                           <td>
                                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                                           </td>
                                        </tr>
                                        <tr>
                                           <td><img src="assets/dist/img/m2.png" class="img-circle" alt="User Image" width="50" height="50"></td>
                                           <td>Viduranga</td>
                                           <td>viduranga@gmail.com</td>
                                           <td>854260458V</td>
                                           <td>0777264217</td>
                                           <td>Kaduwela</td>
                                           <td>********</td>
                                           <td>
                                              <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </button>
                                           </td>
                                        </tr>
                                        <tr>
                                           <td><img src="assets/dist/img/m2.png" class="img-circle" alt="User Image" width="50" height="50"></td>
                                           <td>Tharaka</td>
                                           <td>tharaka@gmail.com</td>
                                           <td>903620579V</td>
                                           <td>0763593506</td>
                                           <td>Biyagama</td>
                                           <td>********</td>
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
                   <h3><i class="fa fa-plus m-r-5"></i> Update User</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                           <div class="row">
                                <div class="col-md-6 form-group">
                                   <label class="control-label">Photo</label>
                                   <input name="filebutton" class="input-file" type="file">
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6 form-group">
                                   <label class="control-label">Full Name</label>
                                   <input type="text" placeholder="Full Name" class="form-control">
                                </div>
                                <!-- Text input-->
                                <div class="col-md-6 form-group">
                                   <label class="control-label">Email</label>
                                   <input type="text" placeholder="Email" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                 <label class="control-label">NIC</label>
                                 <input type="text" placeholder="NIC" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                   <label class="control-label">Contact Numbaer</label>
                                   <input type="text" placeholder="Type" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                 <label class="control-label">Route</label>
                                 <input type="text" placeholder="Route" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                 <label class="control-label">Password</label>
                                 <input type="text" placeholder="Password" class="form-control">
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
                   <h3><i class="fa fa-plus m-r-5"></i> Add new User</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                            <div class="row">
                                <!-- Text input-->
                                <div class="col-md-6 form-group">
                                  <label class="control-label">Photo</label>
                                  <input name="filebutton" class="input-file" type="file">
                               </div>
                               <!-- Text input-->
                               <div class="col-md-6 form-group">
                                  <label class="control-label">Full Name</label>
                                  <input type="text" placeholder="Full Name" class="form-control">
                               </div>
                               <!-- Text input-->
                               <div class="col-md-6 form-group">
                                  <label class="control-label">Email</label>
                                  <input type="text" placeholder="Email" class="form-control">
                               </div>
                               <div class="col-md-6 form-group">
                                <label class="control-label">NIC</label>
                                <input type="text" placeholder="NIC" class="form-control">
                               </div>
                               <div class="col-md-6 form-group">
                                  <label class="control-label">Contact Numbaer</label>
                                  <input type="text" placeholder="Type" class="form-control">
                               </div>
                               <div class="col-md-6 form-group">
                                <label class="control-label">Route</label>
                                <input type="text" placeholder="Route" class="form-control">
                               </div>
                               <div class="col-md-6 form-group">
                                <label class="control-label">Password</label>
                                <input type="text" placeholder="Password" class="form-control">
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
       <!-- delete user Modal2 -->
       <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header modal-header-primary">
                   <h3><i class="fa fa-user m-r-5"></i> Delete User</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                            <fieldset>
                               <div class="col-md-12 form-group user-form-group">
                                  <label class="control-label">Delete User</label>
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
                <div class="modal-footer">
                   <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
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
