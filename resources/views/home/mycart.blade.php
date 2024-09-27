<!DOCTYPE html>
<html>

<head>
  
    @include('home.css')

</head>

<body>
  <div class="hero_area">

    <!-- header section strats -->

    @include('home.header')
   
    <!-- end header section -->

  </div>
  <!-- end hero area -->

   <!-- Cart Section Starts -->
    <div class="container my-5">
        <h2 class="text-center mb-4">My Cart</h2>

        <div class="row">
            <!-- Cart Items (Left Column) -->
            <div class="col-md-8"> <!-- Adjusted to 8 columns for cart -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $value = 0; ?>
        
                            <!-- Loop through cart items -->
                            @foreach($cart as $cart)
                            <tr>
                                <!-- Product Image -->
                                <td>
                                    <img src="{{ asset('uploads/products/' . $cart->product->image) }}" 
                                         alt="{{ $cart->product->product_name }}" 
                                         class="img-fluid" 
                                         style="width: 100px; height: 100px; object-fit: contain;">
                                </td>
                                <!-- Product Name -->
                                <td>{{ $cart->product->product_name }}</td>
                                <!-- Price -->
                                <td>$ {{ $cart->product->price }}</td>
                                <!-- Actions (Delete) -->
                                <td>
                                    <a href="{{ url('delete_cart', $cart->id) }}" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
        
                            <?php $value += $cart->product->price; ?>
                            @endforeach
        
                            <!-- Cart Summary Row -->
                            <tr>
                                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                                <td colspan="2">$ {{ $value}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
           <!-- Checkout Summary (Right Column) -->
            <div class="col-md-4"> <!-- Adjusted to 4 columns for checkout -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Checkout Summary</h5>
                        <hr>
                        <form action="{{ url('confirm_order') }}" method="POST"> <!-- Add form tag and POST action -->
                            @csrf <!-- Add CSRF token for security -->
                            <!-- Receiver Name -->
                            <div class="form-group">
                                <label for="receiver_name">Receiver Name</label>
                                <input type="text" name="receiver_name" value="{{Auth::user()->name}}" id="receiver_name" class="form-control" placeholder="Enter receiver name" required>
                            </div>
                            
                            <!-- Receiver Address -->
                            <div class="form-group">
                                <label for="receiver_address">Receiver Address</label>
                                <textarea name="receiver_address" id="receiver_address" class="form-control" rows="3" placeholder="Enter receiver address" required>{{Auth::user()->address}}</textarea>
                            </div>
                            
                            <!-- Receiver Mobile Number -->
                            <div class="form-group">
                                <label for="receiver_mobile">Receiver Mobile Number</label>
                                <input type="text" name="receiver_mobile"  value="{{Auth::user()->mobile_no}}" id="receiver_mobile" class="form-control" placeholder="Enter mobile number" required>
                            </div>
                            
                            <!-- Place the Order Button -->
                            <button type="submit" class="btn btn-success btn-block">
                                Cash on Delivery
                            </button>

                            <a href="{{url('stripe', $value)}}" class="btn btn-primary btn-block">
                                Pay Using Card
                            </a>

                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>
        


  <!-- info section -->

  @include('home.footer')
  
</body>

</html>