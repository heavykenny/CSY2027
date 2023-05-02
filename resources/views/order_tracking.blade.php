<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Order Tracking</title>
</head>
<body>
<div class="container">
    <h1 class="my-5">Order Tracking</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Order #123456</h5>
            <p class="card-text">Order placed on: July 15, 2023</p>
            <p class="card-text">Status: In Transit</p>
        </div>
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <h5>Order Placed</h5>
                    <p>July 15, 2023</p>
                </div>
                <span class="badge badge-primary">Completed</span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <h5>Order Processed</h5>
                    <p>July 16, 2023</p>
                </div>
                <span class="badge badge-primary">Completed</span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <h5>Shipped</h5>
                    <p>July 17, 2023</p>
                </div>
                <span class="badge badge-primary">Completed</span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <h5>In Transit</h5>
                    <p>Estimated Delivery: July 20, 2023</p>
                </div>
                <span class="badge badge-secondary">Current</span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <h5>Delivered</h5>
                    <p>July 21, 2023</p>
                </div>
                <span class="badge badge-light">Upcoming</span>
            </div>
        </li>
    </ul>

    <div class="text-center">
        <a href="index.html" class="btn btn-primary">Go Back to Home</a>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

