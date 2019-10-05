<!-- Begin Page Content -->
<div class="container-fluid" data-page="">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><a href="" onclick="history.go(-1); return false">
			< Product Details</a> </h1> <div class="row">
				<div class="col-lg-6 mb-3">
					<ul class="list-group">
						<li class="list-group-item"><b>Product Name : <?= $product['name'] ?></b></li>
						<li class="list-group-item">Price : <?= formatPrice($product['price'], 'Rp') ?></li>
						<li class="list-group-item">Category : <?= $category[$product['category_id']]['name'] ?></li>
                        <li class="list-group-item">Stock : <?=$product['stock']?></li>
                        <li class="list-group-item">Buy Times : <?=$buyTimes?> Times</li>
						<li class="list-group-item">Weight :
							<?= $product['weight'] >= 1000  ? $product['weight']/1000 . " KG" : $product['weight'] . " grams"?>
						</li>
						<li class="list-group-item">Date Registered : <?=date('d F Y', $product['date_created'])?></li>
						<li class="list-group-item">Rating :
							<?php if($product['rating'] != 0): ?>
							<?php for($i = 0; $i < $product['rating']; $i++): ?>
							<i class="fas fa-star"></i>
							<?php endfor; ?>
							<?php else: ?>
							<span>No Rating</span>
							<?php endif; ?>
						</li>
					</ul>
				</div>
				<div class="col-lg-6">
					<img width="350" src="<?=base_url()?>assets/img/product/<?=$product['img']?>" class="img-thumbnail"
						alt="Missing Image File">
				</div>
</div>
<div class="row mt-3">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Product Description</h6>
		</div>
		<div class="card-body">
			<?= $product['description'] ?>
		</div>
	</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
