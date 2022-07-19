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


function viewDsr(dsr_id){
  $("#txt_drs_id").val(dsr_id);

  $.ajax({
    type: 'post',
    url: "/get_dsr",
    dataType: 'json',
    data: {
      "id": dsr_id,
    },
    success: function(data) {

      $("#salesTable tbody").empty();
      $("#inHandTable tbody").empty();
      $("#creditTable tbody").empty();
      $("#creditCollectionTable tbody").empty();
      $("#retailerTable tbody").empty();
      $("#bankTable tbody").empty();
      $("#directBankTable tbody").empty();

      var salecount = 1;
      var inhandcount = 1;
      var creditcount = 1;
      var creditcolcount = 1;
      var recount = 1;
      var bankcount = 1;
      var directbankcount = 1;

      for (var i = 0; i < data.saleData.length; i++) {
        $("#salesTable tbody").append("<tr><td>"+salecount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.saleData[i].item_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.saleData[i].item_qty+"></td>"+
          "<td><input type='text' class='form-control' value="+data.saleData[i].item_amount+"></td>"+
          "</tr>");
        salecount++;
      }

      for (var i = 0; i < data.inhandData.length; i++) {
        $("#inHandTable tbody").append("<tr><td>"+inhandcount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.inhandData[i].in_hand+"></td>"+
          "<td><input type='text' class='form-control' value="+data.inhandData[i].cash+"></td>"+
          "<td><input type='text' class='form-control' value="+data.inhandData[i].cheque+"></td>"+
          "</tr>");
        inhandcount++;
      }

      for (var i = 0; i < data.creditData.length; i++) {
        $("#creditTable tbody").append("<tr><td>"+creditcount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.creditData[i].credit_customer_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.creditData[i].credit_amount+"></td>"+
          "</tr>");
        creditcount++;
      }

      for (var i = 0; i < data.creditcolData.length; i++) {
        $("#creditCollectionTable tbody").append("<tr><td>"+creditcolcount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.creditcolData[i].credit_collection_customer_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.creditcolData[i].credit_collection_amount+"></td>"+
          "</tr>");
        creditcolcount++;
      }

      for (var i = 0; i < data.reData.length; i++) {
        $("#retailerTable tbody").append("<tr><td>"+recount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_customer_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_item_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_item_qty+"></td>"+
          "<td><input type='text' class='form-control' value="+data.reData[i].re_item_amount+"></td>"+
          "</tr>");
        recount++;
      }

      for (var i = 0; i < data.bankData.length; i++) {
        $("#bankTable tbody").append("<tr><td>"+bankcount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.bankData[i].bank_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.bankData[i].bank_ref_no+"></td>"+
          "<td><input type='text' class='form-control' value="+data.bankData[i].bank_amount+"></td>"+
          "</tr>");
        bankcount++;
      }

      for (var i = 0; i < data.directbankData.length; i++) {
        $("#directBankTable tbody").append("<tr><td>"+directbankcount+"</td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_customer_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_name+"></td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_ref_no+"></td>"+
          "<td><input type='text' class='form-control' value="+data.directbankData[i].direct_bank_amount+"></td>"+
          "</tr>");
        directbankcount++;
      }


      $("#dsrModal").modal("show");
    },
    error: function(error) {
      alert("error occured " + JSON.stringify(error));
    }
  });

}


$("#btnDsrApprove").click(function() {

  var dsr_id =$("#txt_drs_id").val();
  var saleTable = JSON.stringify(saleTableValues());
  var inHandTable = JSON.stringify(inHandTableValues());
  var creditTable = JSON.stringify(creditTableValues());
  var creditCollectionTable = JSON.stringify(creditCollectionTableValues());
  var retailerTable = JSON.stringify(retailerTableValues());
  var bankingTable = JSON.stringify(bankingTableValues());
  var directBankingTable = JSON.stringify(directBankingTableValues());

  $.ajax({
    type: 'post',
    url: "/approve_dsr",
    dataType: 'json',
    data: {
      "saleTable": saleTable,
      "inHandTable": inHandTable,
      "creditTable": creditTable,
      "creditCollectionTable": creditCollectionTable,
      "retailerTable": retailerTable,
      "bankingTable": bankingTable,
      "directBankingTable": directBankingTable,
      "id": dsr_id,
    },
    success: function(data) {

     swal_success("Dsr Approved Successfully");
     $("#dsrModal").modal("hide");
     location.reload();

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
    "itemName" : $(tr).find('td:eq(1)').find('input').val(),
    "itemQty" : $(tr).find('td:eq(2)').find('input').val(),
    "itemPrice" : $(tr).find('td:eq(3)').find('input').val()
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
    "inHand" : $(tr).find('td:eq(1)').find('input').val(),
    "cash" : $(tr).find('td:eq(2)').find('input').val(),
    "cheque" : $(tr).find('td:eq(3)').find('input').val()
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
    "customerName" : $(tr).find('td:eq(1)').find('input').val(),
    "amount" : $(tr).find('td:eq(2)').find('input').val(),
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
    "ccName" : $(tr).find('td:eq(1)').find('input').val(),
    "ccAmount" : $(tr).find('td:eq(2)').find('input').val(),
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
    "reCustomerName" : $(tr).find('td:eq(1)').find('input').val(),
    "reitemName" : $(tr).find('td:eq(2)').find('input').val(),
    "reQuantity" : $(tr).find('td:eq(3)').find('input').val(),
    "reAmount" : $(tr).find('td:eq(4)').find('input').val(),
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
    "bank" : $(tr).find('td:eq(1)').find('input').val(),
    "refno" : $(tr).find('td:eq(2)').find('input').val(),
    "amount" : $(tr).find('td:eq(3)').find('input').val(),
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
    "customerName" : $(tr).find('td:eq(1)').find('input').val(),
    "bank" : $(tr).find('td:eq(2)').find('input').val(),
    "refno" : $(tr).find('td:eq(3)').find('input').val(),
    "amount" : $(tr).find('td:eq(4)').find('input').val(),
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
      for (var i = 0; i < data.length; i++) {
       $("#transfer_status_table").append("<tr><td>"+count+"</td>"+
        "<td>"+data[i].name+"</td>"+
        "<td>"+data[i].qty+"</td>"+
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


////////////////////////////////////  Inventory end/////////////////////////////////////////////