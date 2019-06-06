

// Read all products
function readAll() {
    $.ajax({
        type: "get",
        url: "read.php",
        success: function (data, status) {
            //var products = JSON.parse(data);
            //console.log(data);
            $("#contents").html(data);
            //console.log(products.status == "success");
        }
    });
}



// create product
// function createProduct(){
//     var name = $("#add_name").val();
//     var description = $("#add_description").val();
//     var price = $("#add_price").val();
//     var image = $("#file").val();
//     console.log(name+description+price);

//     if(!image){
//         console.log("Add image");
//         $("#error_msg").html(`
//             <div class="alert alert-danger">
//                 Error! Please add a product image
//             </div>
//         `);
        
//     }else{
//         $.post("create.php", 
//             {
//                 name:name,
//                 description:description,
//                 price:price,
//                 image:image
//             },
//             function (data, textStatus, jqXHR) {
//                 var data = JSON.parse(data);
//                 if(data.status == "success"){
//                     readAll();
//                     $("#feedback").html(`
//                         <div class='alert alert-success     alert-dismissible'>
//                         <a href='#' class='close'   data-dismiss='alert' aria-label='close'>&times;</a>
//                         <strong>Success ! </strong>${data.message}
//                         </div>
//                     `);
//                     $("#add_modal").modal("hide");
//                 }else{
//                     readAll();
//                     $("#feedback").html(`
//                         <div class='alert alert-danger     alert-dismissible'>
//                         <a href='#' class='close'   data-dismiss='alert' aria-label='close'>&times;</a>
//                         <strong>Error ! </strong>${data.message}
//                         </div>
//                     `);
//                     $("#add_modal").modal("hide");
//                 }
//                 console.log(data);
//             },
//         );
        
//     }
//     readAll();
// }


// delete product
function deleteProduct(id) {
    var answer = confirm("Do you want to delete this product? ");
    if (answer) {
        $.get("delete.php",
            { id: id },
            function (data, status) {
                var result = JSON.parse(data);
                console.log(result.status);
                if (result.status == "success") {
                    $("#feedback").html(`
                        <div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success ! </strong>${result.message}
                        </div>
                    `);
                    readAll();
                }
            }
        );
        //window.location = `delete.php?id=${id}`;
    }
}


// get product details
function getDetails(id) {
    $.get("read_one.php", { id: id },
        function (data, status) {
            var data = JSON.parse(data);
            var product = data.message[0];
            $("#edit_id").val(product.id);
            $("#edit_name").val(product.name);
            $("#edit_description").val(product.description);
            $("#edit_price").val(product.price);
            $("#edit_image").attr("src", "uploads/"+product.image);
            // console.log(product);
        }
    )
}


// update product
function upateProduct() {
    // console.log(id);
    var id = $("#edit_id").val();
    var name = $("#edit_name").val();
    var description = $("#edit_description").val();
    var price = $("#edit_price").val();
    
    $.post("update.php", {
        id:id,
        name:name,
        description:description,
        price:price
    },
    function (data, textStatus, jqXHR) {
        var data = JSON.parse(data);
        $("#feedback").html(`
        <div class='alert alert-success alert-dismissible'>
            <a href='#' class='close'data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Product updated.
        </div>
        `);
    });
    readAll();
}


// Document ready
$(document).ready(function () {
    readAll();

    $("#edit_submit_btn").click(function () {
        upateProduct();
        readAll();
        $("#myModal").modal("hide");
        
    });


    $("#add_submit_btn").click(function() {
    var image = document.getElementById("file");
    var name = $("#add_name").val();
    var description = $("#add_description").val();
    var price = $("#add_price").val();   

    var formData = new FormData();
    formData.append("image", image.files[0], image.files[0].name);
    formData.append("name", name);
    formData.append("description", description);
    formData.append("price", price);

    console.log(image.files[0]);
    if(!image){
        console.log("Add image");
        $("#error_msg").html(`
            <div class="alert alert-danger">
                Error! Please add a product image
            </div>
        `);
    }else{
        $.ajax({
            type: "post",
            url: "create.php",
            data: formData,
            processData : false,
            contentType: false,
            success: function (data, status) {
                console.log(data);
                var data = JSON.parse(data);
                    if(data.status == "success"){
                        readAll();
                        $("#feedback").html(`
                            <div class='alert alert-success     alert-dismissible'>
                            <a href='#' class='close'   data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success ! </strong>${data.message}
                            </div>
                        `);
                        $("#add_modal").modal("hide");
                    }else{
                        readAll();
                        $("#feedback").html(`
                            <div class='alert alert-danger     alert-dismissible'>
                            <a href='#' class='close'   data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Error ! </strong>${data.message}
                            </div>
                        `);
                        $("#add_modal").modal("hide");
                    }
                    $("#add_modal").modal("hide");
            }
        });
    }
        readAll();
        return false;
        
    });
});

// $(document).ready(function(){



//     $.get("read.php", function(data,status){
//             //alert (`${data}  ${status}`);
//             var products = JSON.parse(data);
//             output = `
//             <table class='table table-hover table-responsive table-bordered'>
//                 <tr>
//                     <th>ID</th>
//                     <th>Name</th>
//                     <th>Description</th>
//                     <th>Price</th>
//                     <th>Action</th>
//                 </tr>
//             `;

//             for (var i in products){
//                 output += `
//                     <tr>
//                         <td>${products[i].id}</td>
//                         <td>${products[i].name}</td>
//                         <td>${products[i].description}</td>
//                         <td>${products[i].price}</td>
//                         <td>
//                             <a href= ' read_one.php?id=${products[i].id}' class='btn btn-info m-r-1em'> Read </a>

//                             <a href='update.php?id=${products[i].id}' class='btn btn-primary m-r-1em'> Edit </a>

//                             <a href='#' id='delete'  onClick='deleteUser(${products[i].id})' class='btn btn-danger m-r-1em'> Delete </a>

//                         </td>
//                     </tr>
//                 `
//             }
//             output += `
//                 </table>
//             `;
//             $("#ajax").html(output);
//         });
// });
