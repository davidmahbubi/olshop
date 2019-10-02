<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

          <div class="row">
          
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Order totals <small>In a month</small></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($monthlyOrder) ?> Orders</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-2x text-gray fa-boxes"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending orders</small></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($pendingOrder) ?> Orders</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-exclamation-circle fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Need re-stock</small></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($zeroStock) ?> Products</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-truck-loading fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Earnings<small> (For a month)</small></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 23.000.000,-</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>

          <h1 class="h3 mb-4 text-gray-800">Pending Orders</h1>
          <div class="row">
            <div class="col-lg-10">
              <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-danger">Orders That Need Action</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Order Date</th>
                      <th>Transfer Receipt</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($pendingOrder as $po) : ?>
                      <tr>
                        <td><a href="<?=base_url()?>admin_order/details/<?= urlencode($po['order_id'])?>")><?= $po['order_id']; ?></a></td>
                        <td><?= date('d F Y', $po['order_date']) ?></td>
                        <td><a href="<?=base_url()?>admin_order/view_receipt/<?=urlencode($po['order_id'])?>">View</a></td>
                        <td>
                          <a href="#" class="btn btn-sm btn-success btn-circle mb-2" title="Approve Order">
                            <i class="fas fa-check"></i>
                          </a>
                          <a href="#" class="btn btn-sm btn-danger btn-circle mb-2" title="Decline Order">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
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
