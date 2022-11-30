@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="header-icon">
      <i class="fa fa-bar-chart"></i>
  </div>
  <div class="header-title">
      <h1>Additional Details</h1>
  </div>
</section>


<section class="content">
 <div class="row">

    <div class="col-lg-12 pinpin">
        <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
            <div class="card-header">
                <div class="card-title custom_title">
                 <a href="#"> <h4>Report Edited Details</h4></a>
             </div>
         </div>

         <div class="card-body">

           <div class="table-responsive">
              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
               <thead class="back_table_color">
                <tr>
                    <th style="min-width: 50px">Created At</th>
                    <th style="min-width: 50px">User Name</th>
                    <th style="min-width: 50px">Dsr Name</th>
                    <th class="text-center">View</th>
                </tr>
            </thead>
            <tbody>

                @foreach($userData as $user_data)
                <tr>
                    <td>{{ $user_data->date }}</td>
                    <td>{{ $user_data->admin_name }}</td>
                    <td>{{ $user_data->dsr_name }}</td>
                    <td class="text-center">
                       <button type="button" class="btn btn-add btn-sm" onclick="viewAdditionalData({{ $user_data->id  }})">
                        <i class="fa fa-eye"></i>
                    </button>
                </td>
            </tr>
            @endforeach

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
</section>

</div>






<div class="modal" tabindex="-1" role="dialog" id="userDataModel">
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Additional Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="contact" aria-selected="false">Banking</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#direct_banking" role="tab" aria-controls="contact" aria-selected="false">Direct Banking</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#credits" role="tab" aria-controls="contact" aria-selected="false">Credits</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#creditcol" role="tab" aria-controls="contact" aria-selected="false">Credit Collection</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="banking" role="tabpanel" aria-labelledby="contact-tab">

          <div class="table-responsive mt-3">
            <table id="bankTable2" class="table table-bordered table-striped table-hover">
              <thead class="back_table_color">
                 <tr class="info">
                    <th>#</th>
                    <th>Bank Name</th>
                    <th>Old Ref #</th>
                    <th>New Ref #</th>
                    <th>Old Amount</th>
                    <th>New Amount</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>


<div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">

  <div class="table-responsive mt-3">
    <table id="directBankTable2" class="table table-bordered table-striped table-hover">
      <thead class="back_table_color">
         <tr class="info">
            <th>#</th>
            <th>Bank Name</th>
            <th>Old Ref #</th>
            <th>New Ref #</th>
            <th>Old Amount</th>
            <th>New Amount</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

</div>



<div class="tab-pane fade" id="credits" role="tabpanel" aria-labelledby="contact-tab">

  <div class="table-responsive mt-3">
    <table id="creditTable2" class="table table-bordered table-striped table-hover">
      <thead class="back_table_color">
         <tr class="info">
            <th>#</th>
            <th>Old Customer Name</th>
            <th>Customer Name</th>
            <th>Old Amount</th>
            <th>New Amount</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

</div>


<div class="tab-pane fade" id="creditcol" role="tabpanel" aria-labelledby="contact-tab">

  <div class="table-responsive mt-3">
    <table id="creditColTable2" class="table table-bordered table-striped table-hover">
      <thead class="back_table_color">
         <tr class="info">
            <th>#</th>
            <th>Old Customer Name</th>
            <th>Customer Name</th>
            <th>Old Amount</th>
            <th>New Amount</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

</div>





</div>

</div>
</div>
</div>
</div>

@endsection
