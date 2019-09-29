<div class="container main-container" data-navmenu="my-cart">
	<div class="row m-0 mt-4">
		<div class="col-lg">
			<h1>Where it will be ship ?</h1>
			<div class="card text-center mt-3">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<a class="nav-link active" href="#">Shipping</a>
						</li>
						<li class="nav-item">
							<a class="nav-link">Payment</a>
						</li>
						<li class="nav-item">
							<a class="nav-link">Status</a>
						</li>
						<li class="nav-item">
							<a class="nav-link">Review</a>
						</li>
					</ul>
				</div>
				<div class="card-body text-left">
					<div class="row">
						<div class="col-md-6">
							<form action="" method="POST">
								<div class="form-group">
									<label for="receiverName">Receiver Name</label>
									<input type="text" class="form-control" id="receiverName"
										value="<?= $curAdd ? $curAdd['name'] : $user['first_name'] .' ' . $user['last_name']?>"
										name="name" required />
									<div class="alerts">
										<?= form_error('name', '<small class="text-danger">','</small>') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="phoneNumber">Receiver Phone Number</label>
									<input type="number" class="form-control" id="phoneNumber"
										value="<?=$curAdd ? $curAdd['phoneNumber'] : ''?>" name="phone_number"
										required />
									<div class="alerts">
										<?= form_error('phone_number', '<small class="text-danger">','</small>') ?>
									</div>
								</div>
								<div class="form-group">
									<label for="clearAddress">Clear Address</label>
									<textarea class="form-control" id="clearAddress" name="address"
										rows="3"><?= $curAdd ? $curAdd['address'] : $user['address'] ? $user['address'] : ''?></textarea>
									<div class="alerts">
										<?= form_error('address', '<small class="text-danger">','</small>') ?>
									</div>
								</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postalCode">Postal code</label>
								<input type="number" class="form-control" id="postalCode" name="postal"
									value="<?= $curAdd ? $curAdd['postal'] : ''?>" required />
								<div class="alerts">
									<?= form_error('postal', '<small class="text-danger">','</small>') ?>
								</div>
								<div class="form-group mt-3">
									<label for="courierSelect">Courier</label>
									<select class="form-control" id="courierSelect" name="courier">
										<?php foreach($courier as $c) : ?>
										<option <?= $curAdd['courier'] ? $c['id'] == $curAdd['courier'] ? 'selected' : '' :'' ?> value="<?=$c['id']?>"><?= $c['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<button type="submit" class="btn text-white w-100 dv-bg-primary bt-dv-bg-primary">
									Next
								</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
