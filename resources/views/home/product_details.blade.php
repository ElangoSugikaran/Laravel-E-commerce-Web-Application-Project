<!DOCTYPE html>
<html>

<head>
  
    @include('home.css')

</head>

<body>
  <div class="hero_area">

    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    <section class="product_details_section layout_padding">
        <div class="container">
          <!-- Product Details Row -->
          <div class="row">
            
            <!-- Product Image Section -->
            <div class="col-md-6">
                <div class="card">
                  <div class="img-box">
                    <img src="{{ asset('uploads/products/' . $data->image) }}" 
                         class="card-img-top img-fluid" 
                         alt="Image of {{ $data->product_name }}" 
                         style="max-width: 100%; height: 500px; object-fit: contain; border: 1px solid #ddd; padding: 10px;">
                  </div>
                </div>
              </div>              
      
            <!-- Product Details Section -->
            <div class="col-md-6">
              <h3>{{ $data->product_name }}</h3>
              
              <!-- Product Price -->
              <h4 class="mt-3">Price: <span class="text-success">$ {{ $data->price }}</span></h4>
              
              <!-- Product Description -->
              <p class="mt-3">
                <strong>Description: </strong>{{ $data->description }}
              </p>
      
              <!-- Available Quantity -->
              <p>
                <strong>Available Quantity: </strong>{{ $data->quantity }}
              </p>
      
              <!-- Add to Cart Link -->
              <a href="{{ url('add_cart', $data->id) }}" class="btn btn-primary w-50 mx-2 mt-3 text-center">
                  <i class="fa fa-shopping-cart"></i> Add to Cart
              </a>
            </div>
          </div> <!-- End Row -->

          <!-- Related Products Section -->
          <div class="related-products mt-5">
            <h3>Related Products</h3>
            <br>
            <div class="row">
              @foreach ($relatedProducts as $relatedProduct)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                  <div class="card">
                    <img src="{{ asset('uploads/products/' . $relatedProduct->image) }}" 
                         alt="{{ $relatedProduct->product_name }}" 
                         class="card-img-top img-fluid" style="height: 200px; object-fit: contain;">
                    <div class="card-body">
                      <h5 class="card-title">{{ $relatedProduct->product_name }}</h5>
                      <p class="card-text">Rs {{ $relatedProduct->price }}</p>
                      <a href="{{ url('product_details', $relatedProduct->id) }}" class="btn btn-info">View Details</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      
        </div>
      </section>


  <!-- info section -->
  @include('home.footer')
  
</body>

</html>
