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
                            <a href="#">
                                <h4>Banking Report Details</h4>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('get_bank_details') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <select class="form-control" id="id" name="id" value="{{ request()->get('id') }}">
                                                <option value="">-select a bank-</option>
                                                @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group user-form-group">
                                            <button type="submit" class="btn btn-add btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="contact" aria-selected="false">Banking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#direct_banking" role="tab" aria-controls="contact" aria-selected="false">Direct Banking</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="banking" role="tabpanel" aria-labelledby="contact-tab">
                               <div class="table-responsive">
                                <table id="bankingDetailsTable" class="table table-bordered table-striped table-hover">
                                    <thead class="back_table_color">
                                        <tr>
                                            <th style="min-width: 50px">Date</th>
                                            <th style="min-width: 50px">Bank Name</th>
                                            <th style="min-width: 50px">DSR Name</th>
                                            <th style="min-width: 50px">Ref Number</th>
                                            <th style="min-width: 50px">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($bankData))
                                        @foreach($bankData as $bank)
                                        <tr>
                                            <th style="min-width: 50px">{{ $bank->created_at }}</th>
                                            <th style="min-width: 50px">{{ $bank->bankname }}</th>
                                            <th style="min-width: 50px">{{ $bank->name }}</th>
                                            <th style="min-width: 50px">{{ $bank->ref_no }}</th>
                                            <th style="min-width: 50px">{{ $bank->amount }}</th>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center">
                               <div>{!! $bankData->links() !!}</div>
                           </div>

                       </div>

                       <div class="tab-pane fade" id="direct_banking" role="tabpanel" aria-labelledby="contact-tab">

                        <div class="table-responsive">
                            <table id="bankingDetailsTable" class="table table-bordered table-striped table-hover">
                                <thead class="back_table_color">
                                    <tr>
                                        <th style="min-width: 50px">Date</th>
                                        <th style="min-width: 50px">Bank Name</th>
                                        <th style="min-width: 50px">DSR Name</th>
                                        <th style="min-width: 50px">Ref Number</th>
                                        <th style="min-width: 50px">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @if(isset($directBankData))
                                 @foreach($directBankData as $dbank)
                                 <tr>
                                    <th style="min-width: 50px">{{ $dbank->created_at }}</th>
                                    <th style="min-width: 50px">{{ $dbank->bankname }}</th>
                                    <th style="min-width: 50px">{{ $dbank->name }}</th>
                                    <th style="min-width: 50px">{{ $dbank->ref_no }}</th>
                                    <th style="min-width: 50px">{{ $dbank->amount }}</th>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                       <div>{!! $directBankData->links() !!}</div>
                   </div>

               </div>
           </div>


       </div>
   </div>
</div>
</div>
</section>
</div>
@endsection