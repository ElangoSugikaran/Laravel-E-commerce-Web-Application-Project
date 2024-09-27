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
  <br>
  <br>

    <div class="col-lg-12 d-flex justify-content-center">
      <div class="table-responsive">
        <!-- Table is centered with custom width and background color -->
        <table class="table table-striped table-bordered text-center" style="width: 80%; max-width: 1200px; margin: auto;">
          <thead class="bg-dark text-white">
            <tr>
              <th>Product Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Payment Status</th>
              <th>Category</th>
              <th>Delivery Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order as  $order)
              <tr>
                <td>{{  $order->product->product_name }}</td>
                <td>
                  <img src="uploads/products/{{  $order->product->image }}" alt="Product Image" height="120" width="120" class="img-fluid rounded">
                </td>
                <td>Rs {{ number_format( $order->product->price, 2) }}</td>
                <td>
                  @if ($order->payment_status == 'Paid')
                      <span class="badge" style="background-color: rgb(109, 233, 109);">{{$order->payment_status}}</span>
                  @elseif ($order->payment_status == 'cash on delivery')
                      <span class="badge" style="background-color: rgb(255, 195, 30);">{{$order->payment_status}}</span>
                  @else
                      <span class="badge" style="background-color: gray;">{{$order->payment_status}}</span> <!-- Default case -->
                  @endif
              </td>              
                <td>{{ $order->product->category }}</td>
                <td>
                  @if ($order->status == 'in progress')
                      <span class="badge" style="background-color: rgb(243, 95, 95);">{{$order->status}}</span>
                  @elseif ($order->status == 'Delivered')
                      <span class="badge" style="background-color: rgb(103, 241, 103);">{{$order->status}}</span>
                  @elseif ($order->status == 'On the way')
                      <span class="badge" style="background-color: skyblue;">{{$order->status}}</span>
                  @else
                      <span class="badge" style="background-color: rgb(124, 124, 124);">{{$order->status}}</span>
                  @endif
              </td>
                   
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

<br>
<br>
<br>
   

  <!-- info section -->

  @include('home.footer')
  
</body>

</html>