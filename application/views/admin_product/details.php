<!-- Begin Page Content -->
<div class="container-fluid" data-page="">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><a href="" onclick="history.go(-1); return false">
			< Product Details</a> </h1> <div class="row">
				<div class="col-lg-3 mb-3 text-center">
					<img width="350" src="<?=base_url()?>assets/img/product/<?=$product['img']?>" class="img-thumbnail"
						alt="Missing Image File">
				</div>
				<div class="col-lg-9 mb-3">
				<?= $this->session->flashdata('msg') ?>
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
					<button class="btn btn-primary w-100 mt-2" data-toggle="modal"
						data-target="#editProductDetails">Edit Product Details</button>
					<a href="<?=base_url()?>AdminProduct/deleteproduct/<?=$product['id']?>" class="btn btn-danger w-100 mt-2" onclick="return confirm('Are you sure ?')">Delete Product</a>	
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
<button class="btn btn-primary btn-icon-split float-right" id="btPrint">
	<span class="icon text-white-50">
		<i class="fas fa-print"></i>
	</span>
	<span class="text">Print Product Details</span>
</button>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="editProductDetails" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalTitle">Edit Product Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="productName">Product Name</label>
						<input type="text" class="form-control" id="productName" value="<?=$product['name']?>" name="name" required>
						<div class="alerts">
							<?= form_error('name', '<div class="text-danger">','</div>') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="price">Price (Rp)</label>
						<input type="number" class="form-control" id="price" value="<?=$product['price']?>" name="price" required>
						<div class="alerts">
							<?= form_error('price', '<div class="text-danger">','</div>') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="selectCategory">Product Category</label>
						<select class="form-control" id="selectCategory" name="category_id">
							<?php foreach($category as $c): ?>
								<option value="<?=$c['id']?>" <?=$c['id'] == $product['category_id'] ? 'selected' : ''?>><?= $c['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" class="form-control" id="stock" value="<?=$product['stock']?>" name="stock" required>
						<div class="alerts">
							<?= form_error('stock', '<div class="text-danger">','</div>') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="weight">Weight (in grams)</label>
						<input type="number" class="form-control" id="weight" value="<?=$product['weight']?>" name="weight" required>
						<div class="alerts">
							<?= form_error('weight', '<div class="text-danger">','</div>') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Product Description</label>
						<textarea class="form-control" id="description" rows="3" name="description" required><?= $product['description'] ?></textarea>
						<div class="alerts">
							<?= form_error('description', '<div class="text-danger">','</div>') ?>
						</div>
					</div>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile" name="img">
						<label class="custom-file-label" for="customFile"><?= $product['img'] ?></label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(function () {

		$('#btPrint').click(function () {
			window.print();
		});

		$('input[type=file]').change(function(){
			let fileName = $(this).val().split('\\');
			fileName = fileName[fileName.length - 1];
			$('.custom-file-label').html(fileName);
		});
	});

</script>
