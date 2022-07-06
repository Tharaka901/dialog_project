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

  $.ajax({
    type: 'post',
    url: "/approve_dsr",
    dataType: 'json',
    data: {
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