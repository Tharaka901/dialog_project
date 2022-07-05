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
                <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addItemModal"><i class="fa fa-plus"></i> Add Items</a>
             </div>
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
                  @if($itemData)
                  <?php $count=1; ?>
                  @foreach($itemData as $item)
                  <tr>
                   <td><?php echo $count ?></td>
                   <td>{{ $item->name }}</td>
                   <td><?php echo number_format($item->purchasing_price , 2) ?></td>
                   <td><?php echo number_format($item->selling_price , 2) ?></td>
                   <td>{{ $item->qty }}</td>
                   <td>
                     <button type="button" class="btn btn-add btn-sm" onclick="editItem({{ $item->id }})"><i class="fa fa-pencil"></i></button>
                     <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem({{ $item->id }})"><i class="fa fa-trash-o"></i> </button>
                  </td>
               </tr>
               <?php $count++ ?>
               @endforeach
               @endif
            </tbody>
         </table>
      </div>
      <div class="d-flex justify-content-center">
        <div>{!! $itemData->links() !!}</div>
     </div>
  </div>
</div>
</div>
</div>




<!-- Modal -->
<!-- User Modal1 -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-plus m-r-5"></i> Add New Item</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
          <div class="row">
             <div class="col-md-12">

              <form method="POST" id="item_registration" action="{{ route('item_registration') }}">
                 @csrf
                 <div class="row">
                  <div class="col-md-6 form-group">
                     <label class="control-label">Item Name</label>
                     <input type="text" placeholder="Item Name" class="form-control" id="item_name" name="item_name" required>
                  </div>
                  <div class="col-md-6 form-group">
                     <label class="control-label">Purchasing Price</label>
                     <input type="text" placeholder="Purchasing Price" class="form-control" id="item_pprice" name="item_pprice" required>
                  </div>
                  <div class="col-md-6 form-group">
                     <label class="control-label">Selling Price</label>
                     <input type="text" placeholder="Selling Price" class="form-control" id="item_sprice" name="item_sprice" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="control-label">Balance Qty</label>
                    <input type="text" placeholder="Quantity" class="form-control" id="item_qty" name="item_qty" required>
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




<!-- User Modal1 -->
<div class="modal fade" id="updateItemModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-plus m-r-5"></i> Update Item</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
          <div class="row">
             <div class="col-md-12">

               <form method="POST" id="item_update" action="{{ route('item_update') }}">
                 @csrf
                 <input type="hidden" id="edit_item_id" name="edit_item_id" value="0">
                 <div class="row">
                  <div class="col-md-6 form-group">
                     <label class="control-label">Item Name</label>
                     <input type="text" placeholder="Item Name" class="form-control" id="edit_item_name" name="edit_item_name" required>
                  </div>
                  <div class="col-md-6 form-group">
                     <label class="control-label">Purchasing Price</label>
                     <input type="text" placeholder="Purchasing Price" class="form-control" id="edit_item_pprice" name="edit_item_pprice" required>
                  </div>
                  <div class="col-md-6 form-group">
                     <label class="control-label">Selling Price</label>
                     <input type="text" placeholder="Selling Price" class="form-control" id="edit_item_sprice" name="edit_item_sprice" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <label class="control-label">Balance Qty</label>
                    <input type="text" placeholder="Quantity" class="form-control" id="edit_item_qty" name="edit_item_qty" required>
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
<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header modal-header-primary">
          <h3><i class="fa fa-user m-r-5"></i> Delete Item</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       </div>
       <div class="modal-body">
          <div class="row">
             <div class="col-md-12">
                <form method="POST" id="delete_item" action="{{ route('delete_item') }}">
                 @csrf
                 <input type="hidden" id="delete_item_id" name="delete_item_id">
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
