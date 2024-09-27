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
        {{-- <div class="page-header"> --}}
            <br>
            <br>
            <div class="container-fluid">

                <!-- Inline Form-->
                <div class="col-lg-12">                           
                    <div class="block">
                    <div class="title"><strong>Add-Product</strong></div>
                    <div class="block-body">
                        <form action="{{url('insert_product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label for="productname">Product Name</label>
                                <input type="text" class="form-control" id="productname" name="productname">
                            </div>
                            <div class="form-group">
                                <label for="productdescription">Product Description</label>
                                <textarea class="form-control" id="productdescription" name="productdescription" rows="4"></textarea>
                            </div>
                            
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="imageUpload">Upload Image</label>
                                        <input type="file" class="form-control" id="imageUpload" name="imageUpload">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>

                                            <option>Select a Category</option>

                                            @foreach ($data as $data)

                                            <option value="{{$data->category_name}}">{{$data->category_name}}</option>
                                                
                                            @endforeach
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>                                                            
                            
                            <button type="submit" class="btn btn-primary">Add Product</button>

                        </form>
                    </div>
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

    
  </body>
</html>