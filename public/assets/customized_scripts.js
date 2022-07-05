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

function swal_success(){
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Your work has been saved',
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
