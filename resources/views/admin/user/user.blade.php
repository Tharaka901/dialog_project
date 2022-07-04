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

              <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
              <div class="table-responsive">
                 <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                    <thead class="back_table_color">
                       <tr class="info">
                          <th>#</th>
                          <th>Photo</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>NIC</th>
                          <th>Contact</th>
                          <th>Route</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>

                     @if($userData)
                     <?php $count = 1; ?>
                     @foreach($userData as $user)
                     <tr>
                        <td><?php echo $count ?></td>
                        <td><img src="http://localhost:8000/{{$user->profile_photo_path}}" class="img-responsive img-fluid rounded" alt="User Image" width="70" height="70"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nic }}</td>
                        <td>{{ $user->contact }}</td>
                        <td>{{ $user->route }}</td>
                        <td>
                           <button type="button" class="btn btn-add btn-sm" onclick="editUser({{ $user->id }})"><i class="fa fa-pencil"></i></button>
                           <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})"><i class="fa fa-trash-o"></i></button>
                        </td>
                     </tr>
                     <?php $count++; ?>
                     @endforeach
                     @endif


                  </tbody>
               </table>
            </div>

            <div class="d-flex justify-content-center">
             <div>{!! $userData->links() !!}</div>
          </div>

       </div>
    </div>
 </div>
</div>



<!-- Modal -->
<!-- User Save Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
         <h3><i class="fa fa-plus m-r-5"></i> Add New User</h3>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="col-md-12">
             <form method="POST" id="user_registration" action="{{ route('user_registration') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                 <div class="col-md-6 form-group">
                   <label class="control-label">Full Name</label>
                   <input type="text" class="form-control pl-15" placeholder="Full Name" name="user_name" required>
                </div>
                <div class="col-md-6 form-group">
                   <label class="control-label">Email</label>
                   <input type="email" class="form-control pl-15" placeholder="Email"  name="user_email" required>
                </div>
                <div class="col-md-6 form-group">
                 <label class="control-label">NIC</label>
                 <input type="text" class="form-control pl-15" placeholder="Nic"  name="user_nic" maxlength="12" required>
              </div>
              <div class="col-md-6 form-group">
               <label class="control-label">Contact Number</label>
               <input type="text" class="form-control pl-15" placeholder="Contact"  name="user_contact" maxlength="10" onkeypress="return onlyNumberKey(event)" required>
            </div>
            <div class="col-md-6 form-group">
              <label class="control-label">Route</label>
              <input type="text" class="form-control pl-15" placeholder="Route"  name="user_route" required>
           </div>
           <div class="col-md-6 form-group">
              <label class="control-label">Password</label>
              <input type="password" class="form-control pl-15" placeholder="Password"  name="user_password" required>
           </div>
           <div class="col-md-12 form-group">
              <label class="control-label">Photo</label>
              <input class="form-control" type="file" id="user_image" name="user_image" style="padding: 3px;" required/>
           </div>
           <div class="col-md-12 form-group user-form-group">
              <div class="float-right">
                 <button type="submit" class="btn btn-add btn-sm">Save</button>
                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>
           </div>
        </div>
     </form>
  </div>
</div>
</div>
</div>
</div>
</div>



<!-- User Update Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-plus m-r-5"></i> Update User</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">

               <form method="POST" id="user_update" action="{{ route('user_update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_user_id" name="edit_user_id" value="0">
                <div class="row">
                   <div class="col-md-6 form-group">
                    <label class="control-label">Full Name</label>
                    <input type="text" class="form-control pl-15" placeholder="Full Name" id="edit_user_name" name="edit_user_name" required>
                 </div>
                 <div class="col-md-6 form-group">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control pl-15" placeholder="Email" id="edit_user_email"  name="edit_user_email" required>
                 </div>
                 <div class="col-md-6 form-group">
                   <label class="control-label">NIC</label>
                   <input type="text" class="form-control pl-15" placeholder="Nic" id="edit_user_nic"  name="edit_user_nic" maxlength="12" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="control-label">Contact Number</label>
                  <input type="text" class="form-control pl-15" placeholder="Contact" id="edit_user_contact"  name="edit_user_contact" maxlength="10" onkeypress="return onlyNumberKey(event)" required>
               </div>
               <div class="col-md-6 form-group">
                <label class="control-label">Route</label>
                <input type="text" class="form-control pl-15" placeholder="Route" id="edit_user_route"  name="edit_user_route" required>
             </div>
             <div class="col-md-6 form-group">
                <label class="control-label">Password</label>
                <input type="password" class="form-control pl-15" placeholder="Password" id="edit_user_password" name="edit_user_password">
             </div>
             <div class="col-md-12 form-group">
                <label class="control-label">Photo</label>
                <input class="form-control" type="file" id="edit_user_image" name="edit_user_image" style="padding: 3px;"/>
             </div>
             <div class="col-md-12 form-group">
               <div id="display_user_image"></div>
            </div>
            <div class="col-md-12 form-group user-form-group">
             <div class="float-right">
                <button type="submit" class="btn btn-add btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</button>
             </div>
          </div>
       </div>
    </form>

 </div>
</div>
</div>
</div>
</div>
</div>




<!-- Modal -->
<!-- delete user Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header modal-header-primary">
           <h3><i class="fa fa-user m-r-5"></i> Delete User</h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
           <div class="row">
              <div class="col-md-12">
               <form method="POST" id="delete_user" action="{{ route('delete_user') }}">
                @csrf
                <input type="hidden" id="delete_user_id" name="delete_user_id">
                <fieldset>
                 <div class="col-md-12 form-group user-form-group">
                  <label class="control-label">Are your sure? This process can't be rollback!</label>
                  <div class="float-right">
                    <button type="submit" class="btn btn-add btn-sm">YES</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">NO</button>
                 </div>
              </div>
           </fieldset>
        </form>
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
