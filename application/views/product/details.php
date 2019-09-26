<div class="container">
    <a href="#" onclick="history.go(-1)" class="btn text-white dv-bg-primary bt-dv-bg-primary mt-3 mb-3">
      < Back</a> 
      <div class="row m-0">
        <!-- Left -->
        <div class="col-lg-4">
          <img src="<?=base_url('assets/')?>img/product/<?=$product['img']?>" class="img-thumbnail dv-details-prod-img mb-4">
        </div>
        <!-- Right -->
        <div class="col-lg-8">
          <h1 class="font-weight-bolder"><?= $product['name'] ?></h1>
          <h3><?= formatPrice($product['price'], 'Rp'); ?></h3>
          <div class="row mt-4">
            <div class="col-lg-8 mb-3">
              <ul class="list-group">
                <li class="list-group-item">
                    <?php if($product['rating']) : ?>
                        <?php for($i = 0; $i < $product['rating']; $i++) : ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    <?php else: ?>
                        <span>No rating yet</span>
                    <?php endif; ?>
                </li>
                <li class="list-group-item">
                  <i class="fas fa-fw fa-weight-hanging mr-2"></i>
                  <span><?=$product['weight'] >= 1000 ? convertToKg($product['weight']) : $product['weight'] . ' grams'?></span>
                </li>
                <li class="list-group-item">
                  <i class="fas fa-fw fa-calendar-day mr-2">
                  </i>
                  <span><?= date('d F Y', $product['date_created']) ?></span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-fw mr-2 fa-box"></i>
                    <span><?= $product['stock'] ?> products</span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-fw fa-tag mr-2"></i>
                    <a href="<?=base_url()?>product?cat=<?= strtolower($product['category_name']); ?>"><?= $product['category_name']; ?></a>
                </li>
              </ul>
            </div>
            <div class="col-lg-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Total : </span>
                    </div>
                    <input type="number" min="1" value="1" class="form-control bt-cart" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
              <button type="button" class="btn w-100 btn-outline-primary mb-2 addToCart"><i
                  class="fas fa-cart-plus cart-ic" style="font-size: 30px;"></i></button>
              <button type="button" class="btn text-white w-100 dv-bg-primary bt-dv-bg-primary">Buy</button>
            </div>
          </div>
        </div>
        <div class="row ml-1 mt-3">
          <div class="col-lg">
            <h1>Description</h1>
            <p><?= $product['description'] ?>
            </p>
          </div>
        </div>
        <div class="row ml-1 mr-1" id="rev-row">
          <div class="col-lg">
            <h1>Review</h1>
            <div class="row mt-3">
                <div class="col-lg-6 mb-3 m-0">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            <img src="img/profile/a.jpg" class="card-img h-100" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Carole</h5>
                              <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea commodi delectus quos cum, vero eveniet nihil nemo possimus, soluta voluptate eaque ipsa voluptates eius eligen</p>
                              <p class="card-text"><small class="text-muted">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                              </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-lg-6 mb-3 m-0">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            <img src="img/profile/b.jpg" class="card-img h-100" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Chris Jhon</h5>
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, ipsam.</p>
                              <p class="card-text"><small class="text-muted">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-lg-6 mb-3 m-0">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            <img src="img/profile/c.png" class="card-img h-100" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">John Doe</h5>
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet id omnis at? content. This content is a little bit longer.</p>
                              <p class="card-text"><small class="text-muted">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                              </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
  </div>

  <script>
      $(function(){
        $('.addToCart').hover(function(){
            $('.cart-ic').css('color', 'white');
        },function(){
            $('.cart-ic').css('color', '#00adb5');
        })
      });
  </script>