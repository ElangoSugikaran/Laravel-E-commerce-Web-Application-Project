<!DOCTYPE html>
<html>
  <head> 

    @include('admin.css')
    {{-- in above admin.css as include the toastr css link --}}

  </head>
  <body>
    
    @include('admin.header')

      <!-- Sidebar Navigation-->

      @include('admin.sidebar')

      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <br>
        <br>
        {{-- <div class="page-header"> --}}
            <div class="container-fluid">

              <div class="col-md-6 ml-3">
                <form class="d-flex" action="{{url('search_product')}}" method="GET">
                    <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-primary" type="submit" value="search">Search</button>
                </form>
             </div>

             <br>
             <br>

                <div class="col-lg-12">
                    <div class="block margin-bottom-sm">
                      <div class="table-responsive"> 
                        <table class="table table-striped">
                          <thead style="background-color: black;">
                            <tr>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Image</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Category</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($product as $products)
                              <tr>
                                <td>{{ $products->product_name }}</td>
                                <td class="table-description">{{ Str::limit($products->description, 50) }}</td>
                                <td>
                                  <img src="uploads/products/{{ $products->image }}" alt="Product Image" height="120" width="120"> 
                                </td>
                                <td>${{ $products->price }}</td>
                                <td>{{ $products->quantity }}</td>
                                <td>{{ $products->category }}</td>
                                <td>
                                  <a href="{{url('edit_product',$products->id)}}" class="btn btn-warning">Edit</a>
                              </td>
                                <td>
                                  <a href="{{url('delete_product',$products->id)}}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                              </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                  <div class="d-flex justify-content-center">
                        {{$product->links()}}
                      </div>

                </div>

            </div>
      {{-- </div> --}}
    </div>
    

    <!-- JavaScript files-->
    <script src="{{asset('admin-css/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admin-css/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admin-css/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-css/js/charts-home.js')}}"></script>
    <script src="{{asset('admin-css/js/front.js')}}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Toastr notification -->
        <script>
          @if(session('toastr'))
              var type = "{{ session('toastr')['type'] }}";
              var message = "{{ session('toastr')['message'] }}";
              var title = "{{ session('toastr')['title'] }}";
      
              toastr[type](message, title, {
                  iconClass: type === 'success' ? 'toast-success' : 'toast-error',
                  progressBar: true,
                  closeButton: true,
                  timeOut: 5000,
                  positionClass: "toast-top-right"
              });
          @endif
      </script>

     <!--SweetAlert for delete function-->
     <script type="text/javascript">

      function confirmation(ev) { 
                  ev.preventDefault(); 
                  var urlToRedirect = ev.currentTarget.getAttribute('href'); 
                  console.log(urlToRedirect);  
                  swal({ 
                      title: "Are you sure to Delete this?", 
                      text: "This delete will be permanent!", 
                      icon: "warning",
                      buttons: true, 
                      dangerMode: true, 
                  })
                  .then((willCancel) => { 
                      if (willCancel) { 
                          window.location.href = urlToRedirect; 
                      }
                  });
              }

  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
</html>