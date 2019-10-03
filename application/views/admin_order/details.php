<!-- Begin Page Content -->
<div class="container-fluid" data-page="all order">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><a href="#" onclick="history.go(-1)">< Ordered Details</a></h1>
    <div class="card mb-4 py-0 border-left-primary">
        <div class="card-body">
           <ul>
               <li> Order ID : <?=$order['order_id']?></li>
               <li> Receiver Name : <?=$order['receiver_name']?></li>
               <li> Phone Number : <?=$order['phone_number']?></li>
               <li> Complete Address : <?=$order['complete_address']?></li>
               <li> Postal Code : <?=$order['postal']?></li>
               <li> Transfer Receipt Image : <a href="<?=base_url()?>AdminOrder/view_receipt/<?=$order['transfer_proof_img']?>">View</a></li>
               <li> Order Account : <a href="#"><?= $account['first_name' ]. " " . $account['last_name'] ?></a></li>
               <li> Courier : <?=$order['name']?></li>
               <li> Airway Bill : <?=$order['airway_bill']?></li>
               <li> Status : <?=$order['status_name']?></li>
           </ul>
           <button class="btn btn-primary float-right mr-2" type="button">Input Airway Bill</button>
           <button class="btn btn-outline-primary float-right mr-2">Update Status</button>
        </div>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ordered Products</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Price @</th>
                      <th>Buy Total</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $arrayBuff = []; ?>
                      <?php foreach($ordered_product as $op) : ?>
                        <tr>
                            <td><?= $op['name'] ?></td>
                            <td><?= formatPrice($op['price'], 'Rp') ?></td>
                            <td><?= $op['total'] ?></td>
                            <td><?= formatPrice($op['sub_total'], 'Rp') ?></td>
                        </tr>
                        <?php $arrayBuff[] = $op['sub_total']; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>Pay Total</b></td>
                            <td></td>
                            <td></td>
                            <td><b><?= formatPrice(array_sum($arrayBuff), 'Rp'); ?></b></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->