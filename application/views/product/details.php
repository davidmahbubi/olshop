<div class="container main-container" data-navmenu="shop">
	<a href="#" onclick="history.go(-1)" class="btn text-white dv-bg-primary bt-dv-bg-primary mt-3 mb-3">
		< Back</a> <div class="row m-0">
			<!-- Left -->
			<div class="col-lg-4">
				<img src="<?=base_url('assets/')?>img/product/<?=$product['img']?>"
					class="img-thumbnail dv-details-prod-img mb-4">
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
								<a
									href="<?=base_url()?>product?cat=<?= $product['category_id'] ?>"><?= $product['category_name']; ?></a>
							</li>
						</ul>
					</div>
					<div class="col-lg-4">
						<form action="<?=base_url()?>product/buy/<?=$product['id']?>" method="POST">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Total : </span>
                </div>
                <input type="number" min="1" name="qty" value="1" class="form-control bt-cart" id="inputCart"
                placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
							</div>
              <?php if(isLoggedIn()) : ?>
                <button type="button" class="btn w-100 btn-outline-primary mb-2 addToCart"><i
                class="fas fa-cart-plus cart-ic" style="font-size: 30px;"></i></button>
              <?php endif; ?>
							<button type="submit" class="btn text-white w-100 dv-bg-primary bt-dv-bg-primary">Buy</button>
						</form>
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
					<?php if(!empty($review)) : ?>
					<?php foreach($review as $r) : ?>
						<div class="col-md mb-3 m-0">
							<div class="card mb-3" style="max-width: 540px; ">
								<div class="row no-gutters">
									<div class="col-md-4">
										<img src="<?=base_url()?>assets/img/profile/<?=$r['image']?>" width="200" class="card-img h-100">
									</div>
									<div class="col-md-8">
										<div class="card-body">
											<h5 class="card-title"><?= $r['first_name'] . " " . $r['last_name'] ?></h5>
											<p class="card-text"><?= $r['review'] ?>
											</p>
											<p class="card-text"><small class="text-muted">
											<?php for($i = 0; $i < $r['rating']; $i++): ?>
												<i class="fas fa-star"></i>
											<?php endfor; ?>
												</small></p>
											<small><?= date('d F Y', $r['date_posted']); ?></small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					<?php else: ?>
						<h5 class="ml-3">No review</h5>
					<?php endif; ?>
					</div>
				</div>
			</div>
</div>

<script>
	$(function () {

		// Hover function

		$('.addToCart').hover(function () {
			$('.cart-ic').css('color', 'white');
		}, function () {
			$('.cart-ic').css('color', '#00adb5');
		});

		// Add to cart

		$('.addToCart').click(function () {

			let total = $('#inputCart').val();

			$.ajax({
				url: '<?=base_url()?>cart/addtocart',
				data: {
					total: total,
					id: '<?=$product['id']?>',
					price: '<?=$product['price']?>',
					name: '<?=$product['name']?>',
					image: '<?=$product['img']?>'
				},
				method: 'post',
				dataType: 'json',
				success: function (result) {
					if (result.stats) {
						alert('<?=$product['name']?> * ' + total + ' is added to yur cart !');
					}
				}
			});
		});
	});

</script>
