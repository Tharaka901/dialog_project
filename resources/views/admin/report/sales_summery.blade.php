@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="header-icon">
      <i class="fa fa-bar-chart"></i>
  </div>
  <div class="header-title">
      <h1>Total Sales Summary </h1>
  </div>
</section>
<!-- Main content -->
<section class="content">
 <div class="row">
    <div class="col-md-3">
        <div class="position-relative form-group"><label
            for="search" class="">Search</label><input
            name="search"
            placeholder="Search" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="position-relative form-group"><label
            for="fromdate" class="">From</label><input
            name="fromdate" id="fromdate" placeholder="Date"
            type="date" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="position-relative form-group"><label
            for="todate" class="">To</label><input
            name="todate" id="todate" placeholder="Date"
            type="date" class="form-control">
        </div>
    </div>
    <!-- running time -->
    <div class="col-lg-12 pinpin">
        <div class="card lobicard" id="lobicard-custom-control" data-sortable="true">
            <div class="card-header">
                <div class="card-title custom_title">
                 <a href="#"> <h4>DSR Sales Summery</h4></a>
             </div>
         </div>
         <div class="card-body">
           <!-- Plugin content:pdf,excel -->
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
                <!-- ./Plugin content:pdf,excel -->
                <div class="table-responsive">
                 <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                    <thead class="back_table_color">
                     <tr>
                         <th>No</th>
                         <th colspan="2">Name</th>

                         <?php 
                         foreach($itemSet as $items){
                            ?>
                            <th><?php echo $items->name ?></th>
                            <?php
                        }
                        ?>
                        <th>Total</th>
                    </tr>
                </thead>

                <?php 
                foreach($userSet as $users){
                    ?>
                    <tbody>
                     <tr>
                         <th rowspan="2">1</th>
                         <th rowspan="2"><?php echo $users->name ?></th>
                         <td>Qty</td>

                         <?php 

                         foreach($userItems as $uitems){
                            foreach($uitems as $uqty){
                                if($users->item_id == $uqty->item_id){
                                    ?>
                                    <td><?php echo $uqty->item_qty ?></td>
                                    <?php
                                }else{
                                    ?>
                                    <td>0</td>
                                    <?php
                                }
                            }
                        }

                        ?>


                        <td>100,200.00</td>
                    </tr>



                    <tr>
                     <td>Net VAL</td>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                     <td>100,200.00</td>
                 </tr>
             </tbody>
             <?php
         }
         ?>



         <tfoot class="back_table_color">
             <tr>
                 <th colspan="3">Total QTY</th>
                 <th>150</th>
                 <th>150</th>
                 <th>150</th>
                 <th>150</th>
                 <th>300,600.00</th>
             </tr>
             <tr>
                 <th colspan="3">Total Net VAL</th>
                 <th>150</th>
                 <th>150</th>
                 <th>150</th>
                 <th>150</th>
                 <th>300,600.00</th>
             </tr>
         </tfoot>


     </table>
 </div>
</div>
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>

@endsection
