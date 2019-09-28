<div class="container main-container" data-navmenu="my-order">
	<div class="row m-0 mt-4">
		<div class="col-lg">
			<h1>My Order</h1>
			<table class="table mt-3">
				<thead class="thead-dark dv-bg-primary">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Order ID</th>
						<th scope="col">Order Date</th>
						<th scope="col">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($order as $j=>$o) : ?>
					<tr>
						<th scope="row"><?= $i++ ?></th>
						<td>
							<?= $o['order_id']; ?>
						</td>
						<td><?= date('d F Y',$o['order_date']) ?></td>
						<td><?= $status[$j]['status_name'] ?></td>
						<td><a href="<?=base_url()?>checkout/status/<?=urlencode($o['order_id'])?>" class="btn btn-sm text-white dv-bg-primary">Details</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>