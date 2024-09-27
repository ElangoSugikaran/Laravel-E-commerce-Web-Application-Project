<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    .img-box {
      overflow: hidden; /* Ensures the image doesn’t overflow its container */
      border-radius: 8px; /* Optional: rounds the corners of the image */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Optional: adds a subtle shadow */
      transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for scaling and shadow */
    }

    .animated-image {
      transition: transform 0.3s ease; /* Smooth transition for scaling */
    }

    .img-box:hover .animated-image {
      transform: scale(1.1); /* Scale the image up on hover */
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4); /* Increase shadow on hover for effect */
    }

  </style>

</head>
<body>

<section class="slider_section">
  <div class="slider_container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box"> 
                  <h1>
                    Welcome To SK Store <br>
                    Your One-Stop Online Shop
                  </h1>
                    <p>
                      Discover a wide range of mobile phones, headphones, earbuds, and button phones. Quality products at unbeatable prices, tailored to meet your needs.
                    </p>
                  <a href="">
                    Contact Us
                  </a>
                </div>
              </div>
              <div class="col-md-5">
                <div class="img-box">
                  <img class="animated-image" style="width:600px" src="images/online-shoppingr.jpg" alt="Online Shopping" />
                </div>
              </div>                
            </div>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</section>
  
</body>
</html>