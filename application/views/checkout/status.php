<div class="container main-container" data-navmenu="my-cart">
      <div class="row m-0 mt-4">
        <div class="col-lg">
          <h1>Checkout</h1>
          <div class="card text-center mt-3 mb-4">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link">Shipping</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link">Payment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active">Status</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <ul class="list-group">
                    <?php $totalPrice = []; ?>
                    <?php foreach($orderProduct as $op) : ?>
                    <li class="list-group-item">
                      <h4><?= $op['name'] ?></h4>
                      <img
                        src="<?=base_url()?>assets/img/product/<?=$op['img']?>"
                        width="100"
                        height="75"
                        alt=""
                        class="img-thumbnail mb-2"
                      />
                      <h5>
                        <?= formatPrice($op['price'], 'Rp') ?> x <span class="total"><?=$op['total']?></span> =
                        <span class="overall"><?= formatPrice($op['sub_total'], 'Rp') ?></span>
                      </h5>
                    </li>
                    <?php $totalPrice[] = $op['sub_total'] ?>
                    <?php endforeach; ?>
                  </ul>
                  <h4 class="mt-3 text-left">
                    Overall total :
                    <span class="all-total"><?= formatPrice(array_sum($totalPrice), 'Rp'); ?></span>
                  </h4>
                </div>
                <div class="col-md-6 mb-3">
                  <h3>Your order status :</h3>
                  <h2 class="dv-bg-primary text-white pt-2 pb-2 rounded">
                    <?= $orderStatus['status_name'] ?>
                  </h2>
                  <ul class="list-group text-left mt-3">
                    <li class="list-group-item">
                      <h5>Order id : <?=$orderData['order_id']?></h5>
                    </li>
                    <li class="list-group-item">
                      <h5>Airway Bill : <?= $orderData['airway_bill'] ? $orderData['airway_bill'] : 'Waiting' ?></h5>
                    </li>
                    <li class="list-group-item">
                      <h5>Payment date : <?= date('d F Y' , $orderData['order_date']) ?></h5>
                    </li>
                    <li class="list-group-item">
                      <h5>Courier : <?=$courierData['name']?></h5>
                    </li>
                    <li class="list-group-item">
                      <h5>Arrived time : waiting</h5>
                    </li>
                  </ul>
                  <div class="text-left mt-2">
                    <i class="fas fa-info-circle d-inline mr-2"></i>
                    <p class="d-inline">
                      You can track your goods after admin inputed airway bill,
                      follow this <a href="#">link</a> to track your airway bill
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
