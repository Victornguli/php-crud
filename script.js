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

function getDetails(id) {
    $.get("read_one.php", { id: id },
        function (data, status) {
            var data = JSON.parse(data);
            var product = data.message[0];
            $("#edit_id").val(product.id);
            $("#edit_name").val(product.name);
            $("#edit_description").val(product.description);
            $("#edit_price").val(product.price);
            // console.log(product);
        }
    )
}

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

function readAll() {
    $.ajax({
        type: "get",
        url: "read.php",
        success: function (data, status) {
            var products = JSON.parse(data);

            if (products.status == "success") {
                var product_list = products.message;
                // console.log(product_list);
                var output = `
                <table class="table table-resposive table-striped table-hover ">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            `;
                for (var i in product_list) {
                    output += `
                    <tr>
                        <td> ${product_list[i].id}</td>
                        <td> ${product_list[i].name}</td>
                        <td> ${product_list[i].description}</td>
                        <td> ${product_list[i].price}</td>
                        <td>
                            <button class="btn btn-info"
                            onclick="getDetails(${product_list[i].id})" data-toggle="modal"  data-target="#edit-modal">Edit</button>
                            <!-- <button class="btn btn-success" id="${product_list[i].id}">Edit</button> --!>
                            <button class="btn btn-danger" onclick="deleteProduct(${product_list[i].id})" id="#delete_btn">Delete</button>
                        </td>
                    </tr>

                    <tr id="${product_list[i].id}" class="collapse">
                        <td></td>
                        <td colspan="4"><div id="edit${product_list[i].id}"></div></td>
                    </tr>
                `;
                }
                $("#contents").html(output);
            }
            //No Products Found
            else if (products.status == 404) {
                $("#contents").html(`
                    <div class="alert alert-danger">Zero products found!</div>
                `);
            }
            else {
                $("#contents").html(`
                <div class="alert alert-danger">Error failed to retreive products!</div>
                `);
            }

            //console.log(products.status == "success");
        }
    });
}

$(document).ready(function () {
    readAll();

    $("#edit_submit_btn").click(function () {
        upateProduct();
        readAll();
        $("#myModal").modal("hide");
        
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
