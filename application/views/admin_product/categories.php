<!-- Begin Page Content -->
<div class="container-fluid" data-page="product category">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Product Categories Management</h1>
	<div class="row">
		<div class="col-lg-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">List of all categories <small>(click to edit)</small>
					</h6>
				</div>
				<div class="card-body">
					<div class="list-group">
						<?php foreach($categories as $i=>$c) : ?>
						<button data-id="<?=$c['id']?>" type="button"
							class="btCategory list-group-item list-group-item-action <?=$i == 0 ? 'active' : ''?>">
							<?= $c['name'] ?>
						</button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="card shadow mb-4">
				<a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
					aria-expanded="false" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">Add new category</h6>
				</a>
				<div class="collapse" id="collapseCardExample">
					<div class="card-body">
						<form action="" method="POST">
							<div class="form-group">
								<label for="categoryName">Category Name</label>
								<input type="text" class="form-control" id="categoryName"
									placeholder="Enter new category name">
							</div>
							<button type="button" id="btAdd" class="btn btn-primary mx-auto">Add Category</button>
						</form>
					</div>
				</div>
			</div>
			<div class="card shadow mb-4">
				<form action="" method="POST">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Edit field</h6>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="inputId">Category ID</label>
							<input disabled type="number" value="<?=$categories[0]['id']?>" class="form-control"
								id="inputId" name="id" required>
						</div>
						<div class="form-group">
							<label for="inputCategory">Category Name</label>
							<input type="text" class="form-control" value="<?=$categories[0]['name']?>"
								id="inputCategory" placeholder="Enter Category Name" required>
						</div>
						<button type="button" id="btSave" class="btn btn-primary">Save Changes</button>
						<button type="button" id="btDelete" class="btn btn-outline-danger"
							onclick="return confirm('really ?'); ">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
	$(function () {

		const btCategory = $('.btCategory');
		const btSave = $('#btSave');
		const btAdd = $('#btAdd');
		const btDelete = $('#btDelete');
		const baseUrl = '<?=base_url()?>';

		$(btCategory).click(function () {

			makeActive($(this));
			let id = $($(this)).data('id');

			$.ajax({
				url: baseUrl + 'AdminProduct/categoryajax',
				data: {
					category_id: id
				},
				method: 'post',
				dataType: 'json',
				success: function (result) {
					$('#inputId').val(result.id);
					$('#inputCategory').val(result.name);
				}
			});
		});

		$(btSave).click(function () {

			const categoryId = $('#inputId').val();
			const categoryName = $('#inputCategory').val();

			$.ajax({
				url: baseUrl + 'AdminProduct/editcategory',
				data: {
					id: categoryId,
					name: categoryName
				},
				method: 'post',
				dataType: 'json',
				success: function (result) {
					if (result.stats) {
						$.each($(btCategory), function (i, e) {
							if ($(e).data('id') == categoryId) {
								$(e).html(result.name);
							}
						});
						alert('success');
					} else {
						alert('failed to edit category details');
					}
				}
			});
		});

		$(btAdd).click(function () {
			if ($('#categoryName').val() == '') {
				alert('You are not enter any word in name field !');
			} else {

				const name = $('#categoryName').val();

				$.ajax({
					url: baseUrl + 'AdminProduct/addcategory',
					data: {
						name: name
					},
					method: 'post',
					dataType: 'json',
					success: function (result) {
						if (result.stats) {
							alert('success !');
							location.reload();
						} else {
							alert('failed !');
						}
					}
				})
			}
		});

		$(btDelete).click(function () {

			const id = $('#inputId').val();

			$.ajax({
				url: baseUrl + 'AdminProduct/deletecategory',
				data: {
					id: id
				},
				dataType: 'json',
				method: 'post',
				success: function (result) {
					if (result.stats) {
						alert('success !');
						location.reload();
					} else {
						alert('failed !');
					}
				}
			});
		})

		function makeActive(e) {
			$(btCategory).removeClass('active');
			$(e).addClass('active');
		}
	});

</script>
