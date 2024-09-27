<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <br>
      <br>
      {{-- <div class="page-header"> --}}
        <div class="container-fluid">
          <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <table class="table table-striped">
                <thead style="background-color: black;">
                  <tr>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Mobile No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Print PDF</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $datas)
                    <tr>
                      <td>{{$datas->name}}</td>
                      <td>{{$datas->rec_address}}</td>
                      <td>{{$datas->mobile_no}}</td>
                      <td>{{$datas->product->product_name}}</td>
                      <td>
                        <img src="/uploads/products/{{$datas->product->image}}" alt="Product Image" height="100" width="100"> 
                      </td>
                      <td>
                        @if($datas->payment_status == 'cash on delivery')
                            <span style="color:rgb(253, 211, 23);">{{ $datas->payment_status }}</span>
                        @elseif($datas->payment_status == 'Paid')
                            <span style="color:rgb(31, 223, 70);">{{ $datas->payment_status }}</span>
                        @else
                            <span>{{ $datas->payment_status }}</span>
                        @endif
                      </td>                          
                      <td>$ {{ number_format($datas->product->price, 2) }}</td>
                      <td>
                        @if ($datas->status == 'in progress')
                            <span style="color:red;">{{$datas->status}}</span>
                        @elseif ($datas->status == 'On the way')
                            <span style="color:skyblue;">{{$datas->status}}</span>
                        @else
                            <span style="color:yellow;">{{$datas->status}}</span>
                        @endif
                      </td>
                      <td>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('on_the_way', $datas->id) }}" class="btn btn-primary">On the Way</a>
                            <span class="mx-2"></span>
                            <a href="{{ url('delivered', $datas->id) }}" class="btn btn-success">Delivered</a>
                        </div>
                      </td>                            
                      <td>
                          <a href="{{ url('print_pdf', $datas->id) }}" class="btn btn-info">Print PDF</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="d-flex justify-content-center">
              {{ $data->links() }} <!-- Corrected to use $data -->
          </div>

        </div>
      {{-- </div> --}}
    </div>

    {{-- style="width: 100%; max-width: 1200px;" --}}

    <!-- JavaScript files-->
    <script src="{{asset('admin-css/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('admin-css/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin-css/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-css/js/charts-home.js')}}"></script>
    <script src="{{asset('admin-css/js/front.js')}}"></script>
  </body>
</html>
