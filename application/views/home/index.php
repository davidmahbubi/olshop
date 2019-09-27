<div class="container main-container" data-navmenu="home">
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
            <?php foreach($ratedProduct as $rp) : ?>
            <li class="list-group-item">
              <div class="rated-product row text-center">
                <div class="col-sm-4">
                  <img
                    class="img-thumbnail rated-prod-img"
                    src="<?=base_url('assets/')?>img/product/<?=$rp['img']?>"
                  />
                </div>
                <div class="col-sm-8 p-0">
                  <h5><?= $rp['name'] ?></h5>
                  <?php if($rp['rating'] >= 1) : ?>
                    <?php for($i = 0; $i < $rp['rating']; $i++) : ?>
                      <i class="fas fa-star"></i>
                    <?php endfor; ?>
                  <?php else : ?>
                      <span class="text-muted">No rating yet</span>
                  <?php endif; ?>
                  <a href="<?=base_url()?>product/details/<?=$rp['id']?>" class="d-block mt-2">Check it now !</a>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Right -->
        <div class="col-lg-8 mb-3">
          <h3 class="mt-3">New Product</h3>
          <div class="row">
          <?php foreach($product as $p) : ?>
            <div class="col-sm-6">
              <div class="card mt-3">
                <img
                  src="<?=base_url('assets/')?>img/product/<?=$p['img']?>"
                  class="card-img-top dv-card-prod-img"
                  alt="..."
                />
                <div class="card-body">
                  <h5><?= $p['name'] ?></h5>
                  <?php if($p['rating'] >= 1) : ?>
                    <?php for($i = 0; $i< $p['rating']; $i++) : ?>
                      <i class="fas fa-star"></i>
                    <?php endfor; ?>
                  <?php else: ?>
                    <span>No rating yet</span>
                  <?php endif; ?>
                  <p class="mt-2"><?= formatPrice($p['price'], 'Rp'); ?></p>
                  <a
                    href="<?=base_url()?>product/details/<?=$p['id']?>"
                    class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary"
                    >Buy Now</a
                  >
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(function() {
        $(".carousel").carousel("dispose");
      });
    </script>
