<?php
include "conexion.php";
error_reporting(E_ALL ^ E_NOTICE);

$name = $_POST['product_name'];
$ref = $_POST['product_ref'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$category = $_POST['category'];
$stock = $_POST['stock'];

if (!empty($name)) {

    $sql = "insert into products(product_name,product_ref,price,weight,category,stock) values ('$name','$ref','$price','$weight','$category','$stock')";
    mysqli_query($con, $sql) or die("error");
    echo "<script> console.log('ok')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>New Product</title>
</head>
<style>
    input {
        margin-left: 10px;
    }

    .row {
        margin-top: 15px;
    }

    .card {
        width: 70%;
        margin: 0 auto;
    }

    img {
        margin: 0 auto;
    }
</style>

<body class="container">
    <div class="row">
        <div class="col-md-12">
            <center>
                <img src="https://ii.ct-stc.com/1/whitelabel/612/afc9010d-79d3-45cf-a1b1-812741f0ac89_LOGO.jpg" />
            </center>
        </div>

    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="text-center">Add New Product</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col">
                        <span>Product Name</span>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                    <div class="col">
                        <span>Product Reference</span>
                        <input type="text" id="ref" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>Product Price</span>
                        <input type="number" id="price" class="form-control" required>
                    </div>
                    <div class="col">
                        <span>Product Weight</span>
                        <input type="number" id="weigh" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>Product Category</span>
                        <input type="text" id="category" class="form-control" required>
                    </div>
                    <div class="col">
                        <span>Product Stock</span>
                        <input type="number" id="stock" class="form-control" required>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button id="save" class="btn btn-block btn-success mt-2">Save</button>
            <a href="list_products.php" class="btn btn-block btn-primary mt-2">Go to products</a>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $('#save').click(function() {
                let name = $('#name').val();
                let ref = $('#ref').val();
                let price = $('#price').val();
                let weight = $('#weight').val();
                let category = $('#category').val();
                let stock = $('#stock').val();

                if ((name == "") || (ref == "") || (price == 0) || (weight == 0) || (category == "") || (stock == 0)) {
                    Swal.fire({
                        title: 'Falta información',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                } else {
                    $.ajax({
                        url: 'new_product.php',
                        type: 'POST',
                        data: {
                            product_name: name,
                            product_ref: ref,
                            price,
                            weight,
                            category,
                            stock
                        },
                        succes: function(response) {

                        }
                    })
                    Swal.fire({
                        title: 'Enviado!',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    $('#name').val('');
                    $('#ref').val('');
                    $('#price').val('');
                    $('#weight').val('');
                    $('#category').val('');
                    $('#stock').val('');

                }

            })
        });
    </script>
</body>

</html>