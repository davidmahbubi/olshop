<div class="row m-0 w-100">
	<div class="col-md-3 text-center mx-auto dv-auth-container card shadow mb-5">
		<div class="card-body mt-2">
			<img src="<?=base_url('assets/')?>img/logo_transparent_clean.png" class="dv-auth-logo" alt="Company Logo" />
			<?= $this->session->flashdata('msg'); ?>
			<div class="field-container mt-4">
            <p>We'll send the verification link to your E-Mail</p>
				<form action="" method="POST">
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="email" class="form-control" id="email"
							placeholder="Enter email" name="email" required value="<?=set_value('email')?>" />
						<div class="alerts text-left">
							<?= form_error('email','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<button type="submit" class="btn text-white dv-bg-primary bt-dv-bg-primary w-100 mb-3">Next</button>
					<br>
					<a href="<?= base_url('auth') ?>">Log in</a>
				</form>
			</div>
		</div>
	</div>
