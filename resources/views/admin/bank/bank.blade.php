@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="header-icon">
       <i class="fa fa-bank"></i>
    </div>
    <div class="header-title">
       <h1>Banks</h1>
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
             <h4>Bank Details</h4>
          </div>
       </div>
       <div class="card-body">
          <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->

          <div class="row">

             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <form method="POST" id="item_registration" action="{{ route('bank_registration') }}">
                 @csrf
                 <div class="row">
                  <div class="col-md-12 form-group">
                     <label class="control-label">Item Name</label>
                     <input type="text" placeholder="Bank Name" class="form-control" id="bank_name" name="bank_name" required>
                  </div>
                  <div class="col-md-12 form-group user-form-group">
                   <div class="">
                     <button type="submit" class="btn btn-add btn-sm">Save</button>
                     <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  </div>
               </div>
            </div>
         </form>
      </div>

      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
             <thead class="back_table_color">
                <tr class="info">
                   <th>No</th>
                   <th>Bank Name</th>
                   <th>Status</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>
               @if($banks)
               @foreach($banks as $key => $bank)
               <tr>
                <td>{{ $banks->firstItem() + $key }}</td>
                <td>{{ $bank->bank_name }}</td>
                @if($bank->status == 1)
                <td>Activated</td>
                @else
                <td>Deactivated</td>
                @endif
                <td>
                  <button type="button" class="btn btn-add btn-sm" onclick="editBank({{ $bank->id }})"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="deleteBank({{ $bank->id }})"><i class="fa fa-trash-o"></i> </button>
               </td>
            </tr>
            @endforeach
            @endif
         </tbody>
      </table>
   </div>
   <div class="d-flex justify-content-center">
     <div>{!! $banks->links() !!}</div>
  </div>
</div>
</div>

</div>
</div>
</div>
</div>




<!-- User Modal1 -->
<div class="modal fade" id="updateBankModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-plus m-r-5"></i> Update Bank</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
          <div class="row">
             <div class="col-md-12">

               <form method="POST" id="item_update" action="{{ route('bank_update') }}">
                 @csrf
                 <input type="hidden" id="edit_bank_id" name="edit_bank_id" value="0">
                 <div class="row">
                  <div class="col-md-12 form-group">
                     <label class="control-label">Bank Name</label>
                     <input type="text" placeholder="Bank Name" class="form-control" id="edit_bank_name" name="edit_bank_name" required>
                  </div>
                  <div class="col-md-12 form-group user-form-group">
                   <div class="float-right">
                     <button type="submit" class="btn btn-add btn-sm">Update</button>
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
<!-- delete user Modal2 -->
<div class="modal fade" id="deleteBankModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-user m-r-5"></i> Delete Bank</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
          <div class="row">
             <div class="col-md-12">
                <form method="POST" id="delete_item" action="{{ route('delete_bank') }}">
                 @csrf
                 <input type="hidden" id="delete_bank_id" name="delete_bank_id">
                 <fieldset>
                   <div class="col-md-12 form-group user-form-group">
                      <label class="control-label">Are your sure? This process can't be rollback!</label>
                      <div class="float-right">
                         <button type="submit" class="btn btn-add btn-sm">YES</button>
                         <button type="button" class="btn btn-danger btn-sm">NO</button>
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
