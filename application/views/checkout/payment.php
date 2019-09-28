<div class="container main-container" data-navmenu="my-cart">
	<div class="row m-0 mt-4">
		<div class="col-lg">
			<h1>Checkout</h1>
			<div class="card text-center mt-3 mb-4">
				<?= $this->session->flashdata('msg'); ?>
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<a class="nav-link">Shipping<i class="fas fa-check ml-2"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link active">Payment</a>
						</li>
						<li class="nav-item">
							<a class="nav-link">Status</a>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6 mb-3">
							<ul class="list-group">
								<?php foreach($cart as $c) : ?>
								<li class="list-group-item">
									<h4><a href="<?=base_url()?>product/details/<?=$c['id']?>"><?= $c['name'] ?></a>
									</h4>
									<img src="<?=base_url()?>assets/img/product/<?=$c['image']?>" width="100"
										height="75" alt="" class="img-thumbnail mb-2" />
									<h5>
										<?= formatPrice($c['price'], 'Rp'); ?><span class="total"> x
											<?=$c['qty']?></span> =
										<span class="overall"><?= formatPrice($c['subtotal'], 'Rp'); ?></span>
									</h5>
								</li>
								<?php endforeach; ?>
							</ul>
							<h4 class="mt-3 text-left">
								Overall total :
								<span class="all-total"><?= formatPrice($this->cart->total(), 'Rp') ?></span>
							</h4>
						</div>
						<div class="col-md-6 mb-3">
							<form action="" method="post" enctype="multipart/form-data">
								<h3>Please Transfer To :</h3>
								<img src="<?=base_url()?>assets/img/BCA-512.png" class="mb-2 mt-2" width="100" alt="" />
								<h1>6011631886907258</h1>
								<h4>Account name : David Mahbubi</h4>
								<p>
									Please keep transaction safe, please upload a transfer receipt to verify your order,
									wait for admin verify and your order will proceed
								</p>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="receiptImg" required />
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
								<button type="submit" class="btn text-white mt-2 dv-bg-primary bt-dv-bg-priamry w-100">
									Confirm Payment
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#customFile').change(function () {
		let fileName = $(this).val();
		if (fileName == "") {
			fileName = 'Choose a file';
		} else {
			fileName = fileName.split('\\');
			fileName = fileName[fileName.length - 1];
		}
		$('.custom-file-label').html(fileName);
	});

</script>
