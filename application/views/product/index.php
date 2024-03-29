<div class="container main-container" data-navmenu="shop">
	<div class="row mt-4">
		<!-- Left -->
		<div class="col-lg-4">
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="mb-0">
							<button class="btn btn-link text-dark font-weight-bold" style="font-size: 20px;"
								type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
								aria-controls="collapseOne">
								Filter
							</button>
						</h2>
					</div>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne"
						data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<?php foreach($categories as $c) : ?>
								<li class="list-group-item">
									<div class="form-check">
										<input class="form-check-input check-filter" type="checkbox"
											value="<?=$c['id']?>" id="check-<?=$c['name']?>" />
										<label class="form-check-label" for="check-<?=$c['name']?>"
											style="cursor: pointer">
											<?= $c['name'] ?>
										</label>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<button class="btn btn-link text-dark font-weight-bold" style="font-size: 20px;"
								type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
								aria-controls="collapseTwo">
								Order By
							</button>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">
							<ul class="list-group">
								<li class="list-group-item">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="order"
											id="orderByPrice" value="price" data-order-type="ASC">
										<label class="form-check-label" for="orderByPrice">
											Price
										</label>
									</div>
								</li>
								<li class="list-group-item">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="order"
											id="orderByRating" value="rating" data-order-type="DESC" checked>
										<label class="form-check-label" for="orderByRating">
											Rating
										</label>
									</div>
								</li>
								<li class="list-group-item">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="order"
											id="orderByDate" value="date_created" data-order-type="DESC">
										<label class="form-check-label" for="orderByDate">
											Date
										</label>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Right -->
		<div class="col-lg-8 mb-4">
			<h3 class="mt-3">Shop Now</h3>
			<div class="input-group mb-3 mt-3">
				<input type="text" class="form-control" id="inputSearch" placeholder="Search Product" />
				<div class="input-group-append">
					<button class="btn text-white dv-bg-primary bt-dv-bg-primary" type="button" id="button-addon2">
						Search
					</button>
				</div>
			</div>
			<div class="row" id="productContainer">
				<?php foreach($product as $p) : ?>
				<div class="col-sm-6 mt-3 product-col">
					<div class="card">
						<img src="<?=base_url()?>assets/img/product/<?=$p['img']?>"
							class="card-img-top dv-card-prod-img" alt="..." />
						<div class="card-body">
							<h5><?= $p['name'] ?></h5>
							<?php if($p['rating'] >= 1) : ?>
							<?php for($i = 0; $i < $p['rating']; $i++) : ?>
							<i class="fas fa-star"></i>
							<?php endfor; ?>
							<?php else: ?>
							<span>No rating yet</span>
							<?php endif; ?>
							<p class="mt-2"><?= formatPrice($p['price']) ?></p>
							<a href="<?=base_url('product/details/' . $p['id'])?>"
								class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary">Buy Now</a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<script>

	const baseUrl = '<?=base_url()?>';
	let checkFilter = $('.check-filter');
	let filter = [];
	let order = '';
	let orderType = '';

	$(checkFilter).click(function () {

		filter = [];

		// Clearing search bar value
		
		$('#inputSearch').val('');

		// Get all checked filter

		$.each($(checkFilter), function (i, e) {
			if ($(e).prop('checked')) {
				filter.push($(e).val());
			}
		});
		
		if($(filter).length == 0){
			location.reload();
		}

		// Get all checked order

		$.each($('input[name=order]'), function(i, e){
			if($(this).prop('checked')){
				order = $(this).val();
				orderType = $(this).data('order-type');
			}
		});
		doFiltering();
	});

	$('input[name=order]').click(function(){

		filter = [];

		// Clearing search bar value
		
		$('#inputSearch').val('');

		// Get all checked filter

		$.each($(checkFilter), function (i, e) {
			if ($(e).prop('checked')) {
				filter.push($(e).val());
			}
		});
		
		if($(filter).length == 0){
			$.each($(checkFilter), function(i, e){
				filter.push($(e).val());
			});
		}

		// Get all checked order

		$.each($('input[name=order]'), function(i, e){
			if($(this).prop('checked')){
				order = $(this).val();
				orderType = $(this).data('order-type');
			}
		});
		doFiltering();
	});

	function doFiltering(){
		$.ajax({
			url: '<?=base_url()?>product/ajaxfilter',
			data: {
				data: filter,
				order: order,
				orderType: orderType
			},
			method: 'post',
			dataType: 'json',
			success: function (result) {
				$('#productContainer').html('');
				if (result.stats) {
					$.each($(result.data), function (i, e) {
						$('#productContainer').append(
							'<div class="col-sm-6 mt-3 product-col"><div class="card"><img src="' +
							baseUrl + 'assets/img/product/' + e.img +
							'" class="card-img-top dv-card-prod-img"alt="..." /><div class="card-body" id="' +
							e.id + '"><h5>' + e.name + '</h5>');
						if (e.rating >= 1) {
							for (let i = 0; i < e.rating; i++) {
								$('#' + e.id).append('<i class="fas fa-star"></i>');
							};
						} else {
							$('#' + e.id).append('<p>No rating yet</p>')
						}
						$('#' + e.id).append('<p class="mt-2">' + e.price + '</p><a href="' +
							baseUrl + 'product/details/' + e.id +
							'"class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary">Buy Now</a></div></div></div>'
						);
					});
				} else {
					location.reload();
				}
			}
		});
	}

</script>

<script>
	$('#inputSearch').keyup(function () {
		$.ajax({
			url: '<?=base_url()?>product/ajaxsearch',
			data: {
				query: $('#inputSearch').val()
			},
			method: 'post',
			dataType: 'json',
			success: function (result) {
				$('#productContainer').html('');
				if (result.stats) {
					$.each($(result.data), function (i, e) {
						$('#productContainer').append(
							'<div class="col-sm-6 mt-3 product-col"><div class="card"><img src="' +
							baseUrl + 'assets/img/product/' + e.img +
							'" class="card-img-top dv-card-prod-img"alt="..." /><div class="card-body" id="' +
							e.id + '"><h5>' + e.name + '</h5>');
						if (e.rating >= 1) {
							for (let i = 0; i < e.rating; i++) {
								$('#' + e.id).append('<i class="fas fa-star"></i>');
							};
						} else {
							$('#' + e.id).append('<p>No rating yet</p>')
						}
						$('#' + e.id).append('<p class="mt-2">' + e.price + '</p><a href="' +
							baseUrl + 'product/details/' + e.id +
							'"class="btn text-white w-100 bt-dv-bg-primary dv-bg-primary">Buy Now</a></div></div></div>'
						);
					});
				} else {
					$('#productContainer').append('<h4 class="ml-3">Product not found !</h4>');
				}
			}
		});
	});

</script>
