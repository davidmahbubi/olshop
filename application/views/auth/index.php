<div class="row m-0 w-100">
	<div class="col-md-3 text-center mx-auto dv-auth-container card shadow mb-5">
		<div class="card-body mt-2">
			<img src="<?=base_url('assets/')?>img/logo_transparent_clean.png" class="dv-auth-logo" alt="Company Logo" />
			<?= $this->session->flashdata('msg'); ?>
			<div class="field-container mt-4">
				<form action="" method="POST">
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="email" class="form-control" id="email"
							placeholder="Enter email" name="email" required value="<?=set_value('email')?>" />
						<div class="alerts text-left">
							<?= form_error('email','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="password"
							placeholder="Enter Password" name="password" required />
						<div class="alerts text-left">
							<?= form_error('password','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<div class="form-group text-left mb-2">
						<input id="remember" class="mr-1" type="checkbox">
						<label for="remember">Remember me</label>
					</div>
					<button type="submit" class="btn text-white dv-bg-primary bt-dv-bg-primary w-100 mb-3">Login</button>
					<p class="mb-0">Doesn't have an account ? <a href="<?=base_url('auth/register')?>">here !</a></p>
					<a href="#">Forgot your password ?</a>
				</form>
			</div>
		</div>
	</div>
