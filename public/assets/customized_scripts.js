// validate to input only numbers //
function onlyNumberKey(evt) {
// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)){
  return false;
}
return true;
}
// validate to input only numbers  end//


//use this code to pass csrf token to ajax function. you dont have to include this token in ajax data proprty. just let it be
$(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });
});
//////

function swal_confirm(){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
  })
}

function swal_success(text){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: text,
    showConfirmButton: false,
    timer: 1500
  })
}

function swal_warning(text){
  Swal.fire({
    position: 'center',
    icon: 'warning',
    title: text,
    showConfirmButton: false,
    timer: 1500
  })
}


// edit User //
function editUser(user_id){
 $.ajax({
  type: 'post',
  url: "/get_user",
  dataType: 'json',
  data: {
    "id": user_id,
  },
  success: function(data) {

    $("#edit_user_id").val(data.data[0].id);
    $("#edit_user_name").val(data.data[0].name);
    $("#edit_user_email").val(data.data[0].email);
    $("#edit_user_nic").val(data.data[0].nic);
    $("#edit_user_contact").val(data.data[0].contact);
    $("#edit_user_route").val(data.data[0].route);
    $("#display_user_image").html("<img src=http://localhost:8000/"+data.data[0].profile_photo_path+" class='img-responsive' style='width:150px;height:100px;object-fit:contain;' /> ");

    $("#updateUserModal").modal('show');
  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});
}


// delete User //
function deleteUser(user_id){
  $("#delete_user_id").val(user_id);
  $("#deleteUserModal").modal('show');
}


// edit Item //
function editItem(item_id){
 $.ajax({
  type: 'post',
  url: "/get_item",
  dataType: 'json',
  data: {
    "id": item_id,
  },
  success: function(data) {

    $("#edit_item_id").val(data.data[0].id);
    $("#edit_item_name").val(data.data[0].name);
    $("#edit_item_pprice").val(data.data[0].purchasing_price);
    $("#edit_item_sprice").val(data.data[0].selling_price);
    $("#edit_item_qty").val(data.data[0].qty);

    $("#updateItemModal").modal('show');
  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});
}


// delete item //
function deleteItem(item_id){
  $("#delete_item_id").val(item_id);
  $("#deleteItemModal").modal('show');
}


////////////////////////////////////  Pending Dsr /////////////////////////////////////////////
$('.btnNext').click(function() {
  $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function() {
  $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
});


function viewDsr(psum_id,dsr_id,status){
  $("#txt_drs_id").val(dsr_id);
  $("#txt_pending_sum_id").val(psum_id);
  $("#txt_pending_sum_status").val(status);

  $.ajax({
    type: 'post',
    url: "/get_dsr",
    dataType: 'json',
    data: {
      "id": psum_id,
    },
    success: function(data) {

      $("#salesTable tbody").empty();
      $("#inHandTable tbody").empty();
      $("#creditTable tbody").empty();
      $("#creditTable tbody").empty();
      $("#creditCollectionTable tbody").empty();
      $("#retailerTable tbody").empty();
      $("#bankTable tbody").empty();
      $("#directBankTable tbody").empty();
      $("#inHandChequeTable tbody").empty();
      $("#creditItemTable tbody").empty();
      $("#creditCollectionItemTable tbody").empty();

      var salecount = 1;
      var inhandcount = 1;
      var creditcount = 1;
      var creditcolcount = 1;
      var recount = 1;
      var bankcount = 1;
      var directbankcount = 1;

      var disableValue = "";


      for (var i = 0; i < data.saleData.length; i++) {

        $("#salesTable tbody").append("<tr><td>"+salecount+"</td>"+
          "<td style='display:none;'>"+data.saleData[i].id+"</td>"+
          "<td><input type='text' class='form-control' value="+JSON.stringify(data.saleData[i].item_name)+"></td>"+
          "<td><input type='text' class='form-control' value="+data.saleData[i].item_qty+"></td>"+
          "<td><input type='text' class='form-control' value="+data.saleData[i].item_amount+"></td>"+
          "<td><input type='text' class='form-control' value="+(data.saleData[i].item_amount * data.saleData[i].item_qty)+"></td>"+
          "<td style='display:none;'><input type='text' class='form-control' value="+data.saleData[i].item_id+"></td>"+
          "<td style='display:none;'>"+data.saleData[i].sum_id+"</td>"+
          "<td style='display:none;'>"+data.saleData[i].dsr_id+"</td>"+
          "<td style='display:none;'>"+data.saleData[i].dsr_stock_id+"</td>"+
          "<td><a class='btn btn-danger dis' onclick='removeSaleRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        salecount++;
      }

      for (var i = 0; i < data.inhandData.length; i++) {
        $("#inHandTable tbody").append("<tr><td>"+inhandcount+"</td>"+
          "<td style='display:none;'>"+data.inhandData[i].id+"</td>"+
          "<td><input type='text' class='form-control' value="+data.inhandData[i].in_hand+"></td>"+
          "<td><input type='text' class='form-control' value="+data.inhandData[i].cash+"></td>"+
          "<td style='display:none;'><input type='text' class='form-control' value="+data.inhandData[i].cheque+"></td>"+
          "<td><a class='btn btn-danger btn-sm' "+disableValue+" onclick='removeInhandRow(this,"+status+")'><i class='fa fa-trash'></i></a>"+
          "<a class='btn btn-warning btn-sm' onclick='viewInhandCheques(this,"+status+","+psum_id+")'><i class='fa fa-eye'></i></a></td>"+
          "</tr>");
        inhandcount++;
      }

      for (var i = 0; i < data.creditData.length; i++) {
        $("#creditTable tbody").append("<tr><td>"+creditcount+"</td>"+
         "<td style='display: none'>"+data.creditData[i].id+"</td>"+
         "<td style='display: none'>"+data.creditData[i].credit_customer_name+"</td>"+
         "<td><input type='text' class='form-control' value="+JSON.stringify(data.creditData[i].credit_customer_name)+"></td>"+
         "<td style='display: none'>"+data.creditData[i].credit_amount+"</td>"+
         "<td><input type='text' class='form-control' value="+data.creditData[i].credit_amount+"></td>"+
         "<td><a class='btn btn-danger btn-sm' "+disableValue+" onclick='removeCreditRow(this,"+status+")'><i class='fa fa-trash'></i></a>"+
         "<a class='btn btn-warning btn-sm' onclick='viewCreditItems(this,"+status+","+data.creditData[i].id+")'><i class='fa fa-eye'></i></a></td>"+
         "</tr>");
        creditcount++;
      }

      for (var i = 0; i < data.creditcolData.length; i++) {
        $("#creditCollectionTable tbody").append("<tr><td>"+creditcolcount+"</td>"+
         "<td style='display:none'>"+data.creditcolData[i].id+"</td>"+
         "<td style='display: none'>"+data.creditcolData[i].credit_collection_customer_name+"</td>"+
         "<td><input type='text' class='form-control' value="+JSON.stringify(data.creditcolData[i].credit_collection_customer_name)+"></td>"+
         "<td style='display: none'>"+data.creditcolData[i].credit_collection_amount+"</td>"+
         "<td><input type='text' class='form-control' value="+data.creditcolData[i].credit_collection_amount+"></td>"+
         "<td><a class='btn btn-danger btn-sm' "+disableValue+" onclick='removeCreditColRow(this,"+status+")'><i class='fa fa-trash'></i></a>"+
         "<a class='btn btn-warning btn-sm' onclick='viewCreditColItems(this,"+status+","+data.creditcolData[i].id+")'><i class='fa fa-eye'></i></a></td>"+
         "</tr>");
        creditcolcount++;
      }

      for (var i = 0; i < data.reData.length; i++) {
        $("#retailerTable tbody").append("<tr><td>"+recount+"</td>"+
          "<td style='display:none'>"+data.reData[i].id+"</td>"+
          "<td><input type='text' class='form-control' value="+JSON.stringify(data.reData[i].re_customer_name)+"></td>"+
          "<td style='display:none'>"+data.reData[i].re_item_id+"</td>"+
          "<td><input type='text' class='form-control' value="+JSON.stringify(data.reData[i].name)+"></td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_item_qty+"></td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_item_amount+"></td>"+
          "<td><input type='text' class='form-control' value="+(data.reData[i].re_item_amount * data.reData[i].re_item_qty)+"></td>"+
          "<td style='display:none'>"+data.reData[i].dsr_stock_id+"</td>"+
          "<td><a class='btn btn-danger' "+disableValue+" onclick='removeRetailerRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        recount++;
      }

      for (var i = 0; i < data.bankData.length; i++) {
        $("#bankTable tbody").append("<tr><td>"+bankcount+"</td>"+
         "<td style='display:none;'>"+data.bankData[i].id+"</td>"+
         "<td><input type='text' class='form-control' value="+JSON.stringify(data.bankData[i].bank_name)+"></td>"+
         "<td style='display:none;'>"+data.bankData[i].bank_ref_no+"</td>"+
         "<td><input type='text' class='form-control' value="+data.bankData[i].bank_ref_no+"></td>"+
         "<td style='display:none;'>"+data.bankData[i].bank_amount+"</td>"+
         "<td><input type='text' class='form-control' value="+data.bankData[i].bank_amount+"></td>"+
         "<td><a class='btn btn-danger' "+disableValue+" onclick='removeBankRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
         "</tr>");
        bankcount++;
      }

      for (var i = 0; i < data.directbankData.length; i++) {
        $("#directBankTable tbody").append("<tr><td>"+directbankcount+"</td>"+
          "<td style='display:none;'>"+data.directbankData[i].id+"</td>"+
          "<td><input type='text' class='form-control' value="+JSON.stringify(data.directbankData[i].direct_bank_customer_name)+"></td>"+
          "<td><input type='text' class='form-control' value="+JSON.stringify(data.directbankData[i].direct_bank_name)+"></td>"+
          "<td style='display:none;'>"+data.directbankData[i].direct_bank_ref_no+"</td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_ref_no+"></td>"+
          "<td style='display:none;'>"+data.directbankData[i].direct_bank_amount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_amount+"></td>"+
          "<td><a class='btn btn-danger' "+disableValue+" onclick='removDbankRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        directbankcount++;
      }

      if(status == 0){
        $("#btnDsrApprove").prop('disabled', true);

        $('#btnSaleEdit').prop('disabled', true);
        $('#btnInhandEdit').prop('disabled', true);
        $('#btnBankEdit').prop('disabled', true);
        $('#btnDBankEdit').prop('disabled', true);
        $('#btnCreditEdit').prop('disabled', true);
        $('btnRetailerEdit').prop('disabled', true);
        $('#btnCreditColEdit').prop('disabled', true);

      }else{
        $("#btnDsrApprove").prop('disabled', false);

        $('#btnSaleEdit').prop('disabled', false);
        $('#btnInhandEdit').prop('disabled', false);
        $('#btnBankEdit').prop('disabled', false);
        $('#btnDBankEdit').prop('disabled', false);
        $('#btnCreditEdit').prop('disabled', false);
        $('btnRetailerEdit').prop('disabled', false);
        $('#btnCreditColEdit').prop('disabled', false);
      }



      $('#myTabContent input').attr('readonly', 'readonly');

      $("#dsrModal").modal("show");
    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

}


function viewInhandCheques(thisval,status,psum_id){

  $.ajax({
    type: 'post',
    url: "inhand_cheques",
    dataType: 'json',
    data: {
      "id": psum_id
    },
    beforeSend: function() {
     $("#inHandChequeTable tbody tr").remove();
   },
   success: function(data) {

    if(data.length != 0){
      var count = 1;
      for (var i = 0; i < data.length; i++) {
        $("#inHandChequeTable tbody").append("<tr><td>"+count+"</td>"+
          "<td style='display:none;'>"+data[i].id+"</td>"+
          "<td><input type='text' class='form-control' value="+data[i].cheque_no+"></td>"+
          "<td><input type='text' class='form-control' value="+data[i].cheque_amount+"></td>"+
          // "<td><a class='btn btn-danger' "+disableValue+" onclick='removDbankRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        count++;
      }
    }else{
      swal_warning("No cheques for this inhand")
    }


  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});

}


function viewCreditItems(thisval,status,credit_id){

  $.ajax({
    type: 'post',
    url: "credit_items",
    dataType: 'json',
    data: {
      "id": credit_id
    },
    beforeSend: function() {
     $("#creditItemTable tbody tr").remove();
   },
   success: function(data) {

    if(data.length != 0){
      var count = 1;
      for (var i = 0; i < data.length; i++) {
        $("#creditItemTable tbody").append("<tr><td>"+count+"</td>"+
          "<td style='display:none;'>"+data[i].id+"</td>"+
          "<td style='display:none;'>"+data[i].credit_id+"</td>"+
          "<td><input type='text' class='form-control' disabled value="+JSON.stringify(data[i].name)+"></td>"+
          "<td><input type='text' class='form-control' readonly value="+data[i].item_price+"></td>"+
          // "<td><a class='btn btn-danger' "+disableValue+" onclick='removDbankRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        count++;
      }
    }else{
      swal_warning("No items for this credit")
    }


  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});

}


function viewCreditColItems(thisval,status,creditcol_id){

  $.ajax({
    type: 'post',
    url: "creditcol_items",
    dataType: 'json',
    data: {
      "id": creditcol_id
    },
    beforeSend: function() {
     $("#creditCollectionItemTable tbody tr").remove();
   },
   success: function(data) {

    if(data.length != 0){
      var count = 1;
      for (var i = 0; i < data.length; i++) {
        $("#creditCollectionItemTable tbody").append("<tr><td>"+count+"</td>"+
          "<td style='display:none;'>"+data[i].id+"</td>"+
          "<td style='display:none;'>"+data[i].credit_collection_id+"</td>"+
          "<td><input type='text' class='form-control' disabled value="+JSON.stringify(data[i].name)+"></td>"+
          "<td><input type='text' class='form-control' readonly value="+data[i].item_price+"></td>"+
          // "<td><a class='btn btn-danger' "+disableValue+" onclick='removDbankRow(this,"+status+")'><i class='fa fa-trash'></i></a></td>"+
          "</tr>");
        count++;
      }
    }else{
      swal_warning("No items for this credit collection")
    }


  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});

}


///////////// delete relvent rows /////////////////
function removeSaleRow(thisval,status) {

  if(status !=0){
    var saleId = $(thisval).closest("tr").find('td:eq(1)').text();
    var deductAmount = $(thisval).closest("tr").find('td:eq(5)').find('input').val();
    var deductQty = $(thisval).closest("tr").find('td:eq(3)').find('input').val();
    var item_id = $(thisval).closest("tr").find('td:eq(6)').find('input').val();
    var psum_id = $("#txt_pending_sum_id").val();

    $.ajax({
      type: 'post',
      url: "/remove_sale",
      dataType: 'json',
      data: {
        "id": saleId,"item_id": item_id,"sum_id":psum_id,"deduction":deductAmount,"deductQty":deductQty
      },
      success: function(data) {
     // var dsr_id = $("#txt_drs_id").val(); var psum_id = $("#txt_pending_sum_id").val(); var status = $("#txt_pending_sum_status").val(); viewDsr(psum_id,dsr_id,status);
     $(thisval).closest("tr").remove();
     swal_success("Sale Removed!!");
   },
   error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});
  }

}


function removeInhandRow(thisval,status) {

  if(status !=0){
    var inhandId = $(thisval).closest("tr").find('td:eq(1)').text();
    var deductQty = $(thisval).closest("tr").find('td:eq(2)').find('input').val();
    var psum_id = $("#txt_pending_sum_id").val();

    $.ajax({
      type: 'post',
      url: "/remove_inhand",
      dataType: 'json',
      data: {
        "id": inhandId,"sum_id":psum_id,"deduction":deductQty
      },
      success: function(data) {
       $(thisval).closest("tr").remove();
       swal_success("Item Removed!!");
     },
     error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
  }

}


function removeBankRow(thisval,status) {

  if(status !=0){
    var bankId = $(thisval).closest("tr").find('td:eq(1)').text();
    var bankName = $(thisval).closest("tr").find('td:eq(2)').find('input').val();
    var deductQty = $(thisval).closest("tr").find('td:eq(4)').find('input').val();
    var psum_id = $("#txt_pending_sum_id").val();

    $.ajax({
      type: 'post',
      url: "/remove_bank",
      dataType: 'json',
      data: {
        "id": bankId,"sum_id":psum_id,"deduction":deductQty,"bank_name":bankName
      },
      success: function(data) {
       $(thisval).closest("tr").remove();
       swal_success("Amount Removed!!");
     },
     error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
  }

}


function removDbankRow(thisval,status) {

  if(status !=0){
    var dbankId = $(thisval).closest("tr").find('td:eq(1)').text();
    var bankName = $(thisval).closest("tr").find('td:eq(3)').find('input').val();
    var deductQty = $(thisval).closest("tr").find('td:eq(5)').find('input').val();
    var psum_id = $("#txt_pending_sum_id").val();

    $.ajax({
      type: 'post',
      url: "/remove_dbank",
      dataType: 'json',
      data: {
        "id": dbankId,"sum_id":psum_id,"deduction":deductQty,"dbank_name":bankName
      },
      success: function(data) {
       $(thisval).closest("tr").remove();
       swal_success("Amount Removed!!");
     },
     error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
  }
  
}


function removeCreditRow(thisval,status) {

 if(status !=0){
  var creditId = $(thisval).closest("tr").find('td:eq(1)').text();
  var deductQty = $(thisval).closest("tr").find('td:eq(3)').find('input').val();
  var psum_id = $("#txt_pending_sum_id").val();

  $.ajax({
    type: 'post',
    url: "/remove_credit",
    dataType: 'json',
    data: {
      "id": creditId,"sum_id":psum_id,"deduction":deductQty
    },
    success: function(data) {
     $(thisval).closest("tr").remove();
     swal_success("Item Removed!!");
   },
   error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});   
}

}


function removeRetailerRow(thisval,status) {

  if(status !=0){
    var retailerId = $(thisval).closest("tr").find('td:eq(1)').text();
    var item_id = $(thisval).closest("tr").find('td:eq(3)').text();
    var deductQty = $(thisval).closest("tr").find('td:eq(6)').find('input').val();
    var psum_id = $("#txt_pending_sum_id").val();

    $.ajax({
      type: 'post',
      url: "/remove_retailer",
      dataType: 'json',
      data: {
        "id": retailerId,"sum_id":psum_id, "item_id":item_id, "deduction":deductQty
      },
      success: function(data) {
       $(thisval).closest("tr").remove();
       swal_success("Item Removed!!");
     },
     error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
  }

}


function removeCreditColRow(thisval,status) {

  if(status !=0){
   var creditColId = $(thisval).closest("tr").find('td:eq(1)').text();
   var deductQty = $(thisval).closest("tr").find('td:eq(3)').find('input').val();
   var psum_id = $("#txt_pending_sum_id").val();

   $.ajax({
    type: 'post',
    url: "/remove_creditCol",
    dataType: 'json',
    data: {
      "id": creditColId,"sum_id":psum_id,"deduction":deductQty
    },
    success: function(data) {
     $(thisval).closest("tr").remove();
     swal_success("Item Removed!!");
   },
   error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});
 }
 
}


///////////// delete relvent rows /////////////////





$("#btnSaleEdit").click(function(e) {
  e.preventDefault();
  $('#salesTable tbody input').prop('readonly', false);
});

$("#btnInhandEdit").click(function(e) {
  e.preventDefault();
  $('#inHandTable tbody input').prop('readonly', false);
});

$("#btnCreditEdit").click(function(e) {
  e.preventDefault();
  $('#creditTable tbody input').prop('readonly', false);
  $('#creditItemTable tbody input').prop('readonly', false);
});

$("#btnCreditColEdit").click(function(e) {
  e.preventDefault();
  $('#creditCollectionTable tbody input').prop('readonly', false);
  $('#creditCollectionItemTable tbody input').prop('readonly', false);
});

$("#btnBankEdit").click(function(e) {
  e.preventDefault();
  $('#bankTable tbody input').prop('readonly', false);
});

$("#btnRetailerEdit").click(function(e) {
  e.preventDefault();
  $('#retailerTable tbody input').prop('readonly', false);
});

$("#btnDBankEdit").click(function(e) {
  e.preventDefault();
  $('#directBankTable tbody input').prop('readonly', false);
});



$("#btnDsrApprove").click(function() {

  var dsr_id =$("#txt_drs_id").val();
  var psum_id = $("#txt_pending_sum_id").val();
  var saleTable = JSON.stringify(saleTableValues());
  var inHandTable = JSON.stringify(inHandTableValues());
  var creditTable = JSON.stringify(creditTableValues());
  var creditItemTable = JSON.stringify(creditItemTableValues());
  var creditCollectionTable = JSON.stringify(creditCollectionTableValues());
  var creditCollectionItemTable = JSON.stringify(creditCollectionItemTableValues());
  var retailerTable = JSON.stringify(retailerTableValues());
  var bankingTable = JSON.stringify(bankingTableValues());
  var directBankingTable = JSON.stringify(directBankingTableValues());
  
//   alert(creditTable);
//   return;

$.ajax({
  type: 'post',
  url: "/approve_dsr",
  dataType: 'json',
  data: {
    "saleTable": saleTable,
    "inHandTable": inHandTable,
    "creditTable": creditTable,
    "creditItemTable": creditItemTable,
    "creditCollectionTable": creditCollectionTable,
    "creditCollectionItemTable": creditCollectionItemTable,
    "retailerTable": retailerTable,
    "bankingTable": bankingTable,
    "directBankingTable": directBankingTable,
    "id": dsr_id,
    "pending_sum_id": psum_id,
  },
  success: function(data) {

   swal_success("Dsr Approved Successfully");
   $("#dsrModal").modal("hide");
   setTimeout(function() {
    location.reload();
  }, 1300);

 },
 error: function(error) {
  alert("error occured " + JSON.stringify(error));
}
});

});



// sale table (values).
function saleTableValues(){
 var TableData = new Array();
 $('#salesTable tr').each(function(row, tr){
  TableData[row]={
    "id" : $(tr).find('td:eq(1)').text(),
    "itemName" : $(tr).find('td:eq(2)').find('input').val(),
    "itemQty" : $(tr).find('td:eq(3)').find('input').val(),
    "itemPrice" : $(tr).find('td:eq(4)').find('input').val(),
    "itemId" : $(tr).find('td:eq(6)').find('input').val(),
    "sumId" : $(tr).find('td:eq(7)').text(),
    "dsrId" : $(tr).find('td:eq(8)').text(),
    "stockId" : $(tr).find('td:eq(9)').text()
  }     
}); 
 TableData.shift();
 return TableData;
}

// inhand table (values).
function inHandTableValues(){
 var TableData = new Array();
 $('#inHandTable tr').each(function(row, tr){
  TableData[row]={
    "id" : $(tr).find('td:eq(1)').text(),
    "inHand" : $(tr).find('td:eq(2)').find('input').val(),
    "cash" : $(tr).find('td:eq(3)').find('input').val(),
    "cheque" : $(tr).find('td:eq(4)').find('input').val()
  }     
}); 
 TableData.shift();
 return TableData;
}

// credit table (values).
function creditTableValues(){
 var TableData = new Array();
 $('#creditTable tr').each(function(row, tr){
  TableData[row]={
   "id" : $(tr).find('td:eq(1)').text(),
   "oldcustomerName" : $(tr).find('td:eq(2)').text(),
   "customerName" : $(tr).find('td:eq(3)').find('input').val(),
   "oldamount" : $(tr).find('td:eq(4)').text(),
   "amount" : $(tr).find('td:eq(5)').find('input').val(),
 }     
}); 
 TableData.shift();
 return TableData;
}

function creditItemTableValues(){
 var TableData = new Array();
 $('#creditItemTable tr').each(function(row, tr){
  TableData[row]={
   "item_id" : $(tr).find('td:eq(1)').text(),
   "credit_id" : $(tr).find('td:eq(1)').text(),
   "item" : $(tr).find('td:eq(3)').text(),
   "price" : $(tr).find('td:eq(4)').find('input').val(),
 }     
}); 
 TableData.shift();
 return TableData;
}

// credit collection table (values).
function creditCollectionTableValues(){
 var TableData = new Array();
 $('#creditCollectionTable tr').each(function(row, tr){
  TableData[row]={
   "id" : $(tr).find('td:eq(1)').text(),
   "oldccName" : $(tr).find('td:eq(2)').text(),
   "ccName" : $(tr).find('td:eq(3)').find('input').val(),
   "oldccAmount" : $(tr).find('td:eq(4)').text(),
   "ccAmount" : $(tr).find('td:eq(5)').find('input').val(),
 }     
}); 
 TableData.shift();
 return TableData;
}


function creditCollectionItemTableValues(){
 var TableData = new Array();
 $('#creditCollectionItemTable tr').each(function(row, tr){
  TableData[row]={
   "item_id" : $(tr).find('td:eq(1)').text(),
   "collection_id" : $(tr).find('td:eq(2)').text(),
   "item_name" : $(tr).find('td:eq(3)').find('input').val(),
   "price" : $(tr).find('td:eq(4)').find('input').val(),
 }     
}); 
 TableData.shift();
 return TableData;
}


// retailer table (values).
function retailerTableValues(){
 var TableData = new Array();
 $('#retailerTable tr').each(function(row, tr){
  TableData[row]={
    "id" : $(tr).find('td:eq(1)').text(),
    "reCustomerName" : $(tr).find('td:eq(2)').find('input').val(),
    "reitemId" : $(tr).find('td:eq(3)').text(),
    "reQuantity" : $(tr).find('td:eq(5)').find('input').val(),
    "reAmount" : $(tr).find('td:eq(6)').find('input').val(),
    "reStockId" : $(tr).find('td:eq(8)').text(),
  }     
}); 
 TableData.shift();
 return TableData;
}

// banking table (values).
function bankingTableValues(){
 var TableData = new Array();
 $('#bankTable tr').each(function(row, tr){
  TableData[row]={
    "id" : $(tr).find('td:eq(1)').text(),
    "bank" : $(tr).find('td:eq(2)').find('input').val(),
    "oldrefno" : $(tr).find('td:eq(3)').text(),
    "refno" : $(tr).find('td:eq(4)').find('input').val(),
    "oldamount" : $(tr).find('td:eq(5)').text(),
    "amount" : $(tr).find('td:eq(6)').find('input').val(),
  }     
}); 
 TableData.shift();
 return TableData;
}

// direct banking table (values).
function directBankingTableValues(){
 var TableData = new Array();
 $('#directBankTable tr').each(function(row, tr){
  TableData[row]={
   "id" : $(tr).find('td:eq(1)').text(),
   "customerName" : $(tr).find('td:eq(2)').find('input').val(),
   "bank" : $(tr).find('td:eq(3)').find('input').val(),
   "oldrefno" : $(tr).find('td:eq(4)').text(),
   "refno" : $(tr).find('td:eq(5)').find('input').val(),
   "oldamount" : $(tr).find('td:eq(6)').text(),
   "amount" : $(tr).find('td:eq(7)').find('input').val(),
 }     
}); 
 TableData.shift();
 return TableData;
}



////////////////////////////////////  Pending Dsr end/////////////////////////////////////////////



////////////////////////////////////  Inventory /////////////////////////////////////////////


$("#txtItem").change(function(){

  var stock = $("#txtStock").val();
  var dsr = $("#txtDsr").val();
  var item = $(this).val();

  if(dsr == ""){
    swal_warning("Select a Dsr");
  }else if(item == ""){
    swal_warning("Select an item");
  }else{

    $.ajax({
      type: 'post',
      url: "/get_item",
      dataType: 'json',
      data: {
        "id": item,
      },
      success: function(data) {

        for (var i = 0; i < data.data.length; i++) {

          var contain_data =   $('#inventoryTable tr > td:contains('+data.data[i].name+')').length;

          if(contain_data == 0){
           $("#inventoryTable tbody").append("<tr>"+
            "<td style='display: none;'>"+data.data[i].id+"</td>"+
            "<td>"+data.data[i].name+"</td>"+
            "<td><input type='number' class='form-control' placeholder='Qty' required min='0'></td>"+
            "<td class='text-center'>"+data.data[i].qty+"</td>"+
            "<td class='text-center' style='display:none;'>"+data.data[i].selling_price+"</td>"+
            "<td class='text-center'><button type='button' class='btn btn-danger' onclick='removeRow(this)'><i class='fa fa-trash'></i></button></td>"+
            "</tr>");
         }else{
          swal_warning("Item Exist!");
        }
      }

    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

  }

});

function removeRow(thisval) {
  $(thisval).closest("tr").remove();
}


$("#btnSenditems").click(function() {

  var table_rows = $('#inventoryTable tbody tr').length;
  var stock_id = $("#txtStock").val();
  var dsr_id = $("#txtDsr").val();

  if(table_rows == 0){
    swal_warning("Add items to table!");
  }else if(stock_id == ""){
    swal_warning("Select the stock");
  }else if(dsr_id == ""){
    swal_warning("Select a dsr");
  }else{

    var tableData = JSON.stringify(inventoryTableValues());
    var err = 0;

    $('#inventoryTable tr').each(function(row, tr){
      if( parseFloat($(tr).find('td:eq(2)').find('input').val())  >  parseFloat($(tr).find('td:eq(3)').text()) ){
        err = 1;
      }
    });


    if(err == 1){
      swal_warning("Please check the item quantities");
    }else{
      $.ajax({
        type: 'post',
        url: "/send_item",
        dataType: 'json',
        data: {
          "stock_id": stock_id,"dsr_id": dsr_id,"tableData": tableData,
        },
        success: function(data) {

          swal_success("Data sent successfully!!");
          setTimeout(function() {
            location.reload();
          }, 1500);

        },
        error: function(error) {
          alert("error occured " + JSON.stringify(error));
        }
      });
    }



  }

});


// send inventory table (values).
function inventoryTableValues(){
 var TableData = new Array();
 $('#inventoryTable tr').each(function(row, tr){
  TableData[row]={
    "item_id" : $(tr).find('td:eq(0)').text(),
    "qty" : $(tr).find('td:eq(2)').find('input').val(),
    "bstock" : $(tr).find('td:eq(3)').text(),
    "sprice" : $(tr).find('td:eq(4)').text(),
  }     
}); 
 TableData.shift();
 return TableData;
}


function approveQty(return_id,item_id,qty){

  $.ajax({
    type: 'post',
    url: "update_return_items",
    dataType: 'json',
    data: {
      "id": return_id,"item_id": item_id,"qty": qty
    },
    success: function(data) {

      swal_success("Data Updated Successfully!!");
      setTimeout(function() {
        location.reload();
      }, 1300);

    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

}


function viewTransferItems(stock_id){

  $.ajax({
    type: 'post',
    url: "view_transfer_items",
    dataType: 'json',
    data: {
      "id": stock_id
    },
    beforeSend: function() {
      $("#transfer_status_table tbody").remove();
    },
    success: function(data) {

      var count = 1;
      var total = 0;
      for (var i = 0; i < data.length; i++) {

       if(data[i].status == 1){
        total = parseFloat(data[i].qty)  + parseFloat(data[i].sale_qty) + parseFloat(data[i].approve_return_qty) - parseFloat(data[i].retailer_qty);
      }else{
        total = (parseFloat(data[i].qty) + parseFloat(data[i].issue_return_qty)) - parseFloat(data[i].retailer_qty);
      }

      $("#transfer_status_table").append("<tr><td>"+count+"</td>"+
        "<td>"+data[i].name+"</td>"+
        "<td>"+ total +"</td>"+
        "</tr>");

      count++;
    }

    $("#transferItemModal").modal("show");

  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});

}


function viewTransferRejectedItems(stock_id){

  $.ajax({
    type: 'post',
    url: "view_transfer_rejected_items",
    dataType: 'json',
    data: {
      "id": stock_id
    },
    beforeSend: function() {
      $("#transfer_status_table tbody").remove();
    },
    success: function(data) {


      var count = 1;
      var total = 0;
      for (var i = 0; i < data.length; i++) {

        if(status==0){
          total = parseFloat(data[i].issue_return_qty);
        }else{
          total = parseFloat(data[i].qty);
        }
        // var qty = total-data[i].issue_return_qty;

        $("#transfer_status_table").append("<tr><td>"+count+"</td>"+
          "<td>"+data[i].name+"</td>"+
          "<td>"+ total +"</td>"+
          "</tr>");

        count++;
      }

      $("#transferItemModal").modal("show");

    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

}


// user search
function userSearch() {
  var text = $("#user_search").val();
  $.ajax({
    type: 'post',
    url: "user_search",
    dataType: 'json',
    data: {
      "text": text,
    },
    success: function (data) {
      let htmlView = "";
      if (data.userData.data.length <= 0) {
        htmlView += `
        <tr>
        <td colspan="5" class="my-1">No data.</td>
        </tr>`;
      } else {
        for (let i = 0; i < data.userData.data.length; i++) {
          htmlView += `
          <tr>
          <td>` + (i + 1) + `</td>
          <td><img src=http://localhost:8000/`+data.userData.data[i].profile_photo_path+` class="img-responsive img-fluid rounded" alt="User Image" width="70" height="70"></td>
          <td>` + data.userData.data[i].name + `</td>
          <td>` + data.userData.data[i].email + `</td>
          <td>` + data.userData.data[i].nic + `</td>
          <td>` + data.userData.data[i].contact + `</td>
          <td>` + data.userData.data[i].route + `</td>
          <td>
          <button type="button" class="btn btn-add btn-sm" onclick="editUser(`+data.userData.data[i].id+`)"><i class="fa fa-pencil"></i></button>
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(`+data.userData.data[i].id+`)"><i class="fa fa-trash-o"></i></button>
          </td>
          </tr>`;
        }
      }
      $('#userTable tbody').html(htmlView);
    },
    error: function (error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
}


// item search
function itemSearch() {
  var text = $("#item_search").val();
  $.ajax({
    type: 'post',
    url: "item_search",
    dataType: 'json',
    data: {
      "text": text,
    },
    success: function (data) {
      let htmlView = "";
      if (data.itemData.data.length <= 0) {
        htmlView += `
        <tr>
        <td colspan="5" class="my-1">No data.</td>
        </tr>`;
      } else {
        for (let i = 0; i < data.itemData.data.length; i++) {
          htmlView += `
          <tr>
          <td>` + (i + 1) + `</td>
          <td>` + data.itemData.data[i].name + `</td>
          <td>` + data.itemData.data[i].purchasing_price + `</td>
          <td>` + data.itemData.data[i].selling_price + `</td>
          <td>` + data.itemData.data[i].qty + `</td>
          <td>
          <button type="button" class="btn btn-add btn-sm" onclick="editUser(`+data.itemData.data[i].id+`)"><i class="fa fa-pencil"></i></button>
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(`+data.itemData.data[i].id+`)"><i class="fa fa-trash-o"></i></button>
          </td>
          </tr>`;
        }
      }
      $('#itemTable tbody').html(htmlView);
    },
    error: function (error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
}


// data return tab1 search
function itemSearch() {
  var text = $("#item_search").val();
  $.ajax({
    type: 'post',
    url: "item_search",
    dataType: 'json',
    data: {
      "text": text,
    },
    success: function (data) {
      let htmlView = "";
      if (data.itemData.data.length <= 0) {
        htmlView += `
        <tr>
        <td colspan="5" class="my-1">No data.</td>
        </tr>`;
      } else {
        for (let i = 0; i < data.itemData.data.length; i++) {
          htmlView += `
          <tr>
          <td>` + (i + 1) + `</td>
          <td>` + data.itemData.data[i].name + `</td>
          <td>` + data.itemData.data[i].purchasing_price + `</td>
          <td>` + data.itemData.data[i].selling_price + `</td>
          <td>` + data.itemData.data[i].qty + `</td>
          <td>
          <button type="button" class="btn btn-add btn-sm" onclick="editUser(`+data.itemData.data[i].id+`)"><i class="fa fa-pencil"></i></button>
          <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(`+data.itemData.data[i].id+`)"><i class="fa fa-trash-o"></i></button>
          </td>
          </tr>`;
        }
      }
      $('#itemTable tbody').html(htmlView);
    },
    error: function (error) {
      alert("error occured " + JSON.stringify(error));
    }
  });
}


function viewCompleteDsr(psum_id,dsr_id,status){

  $.ajax({
    type: 'post',
    url: "/get_complete_dsr",
    dataType: 'json',
    data: {
      "id": psum_id,
    },
    success: function(data) {


      $("#salesTable1 tbody").empty();
      $("#inHandTable1 tbody").empty();
      $("#creditTable1 tbody").empty();
      $("#creditTable1 tbody").empty();
      $("#creditCollectionTable1 tbody").empty();
      $("#retailerTable1 tbody").empty();
      $("#bankTable1 tbody").empty();
      $("#directBankTable1 tbody").empty();

      var salecount = 1;
      var inhandcount = 1;
      var creditcount = 1;
      var creditcolcount = 1;
      var recount = 1;
      var bankcount = 1;
      var directbankcount = 1;

      for (var i = 0; i < data.saleData.length; i++) {

        $("#salesTable1 tbody").append("<tr><td>"+salecount+"</td>"+
          "<td>"+data.saleData[i].item_name+"</td>"+
          "<td>"+data.saleData[i].item_qty+"</td>"+
          "<td>"+data.saleData[i].item_amount+"</td>"+
          "<td>"+(data.saleData[i].item_amount * data.saleData[i].item_qty)+"</td>"+
          "</tr>");
        salecount++;
      }

      for (var i = 0; i < data.inhandData.length; i++) {
        $("#inHandTable1 tbody").append("<tr><td>"+inhandcount+"</td>"+
          "<td>"+data.inhandData[i].in_hand+"</td>"+
          "<td>"+data.inhandData[i].cash+"</td>"+
          "<td>"+data.inhandData[i].cheque+"</td>"+
          "</tr>");
        inhandcount++;
      }

      for (var i = 0; i < data.creditData.length; i++) {
        $("#creditTable1 tbody").append("<tr><td>"+creditcount+"</td>"+
          "<td>"+data.creditData[i].credit_customer_name+"</td>"+
          "<td>"+data.creditData[i].credit_amount+"</td>"+
          "</tr>");
        creditcount++;
      }

      for (var i = 0; i < data.creditcolData.length; i++) {
        $("#creditCollectionTable1 tbody").append("<tr><td>"+creditcolcount+"</td>"+
          "<td>"+data.creditcolData[i].credit_collection_customer_name+"</td>"+
          "<td>"+data.creditcolData[i].credit_collection_amount+"</td>"+
          "</tr>");
        creditcolcount++;
      }

      for (var i = 0; i < data.reData.length; i++) {
        $("#retailerTable1 tbody").append("<tr><td>"+recount+"</td>"+
          "<td>"+data.reData[i].re_customer_name+"</td>"+
          "<td>"+data.reData[i].name+"</td>"+
          "<td>"+data.reData[i].re_item_qty+"</td>"+
          "<td>"+data.reData[i].re_item_amount+"</td>"+
          "<td>"+(data.reData[i].re_item_amount * data.reData[i].re_item_qty)+"</td>"+
          "</tr>");
        recount++;
      }

      for (var i = 0; i < data.bankData.length; i++) {
        $("#bankTable1 tbody").append("<tr><td>"+bankcount+"</td>"+
          "<td>"+data.bankData[i].bank_name+"</td>"+
          "<td>"+data.bankData[i].bank_ref_no+"</td>"+
          "<td>"+data.bankData[i].bank_amount+"</td>"+
          "</tr>");
        bankcount++;
      }

      for (var i = 0; i < data.directbankData.length; i++) {
        $("#directBankTable1 tbody").append("<tr><td>"+directbankcount+"</td>"+
          "<td>"+data.directbankData[i].direct_bank_customer_name+"</td>"+
          "<td>"+data.directbankData[i].direct_bank_name+"</td>"+
          "<td>"+data.directbankData[i].direct_bank_ref_no+"</td>"+
          "<td>"+data.directbankData[i].direct_bank_amount+"</td>"+
          "</tr>");
        directbankcount++;
      }


      $("#dsrCompleteModal").modal("show");

    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

}


function viewAdditionalData(id){

 $.ajax({
  type: 'post',
  url: "/get_additional_data",
  dataType: 'json',
  data: {
    "id": id,
  },
  success: function(data) {

   $("#bankTable2 tbody").empty();
   $("#directBankTable2 tbody").empty();
   $("#creditColTable2 tbody").empty();
   $("#creditTable2 tbody").empty();

   var bankcount = 1;
   var directcount = 1;
   var credit = 1;
   var creditCol = 1;

   for (var i = 0; i < data.bankData.length; i++) {
    $("#bankTable2 tbody").append("<tr><td>"+bankcount+"</td>"+
      "<td>"+data.bankData[i].bank_name+"</td>"+
      "<td>"+data.bankData[i].bank_ref_no+"</td>"+
      "<td>"+data.bankData[i].edited_bank_ref_no+"</td>"+
      "<td>"+data.bankData[i].bank_amount+"</td>"+
      "<td>"+data.bankData[i].edited_bank_amount+"</td>"+
      "</tr>");
    bankcount++;
  }

  for (var i = 0; i < data.directBankData.length; i++) {
    $("#directBankTable2 tbody").append("<tr><td>"+directcount+"</td>"+
      "<td>"+data.directBankData[i].bank_name+"</td>"+
      "<td>"+data.directBankData[i].direct_bank_ref_no+"</td>"+
      "<td>"+data.directBankData[i].edited_direct_bank_ref_no+"</td>"+
      "<td>"+data.directBankData[i].direct_bank_amount+"</td>"+
      "<td>"+data.directBankData[i].edited_direct_bank_amount+"</td>"+
      "</tr>");
    directcount++;
  }


  for (var i = 0; i < data.creditColData.length; i++) {
    $("#creditColTable2 tbody").append("<tr><td>"+creditCol+"</td>"+
      "<td>"+data.creditColData[i].credit_collection_customer_name+"</td>"+
      "<td>"+data.creditColData[i].edited_credit_collection_customer_name+"</td>"+
      "<td>"+data.creditColData[i].credit_collection_amount+"</td>"+
      "<td>"+data.creditColData[i].edited_credit_collection_amount+"</td>"+
      "</tr>");
    creditCol++;
  }

  for (var i = 0; i < data.creditData.length; i++) {
    $("#creditTable2 tbody").append("<tr><td>"+credit+"</td>"+
      "<td>"+data.creditData[i].credit_customer_name+"</td>"+
      "<td>"+data.creditData[i].edited_credit_customer_name+"</td>"+
      "<td>"+data.creditData[i].credit_amount+"</td>"+
      "<td>"+data.creditData[i].edited_credit_amount+"</td>"+
      "</tr>");
    credit++;
  }


  $("#userDataModel").modal("show");

},
error: function(error) {
  alert("error occured " + JSON.stringify(error));
}
});

}


// edit Item //
function editBank(bank_id){
 $.ajax({
  type: 'post',
  url: "/get_bank",
  dataType: 'json',
  data: {
    "id": bank_id,
  },
  success: function(data) {

    $("#edit_bank_id").val(data.id);
    $("#edit_bank_name").val(data.bank_name);
    $("#updateBankModal").modal('show');

  },
  error: function(error) {
    alert("error occured " + JSON.stringify(error));
  }
});
}



// delete bank //
function deleteBank(item_id){
  $("#delete_bank_id").val(item_id);
  $("#deleteBankModal").modal('show');
}