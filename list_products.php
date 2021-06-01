<?php

include "conexion.php";
error_reporting(E_ALL ^ E_NOTICE);

$sql = "select * from products ";
$result = mysqli_query($con, $sql) or die("error en la consulta");

$mode = $_POST['mode'];
$id = $_POST['idProduct'];

if ($mode === "delete") {
    $sql2 = "delete from products where id = '$id'";
    mysqli_query($con, $sql2) or die("error");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body class="container">
    <div class="row mt-5">
        <div class="col-md-2">
            <img src="https://ii.ct-stc.com/1/whitelabel/612/afc9010d-79d3-45cf-a1b1-812741f0ac89_LOGO.jpg" />

        </div>
        <div class="col-md-8">

            <h2 class="text-center">Products List</h2>
        </div>
        <div class="col-md-2">
            <a href="new_product.php" class="btn btn-success btn-block"><strong>New Product</strong> </a>
        </div>

    </div>
    <hr>
    <table id="example" class="display" style="width:100%">
        <thead>
            <th>ID</th>
            <th>Product Name</th>
            <th>Reference</th>
            <th>Price</th>
            <th>Weight</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Create</th>
            <th>Last Sell</th>
            <th>Options</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                    <tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['product_name'] . "</td>
                    <td>" . $row['product_ref'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['weight'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['stock'] . "</td>
                    <td>" . $row['creation'] . "</td>
                    <td>" . $row['last_sell'] . "</td>
                    <td><a class='btn btn-success' href='sell_product.php?id=" . $row['id'] . "'>Sell</a></td>
                    <td><a class='btn btn-primary' href='edit_product.php?id=" . $row['id'] . "'>Edit</a></td>
                    <td> <button onclick='deleteProduct(" . $row['id'] . ")'  class='btn btn-danger'>Delete</button></td>
                    </tr>
                    ";
            }
            ?>
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        const deleteProduct = (idProduct) => {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'list_products.php',
                        type: 'POST',
                        data: {
                            mode: 'delete',
                            idProduct
                        },
                        succes: function(response) {

                        }
                    })
                    Swal.fire(
                        'Deleted!',
                        'Reload the page to refresh the list',
                        'info'
                    )
                }
            })
        }
        $(document).ready(function() {
            $('#example').DataTable();

        });
    </script>
</body>

</html>