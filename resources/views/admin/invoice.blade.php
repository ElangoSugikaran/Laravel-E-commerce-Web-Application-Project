<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
         .table-bordered {
            border: 2px solid black;
        }

    </style>
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">Invoice</h1>

        <!-- Customer Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Customer Information</h4>
                <p><strong>Name:</strong> {{$data->name}}</p>
                <p><strong>Address:</strong> {{$data->rec_address}}</p>
                <p><strong>Mobile No:</strong> {{$data->mobile_no}}</p>
            </div>
            <div class="col-md-6 text-md-right">
                <h4>Invoice Details</h4>
                <p><strong>Invoice No:</strong> INV-{{ sprintf('%06d', rand(1000, 9999)) }}</p> <!-- Generates a random invoice number -->
                <p><strong>Date:</strong> {{ date('F j, Y') }}</p> <!-- Generates current date -->
            </div>
        </div>

      <!-- Product Table -->
        <table class="table table-bordered" style="width: 100%; max-width: 1200px;">
            <thead>
                <tr style="background-color: #d6d8db;"> <!-- Light grey background -->
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data->product->product_name}}</td>
                    <td>
                        <?php
                            $path = public_path('uploads/products/' . $data->product->image);
                            $imageData = base64_encode(file_get_contents($path));
                        ?>
                        <img src="data:image/jpeg;base64,{{ $imageData }}" alt="Product Image" height="120" width="120" class="img-fluid">
                    </td>
                    
                    <td>$ {{ $data->product->price}}</td>
                </tr>
                 <!-- Total Price Row -->
                 <tr style="background-color: #bed0eaf1;">
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td><strong>$ {{ $data->product->price }}</strong></td>
                </tr>
            </tbody>
        </table>

       

        <!-- Footer -->
        <div class="text-center mt-4">
            <p>Thank you for your purchase!</p>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for advanced features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
