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

                <!-- Inline Form-->
                <div class="col-lg-8">                           
                    <div class="block">
                    <div class="title"><strong>Update-Category</strong></div>
                    <div class="block-body">
                        <form action="{{url('update_category',$category->id)}}" method="POST"  class="form-inline">
                            @csrf
                        <div class="form-group">
                            <label for="inlineFormInput" class="sr-only">Category</label>
                            <input id="inlineFormInput" name="category" value="{{ old('category', $category->category_name) }}" type="text"  class="mr-sm-3 form-control" style="width: 400px;">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Category" class="btn btn-primary">
                        </div>
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
          @if(Session::has('toastr'))
              toastr.options = {
                  "closeButton": true,
                  "progressBar": true,
                  "timeOut": "5000"
              };
              toastr.success("{{ Session::get('toastr') }}");
          @endif
      </script>

     

  </body>
</html>