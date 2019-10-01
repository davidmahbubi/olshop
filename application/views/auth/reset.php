<div class="row m-0 w-100">
	<div class="col-md-3 text-center mx-auto dv-auth-container card shadow mb-5">
		<div class="card-body mt-2">
			<img src="<?=base_url('assets/')?>img/logo_transparent_clean.png" class="dv-auth-logo" alt="Company Logo" />
			<?= $this->session->flashdata('msg'); ?>
			<div class="field-container mt-4">
				<form action="" method="POST">
                    <div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="pass-1"
							placeholder="New Password" name="pass-1" required/>
						<div class="alerts text-left">
							<?= form_error('pass-1','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
                    <div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="pass-2"
							placeholder="Confirm New Password" name="pass-2" required/>
						<div class="alerts text-left">
							<?= form_error('pass-2','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<button type="submit" class="btn text-white dv-bg-primary bt-dv-bg-primary w-100 mb-3">Change Password</button>
					<br>
				</form>
			</div>
		</div>
	</div>
