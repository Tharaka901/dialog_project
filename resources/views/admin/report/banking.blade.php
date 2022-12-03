@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="header-icon">
      <i class="fa fa-bar-bank"></i>
  </div>
  <div class="header-title">
      <h1>Banking Details</h1>
  </div>
</section>


<section class="content">
 <div class="row">

    <div class="col-lg-12 pinpin">
        <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
            <div class="card-header">
                <div class="card-title custom_title">
                 <a href="#"> <h4>Banking Report Details</h4></a>
             </div>
         </div>

         <div class="card-body">


            <div class="row mb-2">
                <div class="col-md-3">
                    <select class="form-control" onChange="getBankDetails(this.value)">
                        <option value="">-select a bank-</option>
                        @foreach($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            

            <?php 

            if(isset($userData)){
                print_r(json_encode($userData));
            }

            ?>

            <div class="table-responsive">
              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
               <thead class="back_table_color">
                <tr>
                    <th style="min-width: 50px">Date</th>
                    <th style="min-width: 50px">DSR Name</th>
                    <th style="min-width: 50px">Deposit Type</th>
                    <th style="min-width: 50px">Ref Number</th>
                    <th style="min-width: 50px">Amount</th>
                </tr>
            </thead>
            <tbody>

               {{--   @foreach($userData as $user_data)
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
        @endforeach --}}

    </tbody>
</table>
</div>

{{-- <div class="d-flex justify-content-center">
    <div>{!! $userData->links() !!}</div>
</div>--}}

</div>

</div>
</div>


</div>
</section>


</div>

@endsection
