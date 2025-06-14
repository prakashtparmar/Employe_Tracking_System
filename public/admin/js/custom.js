$(document).ready(function () {
    $('#current_pwd').keyup(function () {
        var current_pwd = $('#current_pwd').val(); // Fixed selector

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // lowercase 'headers'
            },
            type: 'POST',
            url: '/admin/verify-password',
            data: { current_pwd: current_pwd }, // fixed 'data' key
            success: function (resp) {
                if (resp === "false") {
                    $("#verifyPwd").html("<font color='red'>Current Password is incorrect</font>");
                } else if (resp === "true") {
                    $("#verifyPwd").html("<font color='green'>Current Password is correct</font>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    $(document).on('click', '#deleteProfileImage', function()   {
    if (confirm('Are you sure you want to remove your Profile Image?')) {
        var admin_id = $(this).data('admin-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: 'delete-profile-image',
            data: { admin_id: admin_id },
            success: function(resp) {
                if (resp['status'] == true) {
                    alert(resp['message']);
                    $('#profileImageBlock').remove();
                }
            },
            error: function() {
                alert("Error occurred while deleting the image.");
            }
        });
    }
});

// Update Subadmin Status
$(document).on("click", ".updateSubadminStatus", function() {
    var status = $(this).children("i").data("status");
    var subadmin_id = $(this).data("subadmin_id");

    $.ajax({
        headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/admin/update-subadmin-status',
        data: { status: status, subadmin_id: subadmin_id },
        success: function(resp) {
            if (resp['status'] == 0) {
                $("[data-subadmin_id='" + subadmin_id + "']").html("<i class='fas fa-toggle-off' style='color:grey' data-status='0'></i>");
            } else if (resp['status'] == 1) {
                $("[data-subadmin_id='" + subadmin_id + "']").html("<i class='fas fa-toggle-on' style='color:green' data-status='1'></i>");
            }
        },
        error: function() {
            alert("Error");
        }
    });
});


$(document).on("click", ".updateCategoryStatus", function () {
  var status = $(this).find("i").data("status");
  var category_id = $(this).data("category-id");

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "post",
    url: "/admin/update-category-status",
    data: { status: status, category_id: category_id },
    success: function (resp) {
      if (resp["status"] == 0) {
        $("a[data-category-id='" + category_id + "']").html(
          "<i class='fas fa-toggle-off' style='color:grey' data-status='Inactive'></i>"
        );
      } else if (resp["status"] == 1) {
        $("a[data-category-id='" + category_id + "']").html(
          "<i class='fas fa-toggle-on' style='color:#3f6ed3' data-status='Active'></i>"
        );
      }
    },
    error: function () {
      alert("Error updating category status."); 
    },
  });
});


$(document).on("click", ".updateProductStatus", function () {
  var status = $(this).find("i").data("status");
  var product_id = $(this).data("product-id");

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "post",
    url: "/admin/update-product-status",
    data: { status: status, product_id: product_id },
    success: function (resp) {
      if (resp["status"] == 0) {
        $("a[data-product-id='" + product_id + "']").html(
          "<i class='fas fa-toggle-off' style='color:grey' data-status='Inactive'></i>"
        );
      } else if (resp["status"] == 1) {
        $("a[data-product-id='" + product_id + "']").html(
          "<i class='fas fa-toggle-on' style='color:#3f6ed3' data-status='Active'></i>"
        );
      }
    },
    error: function () {
      alert("Error updating product status."); 
    },
  });
});


$(document).on('click', '#deleteCategoryImage', function(){
    if (confirm('Are you sure you want to remove this Category Image?')) {
        var category_id = $(this).data('category-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/delete-category-image',
            data: {category_id:category_id},
            success: function(resp) {
                if (resp['status'] == true) {
                    alert(resp['message']);
                    $('#categoryImageBlock').remove();
                }
            }, error: function(){
                alert('Error occurred while removing image.');
            }
        });
    }
});


$(document).on('click', '#deleteSizeChartImage', function() {
    if (confirm('Are you sure you want to remove this Size Chart Image?')) {
        var category_id = $(this).data('category-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/delete-sizechart-image',
            data: { category_id: category_id },
            success: function(resp) {
                if (resp['status'] == true) {
                    alert(resp['message']);
                    $('#sizechartImageBlock').remove();
                }
            },
            error: function() {
                alert("Error occurred while deleting the image.");
            }
        });
    }
});

// $(".confirmDelete").click(function() {
//         var name = $(this).attr('name');
//         if (confirm("Are you sure to delete this " + name + " ?")) {
//             return true; // Proceed with deletion (e.g., form submission)
//         }
//         return false; // Cancel deletion
//     });

$(document).on("click", ".confirmDelete", function (e) {
    e.preventDefault(); // Prevent the default action of the clicked element (e.g., following a link)

    const button = $(this); // Use const for variables that won't be reassigned
    const module = button.data("module"); // Get 'module' data attribute
    const moduleId = button.data("id");   // Use camelCase for variable names (more common in JS)

    const form = button.closest("form"); // Find the closest parent <form> element

    // Construct the redirect URL for cases where a form submission isn't used
    const redirectUrl = `/admin/delete-${module}/${moduleId}`; // Use template literals for cleaner string concatenation

    Swal.fire({
        title: 'Are you sure?', // Corrected "Are sure?" to "Are you sure?" for better grammar
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Logic to handle deletion based on whether a form is present and valid
            if (form.length > 0 && form.attr("action") && form.attr("method") === "POST") {
                // If a valid form is found, prepare and submit it

                // Check if a hidden input for '_method' (common in Laravel/Rails for RESTful DELETE) exists
                if (form.find("input[name='_method']").length === 0) {
                    // If not present, append it to mimic a DELETE request via POST
                    form.append('<input type="hidden" name="_method" value="DELETE">');
                }
                form.submit(); // Submit the form
            } else {
                // If no valid form is found, or if it's not a POST form, redirect directly
                window.location.href = redirectUrl;
            }
        }
    });
});


});