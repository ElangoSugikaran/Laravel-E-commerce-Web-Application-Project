<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
    </div>

   <!-- Start Row -->
<div class="row">
  @foreach ($product as $products)
    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
      <div class="card h-100">
        <!-- Product Image -->
        <img src="{{ asset('uploads/products/' . $products->image) }}" 
          class="card-img-top img-fluid" 
          alt="Image of {{ $products->product_name }}" 
          style="width: 100%; height: 250px; object-fit: contain;">

        <!-- Card Body -->
        <div class="card-body">
          <h5 class="card-title">{{ $products->product_name }}</h5>

          <!-- Product Price -->
          <p class="card-text">
            <strong>Price:</strong> $ {{ $products->price }}
          </p>

        <!-- Flexbox for Buttons -->
          <div class="d-flex justify-content-center">
            <!-- Details Button aligned to the left -->
            <a href="{{ url('product_details', $products->id) }}" 
              class="btn btn-info w-50 mx-2 mt-3 text-center">
              View Details
            </a>

            <!-- Add to Cart Button aligned to the right -->
            <a href="{{url('add_cart',$products->id)}}" class="btn btn-primary w-50 mx-2 mt-3 text-center">
              <i class="fa fa-shopping-cart"></i>
              Add to Cart
            </a>
          </div>

        </div>
      </div>
    </div>
  @endforeach
</div> <!-- End Row -->

  </div>
</section>
