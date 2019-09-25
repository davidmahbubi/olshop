<div class="row m-0 mb-5">
	<div class="col-md-3 text-center mx-auto dv-auth-container card shadow">
		<div class="card-body mt-2">
			<img src="<?=base_url('assets/')?>img/logo_transparent_clean.png" class="dv-auth-logo" alt="Company Logo" />
			<div class="field-container mt-4">
				<form action="" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-group mb-3">
								<input class="dv-input-bottom w-100 pb-2" type="text" class="form-control"
									id="firstName" placeholder="Enter First Name" name="first_name" required value="<?=set_value('first_name')?>" />
								<div class="alerts text-left">
									<?= form_error('first_name','<small class="text-danger text-left">','</small>') ?>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-group mb-3">
								<input class="dv-input-bottom w-100 pb-2" type="text" class="form-control" id="lastName"
									placeholder="Enter Last Name" name="last_name" required value="<?=set_value('last_name')?>" />
								<div class="alerts text-left">
									<?= form_error('last_name','<small class="text-danger text-left">','</small>') ?>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="email" class="form-control" id="email"
							placeholder="Enter email" name="email" required value="<?=set_value('email')?>" />
						<div class="alerts text-left">
							<?= form_error('email','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="password1"
							placeholder="Enter Password" name="password1" required />
						<div class="alerts text-left">
							<?= form_error('password1','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="password2"
							placeholder="Confirm Password" name="password2" required />
						<div class="alerts text-left">
							<?= form_error('password2','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<button type="submit"
						class="btn text-white dv-bg-primary w-100 mb-3 bt-dv-bg-primary">Login</button>
					<p class="mb-0">Already have an account ? <a href="<?=base_url('auth')?>">Login</a></p>
				</form>
			</div>
		</div>
	</div>
