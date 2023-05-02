<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Order Details</title>
</head>
<body>
<div class="container">
    <h1 class="my-5">Order Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Order #123456</h5>
            <p class="card-text">Order placed on: July 15, 2023</p>
            <p class="card-text">Status: Shipped</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Shipping Information</h5>
            <p class="card-text">John Doe</p>
            <p class="card-text">123 Main St</p>
            <p class="card-text">City, State, ZIP</p>
            <p class="card-text">Email: johndoe@example.com</p>
            <p class="card-text">Phone: 123-456-7890</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Payment Information</h5>
            <p class="card-text">Payment method: Credit Card</p>
            <p class="card-text">Card Number: **** **** **** 1234</p>
            <p class="card-text">Expiry Date: 06/25</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order Items</h5>
            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>$20.00</td>
                    <td>2</td>
                    <td>$40.00</td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>$10.00</td>
                    <td>1</td>
                    <td>$10.00</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>$50.00</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
