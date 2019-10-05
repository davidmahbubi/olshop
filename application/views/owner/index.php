<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="text-center mt-5">
        <?= $this->session->flashdata('msg'); ?>
		<img width="200" src="<?=base_url()?>assets/img/profile/<?=$owner['image']?>" alt="error"
			class="img-thumbnail mx-auto">
		<h1 class="mt-3"><?= $owner['name'] ?></h1>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">Edit
			Profile</button>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    <div class="form-group">
                        <label for="ownerName">Name</label>
                        <input type="text" class="form-control" id="ownerName" name="name" value="<?=$owner['name']?>" required>
                        <div class="alerts">
                            <?= form_error('name','<small class="text-danger">','</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ownerUsername">Username</label>
                        <input type="text" class="form-control" id="ownerUsername" name="username" value="<?=$owner['username']?>" required>
                        <div class="alerts">
                            <?= form_error('username','<small class="text-danger">','</small>') ?>
                        </div>
                    </div>
                    <label for="">Profile Photo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profilePhoto" name="img">
                        <label class="custom-file-label" for="profilePhoto">Profile Photo</label>
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

$(function(){
    $('input[type=file]').change(function(){
		let fileName = $(this).val().split('\\');
		fileName = fileName[fileName.length - 1];
		$('.custom-file-label').html(fileName);
	});
});

</script>
