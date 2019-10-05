<!-- Begin Page Content -->
<div class="container-fluid" data-page="add product">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Add Product</h1>

	<?= $this->session->flashdata('msg'); ?>
	<div class="row">
		<div class="col-lg-9">
			<!-- Basic Card Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Fill with product identity</h6>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="productName">Product Name</label>
							<input type="text" class="form-control" id="productName" value="" name="name" required
								placeholder="Clear Product Name">
							<div class="alerts">
								<?= form_error('name', '<div class="text-danger">','</div>') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="price">Price (Rp)</label>
							<input type="number" class="form-control" id="price" value="" name="price" required
								placeholder="Price In Rupiah">
							<div class="alerts">
								<?= form_error('price', '<div class="text-danger">','</div>') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="selectCategory">Product Category</label>
							<select class="form-control mb-2" id="selectCategory" name="category_id">
								<?php foreach($category as $c): ?>
								<option value="<?=$c['id']?>"><?= $c['name'] ?></option>
								<?php endforeach; ?>
							</select>
							<a href="<?=base_url()?>AdminProduct/productcategory">Manage Category</a>
						</div>
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" class="form-control" id="stock" value="" name="stock" required
								placeholder="Avalibility of This Product">
							<div class="alerts">
								<?= form_error('stock', '<div class="text-danger">','</div>') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="weight">Weight (in grams)</label>
							<input type="number" class="form-control" id="weight" value="" name="weight" required
								placeholder="Weight in Grams">
							<div class="alerts">
								<?= form_error('weight', '<div class="text-danger">','</div>') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="description">Product Description</label>
							<textarea class="form-control" id="description" rows="3" name="description"
								required></textarea>
							<div class="alerts">
								<?= form_error('description', '<div class="text-danger">','</div>') ?>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="img" required>
							<label class="custom-file-label" for="customFile">Choose Product Image</label>
						</div>
						<button type="submit" class="btn btn-primary float-right mt-3 ml-2">Submit</button>
						<button type="button" id="clearBt" class="btn btn-outline-primary float-right mt-3 ml-2">Clear</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
	$(function () {

		$('#clearBt').click(function(){
			$('input').val('');
			$('textarea').val('');
		});

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
