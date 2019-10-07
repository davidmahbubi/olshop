<div class="container main-container mb-4" data-navmenu="user">
	<h1 class="mt-4 ml-3">Account Settings</h1>
	<div class="row m-0 mt-4">
		<div class="col-lg-4">
			<img src="<?=base_url()?>assets/img/profile/<?=$user["image"]?>" class="img-thumbnail mt-2" />
			<form action="<?=base_url()?>user/uploadimg" method="POST" enctype="multipart/form-data">
				<input type="file" style="display: none;" name="img">
				<button type="button" id="uploadBt" class="btn btn-outline-primary w-100 mt-2">
					Choose a file
				</button>
				<button type="submit" class="btn bt-dv-bg-primary text-white dv-bg-primary w-100 mt-2">
					Change Profile Picture
				</button>
			</form>
		</div>
		<div class="col-lg-8">
			<?= $this->session->flashdata('msg'); ?>
			<?= validation_errors() ? '<div class="alert alert-danger" role="alert">
		' . validation_errors() .'
		</div>':'' ?>
			<ul class="list-group mt-3">
				<li class="list-group-item">
					<i class="fas fa-fw fa-user-alt mr-2"> </i>
					<span><?= $user["first_name"] . " " .$user["last_name"] ?></span>
				</li>
				<li class="list-group-item">
					<i class="fas fa-fw fa-envelope-open-text mr-2"></i>
					<span><?= $user["email"] ?></span>
				</li>
				<li class="list-group-item">
					<i class="fas fa-fw fa-map-marker-alt mr-2"></i>
					<span><?= $user["address"] ? $user["address"]:'Address not registered !' ?></span>
				</li>
			</ul>
			<button type="button" class="btn btn-outline-primary w-100 mt-3" data-toggle="modal"
				data-target="#updatePassword">
				Update Password
			</button>
			<button type="form" class="btn dv-bg-primary text-white mt-2 float-right w-100 mb-2" data-toggle="modal"
				data-target="#editProfile">
				Edit Profile
			</button>
		</div>
	</div>
</div>

<!-- Modal Edit Profile-->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="editProfileTitle">Edit Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row mb-3">
						<div class="col">
							<label for="firstname">Firstname</label>
							<input type="text" class="form-control" id="firstname" placeholder="First name"
								value="<?=$user['first_name']?>" name="first_name" required>
						</div>
						<div class="col">
							<label for="lastname">Lastname</label>
							<input type="text" class="form-control" id="lastname" placeholder="Last name"
								name="last_name" value="<?=$user['last_name']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email">E-Mail address</label>
						<input type="email" class="form-control" id="email" placeholder="E-Mail" name="email"
							value="<?=$user['email']?>" required>
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<textarea class="form-control" id="address" name="address"
							rows="3"><?= $user['address'] ? $user['address'] : ''; ?></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn dv-bg-primary bt-dv-bg-primary text-white">
						Save changes
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Update Password -->

<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?=base_url()?>user/userupdatepassword", method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="updatePasswordTitle">Update Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="currentPassword">Current Password</label>
						<input type="password" class="form-control" id="currentPassword" placeholder="Current Password"
							name="curr-pass">
					</div>
					<div class="form-group">
						<label for="newPassword">New Password</label>
						<input type="password" class="form-control" id="newPassword" placeholder="New Password"
							name="password-1">
					</div>
					<div class="form-group">
						<label for="confirmPassword">Confirm Password</label>
						<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
							name="password-2">
					</div>
					<input type="hidden" value="<?=$user['id'];?>" name="user-id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn dv-bg-primary text-white">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(function () {

		const inputFile = $('input[type=file]');

		$('#uploadBt').click(function () {
			$(inputFile).click();

			$(inputFile).change(function () {
				let name = $(this).val().split("\\");
				name = name[name.length - 1];
				$('#uploadBt').html('<span class="mt-2">' + name + '</span>');
			});
		});
	});

</script>
