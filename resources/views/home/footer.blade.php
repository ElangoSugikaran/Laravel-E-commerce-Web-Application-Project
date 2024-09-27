<section class="info_section layout_padding2-top">
  <div class="social_container">
    <div class="social_box">
      <a href="#">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="#">
        <i class="fa fa-twitter" aria-hidden="true"></i>
      </a>
      <a href="#">
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
      <a href="#">
        <i class="fa fa-youtube" aria-hidden="true"></i>
      </a>
    </div>
  </div>

  <div class="info_container">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <h6>ABOUT US</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="info_form">
            <h5>Newsletter</h5>
            <form action="#">
              <input type="email" placeholder="Enter your email" aria-label="Email">
              <button type="submit">Subscribe</button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <h6>NEED HELP</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="col-md-6 col-lg-3">
          <h6>CONTACT US</h6>
          <div class="info_link-box">
            <a href="#">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>Gb road 123, London, UK</span>
            </a>
            <a href="tel:+0112345678901">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>+01 12345678901</span>
            </a>
            <a href="mailto:demo@gmail.com">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>demo@gmail.com</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved by
        <a href="https://html.design/">Web Tech Knowledge</a>
      </p>
    </div>
  </footer>
  <!-- End footer section -->
</section>

<!-- Scripts -->
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Toastr notification -->
<script>
  @if(session('toastr'))
    toastr["{{ session('toastr')['type'] }}"](
      "{{ session('toastr')['message'] }}", 
      "{{ session('toastr')['title'] }}", 
      {
        progressBar: true,
        closeButton: true,
        timeOut: 5000,
        positionClass: "toast-top-right"
      }
    );
  @endif

  // Display current year in footer
  document.getElementById("displayYear").textContent = new Date().getFullYear();
</script>
