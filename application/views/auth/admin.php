<div class="row m-0 w-100">
	<div class="col-md-3 text-center mx-auto dv-auth-container card shadow mb-5">
		<div class="card-body mt-2">
            <h3 class="mt-3">Admin Login</h3>
			<?= $this->session->flashdata('msg'); ?>
			<div class="field-container mt-4">
				<form action="" method="POST">
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="text" class="form-control" id="email" autocomplete="off"
							placeholder="Enter Username" name="username" required value="<?=set_value('username')?>" />
						<div class="alerts text-left">
							<?= form_error('username','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<div class="form-group mb-3">
						<input class="dv-input-bottom w-100 pb-2" type="password" class="form-control" id="password"
							placeholder="Enter Password" name="password" required />
						<div class="alerts text-left">
							<?= form_error('password','<small class="text-danger text-left">','</small>') ?>
						</div>
					</div>
					<button type="submit" class="btn text-white dv-bg-primary bt-dv-bg-primary w-100 mb-3">Login</button>
				</form>
			</div>
		</div>
	</div>
