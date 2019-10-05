<!-- Begin Page Content -->
<div class="container-fluid" data-page="product list">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Product List</h1>
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Out of stock
							</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($outOfStock) ?> Orders</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-truck-loading fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Products Total</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"> <?=count($allProduct)?> Orders</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-2x text-gray fa-boxes"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Order Section</h6>
				</div>
				<div class="card-body">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="radio" value="price" name="order" checked>
							</div>
						</div>
						<input type="text" value="By Price" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input value="category_id" type="radio" name="order">
							</div>
						</div>
						<input type="text" value="By Category" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input value="stock" type="radio" name="order">
							</div>
						</div>
						<input type="text" value="By Stock" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input value="date_created" type="radio" name="order">
							</div>
						</div>
						<input type="text" value="By Date" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input value="rating" type="radio" name="order">
							</div>
						</div>
						<input type="text" value="Rating" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Showing All Products</h6>
				</div>
				<div class="card-body">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="inputSearch" placeholder="Find Product Name"
							autocomplete="off">
						<div class="position-absolute d-none searchSuggestShade bg-white pt-2 pb-2"
							id="searchSuggestShade"
							style="width: 100%; top: 38px; box-shadow: 0px 5px 7px rgba(0,0,0,.5);">
							<ul class="pl-2 mb-0" id="suggestUl" style="list-style-type: none;">
							</ul>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Poduct Name</th>
									<th>Price</th>
									<th>Category</th>
									<th>Stock</th>
									<th>Date Registered</th>
								</tr>
							</thead>
							<tbody class ="productTable">
								<?php foreach($allProduct as $i=>$p) : ?>
								<tr>
									<td><?= ++$i; ?></td>
									<td><a
											href="<?=base_url()?>AdminProduct/details/<?=$p['id']?>"><?= $p['name'] ?></a>
									</td>
									<td><?= formatPrice($p['price'], 'Rp'); ?></td>
									<td><?= $p['category_id'] ?></td>
									<td><?= $p['stock'] ?></td>
									<td><?= date('d F Y' ,$p['date_created']) ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>

	$(function () {

		const searchSuggest = $('#searchSuggestShade');
		const url = '<?=base_url()?>';

		$('#inputSearch').keyup(function () {

			let query = $(this).val();

			if (query == '') {
				closeShade();
			}

			$.ajax({
				url: url + 'AdminProduct/search',
				data: {
					query: query
				},
				method: 'post',
				dataType: 'json',
				success: function (result) {
					clearItem();
					if (result.length != 0) {
						$.each($(result), function (i, e) {
							$(searchSuggest).removeClass('d-none');
							$('#suggestUl').append('<li><a href="' + url +
								'AdminProduct/details/' + e.id + '">' + e.name + '</a></li>');
						});
					} else {
						$(searchSuggest).removeClass('d-none');
						$('#suggestUl').append('<li><a>ID Not found</a></li>');
					}
				}
			})
		});

		function clearItem() {
			$('#suggestUl').empty();
		};

		function closeShade() {
			$(searchSuggest).removeClass('d-none');
			$(searchSuggest).addClass('d-none');
		}
	});

</script>


<script>

    $(function(){

        const link = '<?=base_url()?>';

        $('input[type=radio]').click(function(){

            let orderBy = $(this).val();

            $.ajax({
                url: '<?=base_url()?>AdminProduct/order',
                data:{
                    order_by: orderBy
                },
                method: 'post',
                dataType: 'json',
                success: function(result){
                    $('.productTable').empty();
                    $.each(result, function(i, e){
                        $('.productTable').append('<tr><td>' + ++i + '</td><td><a href="'+ link +'AdminProduct/details/'+ e.id +'">'+ e.name +'</a></td><td>'+ e.price +'</td><td>' + e.category_id +'</td><td>'+e.stock+'</td><td>'+e.date_created+'</td></tr>');
                    });
                }
            });
        });
    });

</script>
