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
        {{-- <div class=""> --}}
            <div class="container-fluid">

                <!-- Inline Form-->
                <div class="col-lg-12">                           
                    <div class="block">
                    <div class="title"><strong>Add-Category</strong></div>
                    <div class="block-body">
                        <form action="{{url('add_category')}}" method="POST"  class="form-inline">
                            @csrf
                        <div class="form-group">
                            <label for="inlineFormInput" class="sr-only">Category</label>
                            <input id="inlineFormInput" name="category" type="text" placeholder="Add Category" class="mr-sm-3 form-control" style="width: 400px;">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                    </div>
                </div>

                <div class="col-lg-12">
                  <div class="block margin-bottom-sm">
                    {{-- <div class="title"><strong>Striped Table</strong></div> --}}
                    <div class="table-responsive"> 
                      <table class="table table-striped">
                        <thead style="background-color: black;">
                          <tr>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $data)
                            <tr>
                              <td>{{$data->category_name}}</td>  

                              <td>
                                <a href="{{url('edit_category',$data->id)}}"  class="btn btn-warning">Edit</a>
                              </td>

                              <td>
                                <a href="{{url('delete_category',$data->id)}}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                              </td> 

                            </tr>
                          @endforeach
                        </tbody>
                      </table>
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