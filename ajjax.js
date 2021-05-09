$(document).on('click', '#btn-add', function (e) {
  console.log("in here");
  var data = // $('#user_form').serialize()
  {
    product: $("#product").val(),
    price: $("#price").val(),
    purchase: $("#purchase").val(),
    manufacturing: $("#manufacturing").val(),
    expiry: $("#expiry").val(),
    quantity:$("#quantity").val()
  }
  console.log("data", data);
  $.ajax({
    data: {
      type: 1,
      ...data

    } ,
    type: 'POST',
    url: 'saave.php',
    success: function (dataResult) {
      console.log("dataResult", dataResult);
      var dataResult = JSON.parse(dataResult)
      
      if (dataResult.statusCode == 200) {
        $('#addEmployeeModal').modal('hide')
        alert('Data added successfully !')
        location.reload()
      } else if (dataResult.statusCode == 201) {
        alert(dataResult)
      }
    },
  })
})
$(document).on('click', '.update', function (e) {
  console.log("in here");
  var id = $(this).attr('data-id')
  var product = $(this).attr('data-product')
  var price = $(this).attr('data-price')
  var purchase = $(this).attr('data-purchase')
  var manufacturing = $(this).attr('data-manufacturing')
  var expiry = $(this).attr('data-expiry')
  var quantity = $(this).attr('data-quantity')
  console.log(id, product, price, purchase, manufacturing, expiry, quantity);
  $('#id_u').val(id)
  $('#product_u').val(product)
  $('#price_u').val(price)
  $('#purchase_u').val(purchase)
  $('#manufacturing_u').val(manufacturing)
  $('#expiry_u').val(expiry)
  $('#quantity_u').val(quantity)
})

$(document).on('click', '#update', function (e) {
  var data = // $('#update_form').serialize()
  {
    id: 
     $("#id_u").val(),
    product: $("#product_u").val(),
    price: $("#price_u").val(),
    purchase: $("#purchase_u").val(),
    manufacturing: $("#manufacturing_u").val(),
    expiry: $("#expiry_u").val(),
    quantity:$("#quantity_u").val()
  }
  $.ajax({
    data: {
      type: 2,
      ...data
    },
    type: 'POST',
    url: 'saave.php',
    success: function (dataResult) {
      console.log("dataResult", dataResult)
      var dataResult = JSON.parse(dataResult)
      if (dataResult.statusCode == 200) {
        $('#editEmployeeModal').modal('hide')
        alert('Data updated successfully !')
        location.reload()
      } else if (dataResult.statusCode == 201) {
        alert(dataResult)
      }
    },
  })
})
$(document).on('click', '.delete', function () {
  var id = $(this).attr('data-id')
  $('#id_d').val(id)
  console.log("id", id)
})
$(document).on('click', '#delete', function () {
  $.ajax({
    url: 'saave.php',
    type: 'POST',
    cache: false,
    data: {
      type: 3,
      id: $('#id_d').val(),
    },
    success: function (dataResult) {
      console.log("dataResult", dataResult);
      $('#deleteEmployeeModal').modal('hide')
     // $('#' + dataResult).remove()
    },
  })
})
$(document).on('click', '#delete_multiple', function () {
  var user = []
  $('.user_checkbox:checked').each(function () {
    user.push($(this).data('user-id'))
  })
  if (user.length <= 0) {
    alert('Please select records.')
  } else {
    WRN_PROFILE_DELETE =
      'Are you sure you want to delete ' +
      (user.length > 1 ? 'these' : 'this') +
      ' row?'
    var checked = confirm(WRN_PROFILE_DELETE)
    if (checked == true) {
      var selected_values = user.join(',')
      console.log(selected_values)
      $.ajax({
        type: 'POST',
        url: 'saave.php',
        cache: false,
        data: {
          type: 4,
          id: selected_values,
        },
        success: function (response) {
          var ids = response.split(',')
          for (var i = 0; i < ids.length; i++) {
            $('#' + ids[i]).remove()
          }
        },
      })
    }
  }
})
$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip()
  var checkbox = $('table tbody input[type="checkbox"]')
  $('#selectAll').click(function () {
    if (this.checked) {
      checkbox.each(function () {
        this.checked = true
      })
    } else {
      checkbox.each(function () {
        this.checked = false
      })
    }
  })
  checkbox.click(function () {
    if (!this.checked) {
      $('#selectAll').prop('checked', false)
    }
  })
})
