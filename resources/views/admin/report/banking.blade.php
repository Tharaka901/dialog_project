@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-bank"></i>
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

            <div class="table-responsive">
                <table id="bankingDetailsTable" class="table table-bordered table-striped table-hover">
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
