<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/style.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
    />

    <title>MHB's Shop</title>
  </head>
  <body>

    <div class="container">
      <!-- Carousel -->
      <div
        id="carouselExampleIndicators"
        class="carousel slide mt-4"
        data-ride="carousel"
      >
        <ol class="carousel-indicators">
          <li
            data-target="#carouselExampleIndicators"
            data-slide-to="0"
            class="active"
          ></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?=base_url('assets/')?>img/splash1.jpg" class="d-block w-100 c-item" />
          </div>
          <div class="carousel-item">
            <img src="<?=base_url('assets/')?>img/splash2.jpg" class="d-block w-100 c-item" />
          </div>
          <div class="carousel-item">
            <img src="<?=base_url('assets/')?>img/splash3.jpg" class="d-block w-100 c-item" />
          </div>
          <div class="carousel-item">
            <img src="<?=base_url('assets/')?>img/splash4.jpg" class="d-block w-100 c-item" />
          </div>
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleIndicators"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="false"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <!-- End Carousel -->
      <div class="row mt-4">
        <!-- Left -->
        <div class="col-lg-4">
          <ul class="list-group">
            <li class="list-group-item"><h3 class="mt-2">Top Rated</h3></li>
            <li class="list-group-item">
              <div class="rated-product row text-center">
                <div class="col-sm-4">
                  <img
                    class="img-thumbnail rated-prod-img"
                    src="<?=base_url('assets/')?>img/product/mbp15touch-silver-select-cto-201807_3_1.jpeg"
                  />
                </div>
                <div class="col-sm-8 p-0">
                  <h5>MacBook pro 2019</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <a href="#" class="d-block mt-2">Check it now !</a>
                </div>
              </div>
            </li>
            <li class="list-group-item dv-item-group">
              <div class="rated-product row text-center">
                <div class="col-sm-4">
                  <img
                    class="img-thumbnail rated-prod-img"
                    src="<?=base_url('assets/')?>img/product/apple_iphone_x__3_result_price_1.jpg"
                  />
                </div>
                <div class="col-sm-8 p-0">
                  <h5>iPhone X 128GB</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <a href="#" class="d-block mt-2">Check it now !</a>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="rated-product row text-center">
                <div class="col-sm-4">
                  <img
                    class="img-thumbnail rated-prod-img"
                    src="<?=base_url('assets/')?>img/product/core-i9.jpg"
                  />
                </div>
                <div class="col-sm-8 p-0">
                  <h5>Core i9-9900K</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <a href="#" class="d-block mt-2">Check it now !</a>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="rated-product row text-center">
                <div class="col-sm-4">
                  <img
                    class="img-thumbnail rated-prod-img"
                    src="<?=base_url('assets/')?>img/product/350667-toshiba-portege-z30-a1301.jpg"
                  />
                </div>
                <div class="col-sm-8 p-0">
                  <h5>Toshiba Portege</h5>
                  <i class="fas fa-star"></i>
                  <a href="#" class="d-block mt-2">Check it now !</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <!-- Right -->
        <div class="col-lg-8">
          <h3 class="mt-3">New Product</h3>
          <div class="row">
            <div class="col-sm-6">
              <div class="card mt-3">
                <img
                  src="<?=base_url('assets/')?>img/product/apple_iphone_x__3_result_price_1.jpg"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5>iPhone X 128GB</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <p class="mt-2">Rp. 200.000,-</p>
                  <a
                    href="#"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mt-3">
              <div class="card">
                <img
                  src="<?=base_url('assets/')?>img/product/350667-toshiba-portege-z30-a1301.jpg"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5>Toshiba Portege</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <p class="mt-2">Rp. 2.000.000,-</p>
                  <a
                    href="#"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mt-3">
              <div class="card">
                <img
                  src="<?=base_url('assets/')?>img/product/core-i9.jpg"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5>Core i9-9900K</h5>
                  <i class="fas fa-star"></i>
                  <p class="mt-2">Rp. 9.000.000,-</p>
                  <a
                    href="#"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mt-3">
              <div class="card">
                <img
                  src="<?=base_url('assets/')?>img/product/mbp15touch-silver-select-cto-201807_3_1.jpeg"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5>MacBook pro 2019</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <p class="mt-2">Rp. 20.000.000,-</p>
                  <a
                    href="#"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
            <div class="col-sm-6 mt-3">
              <div class="card">
                <img
                  src="<?=base_url('assets/')?>img/product/350667-toshiba-portege-z30-a1301.jpg"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5>Toshiba Portege</h5>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <p class="mt-2">Rp. 2.000.000,-</p>
                  <a
                    href="#"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=base_url('assets/')?>js/jquery-3.4.1.min.js"></script>
    <script src="<?=base_url('assets/')?>js/popper.min.js"></script>
    <script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
    <script>
      $(function() {
        $(".carousel").carousel("dispose");
      });
    </script>
  </body>
</html>
