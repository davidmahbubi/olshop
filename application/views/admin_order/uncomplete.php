<!-- Begin Page Content -->
<div class="container-fluid" data-page="uncomplete order">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Uncomplete Order</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Uncomplete Total</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($uncompleteOrder) ?> Orders</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-2x text-gray fa-boxes"></i>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Proccess by owner</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($proccessOwner) ?> Orders</div>
						</div>
						<div class="col-auto">
                        <i class="fas fa-box fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">On The Way</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($onTheWay) ?> Orders</div>
						</div>
						<div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Declined</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($declined) ?> Orders</div>
						</div>
						<div class="col-auto">
                        <i class="fas fa-times fa-2x"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-lg">
            <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Showing Uncomplete Order</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Order ID</th>
                      <th>Order Date</th>
                      <th>Transfer Receipt</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($uncompleteOrder as $i=>$uo): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><a href="<?=base_url()?>AdminOrder/details/<?=$uo['order_id']?>"><?= $uo['order_id'] ?></a></td>
                            <td><?= date('d F Y', $uo['order_date']) ?></td>
                            <td><a href="<?=base_url()?>AdminOrder/receipt/<?=$uo['order_id']?>">View</a></td>
                            <td><?= $uo['status_name'] ?></td>
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