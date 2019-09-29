<div class="container main-container" data-navmenu="my-order">
      <div class="row m-0 mt-4">
        <div class="col-lg">
          <h1>Checkout</h1>
          <?= $this->session->flashdata('msg'); ?>
          <div class="card text-center mt-3 mb-4">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link">Shipping<i class="fas fa-check ml-2"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link">Payment <i class="fas fa-check ml-2"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active">Status <?= $orderStatus['id'] == 6 ? '<i class="fas fa-check ml-2"></i>':'' ?></a>
                </li>
                <li class="nav-item">
							<a class="nav-link">Review</a>
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
                  <?php if($orderStatus['id'] == 6) : ?>
                    <a href="<?=base_url()?>order/review/<?=$orderData['order_id'];?>">Write a review</a>
                  <?php endif; ?>
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
                    <li class="list-group-item">
                      <h5>Transfer receipt : </h5>
                      <img class="img-thumbnail mt-2" src="<?=base_url()?>assets/img/receipt/<?=$orderData['transfer_proof_img']?>" height="150">
                      <?php if($orderStatus['id'] == 1) : ?>
                        <button class="btn dv-bg-primary text-white mt-2 w-100" data-toggle="modal" data-target="#modalUpdateReceipt">Update receive image</button>
                      <?php endif; ?>
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

    <?php if($orderStatus['id'] == 1) : ?>
        <!-- Modal -->
    <div class="modal fade" id="modalUpdateReceipt" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form action="<?=base_url()?>checkout/updatereceipt" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Update Receipt Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="receiptUpateImg" name="receiptImg" required>
            <input type="hidden" value="<?=$orderData['order_id']?>" name="order_id">
            <label class="custom-file-label" for="receiptUpateImg">Choose file</label>
          </div>
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
    
    $(function(){
      $('#receiptUpateImg').change(function(){
        let fileName = $(this).val().split('\\');
        fileName = fileName[fileName.length - 1];
        console.log(fileName);
        $('.custom-file-label').html(fileName);
      });
    });
    
    </script>
<?php endif; ?>
