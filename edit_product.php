<?php

include "conexion.php";
error_reporting(E_ALL ^ E_NOTICE);

$idProduct = $_GET['id'];
$sql2 = "select * from products where id = '$idProduct'";
$result = mysqli_query($con, $sql2) or die("error");
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['product_name'];
    $ref = $row['product_ref'];
    $price = $row['price'];
    $weight = $row['weight'];
    $category = $row['category'];
    $stock = $row['stock'];
}

$mode = $_POST['mode'];
$id = $_POST['id'];
$newname = $_POST['product_name'];
$newref = $_POST['product_ref'];
$newprice = $_POST['price'];
$newweight = $_POST['weight'];
$newcategory = $_POST['category'];
$newstock = $_POST['stock'];
if ($mode === "update") {
    $sql = "update products set product_name = '$newname', product_ref = '$newref', price = '$newprice', weight = '$newweight', category = '$newcategory', stock = '$newstock' WHERE id = '$id' ";
    mysqli_query($con, $sql) or die("error");
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
            <h2 class="text-center">Edit Product</h2>
        </div>
        <div class="card-body">
        <form method="POST">
                <div class="row">
                    <div class="col">
                    <span>Product Name</span>
                        <input type="text" value="<?php echo $name ?>" id="name" class="form-control" placeholder="Product Name.." required>
                    </div>
                    <div class="col">
                    <span>Product Reference</span>
                        <input type="text" value="<?php echo $ref ?>" id="ref" class="form-control" placeholder="Product Reference.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <span>Product Price</span>
                        <input type="number" value="<?php echo $price ?>" id="price" class="form-control" placeholder="Product Price.." required>
                    </div>
                    <div class="col">
                    <span>Product Weight</span>
                        <input type="number" value="<?php echo $weight ?>" id="weigh" class="form-control" placeholder="Product Weight.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <span>Product Category</span>
                        <input type="text" value="<?php echo $category ?>" id="category" class="form-control" placeholder="Category.." required>
                    </div>
                    <div class="col">
                    <span>Product Stock</span>
                        <input type="number" value="<?php echo $stock ?>" id="stock" class="form-control" placeholder="Product Stock.." required>
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
                        url: 'edit_product.php',
                        type: 'POST',
                        data: {
                            mode: 'update',
                            id: "<?php echo $idProduct?>",
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