<!-- Begin Page Content -->
<div class="container-fluid" data-page="all order">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><a href="#" onclick="history.go(-1)">< Ordered Details</a></h1>
<?= $this->session->flashdata('msg'); ?>
    <div class="card mb-4 py-0 border-left-primary">
        <div class="card-body">
           <ul>
               <li> Order ID : <?=$order['order_id']?></li>
               <li> Receiver Name : <?=$order['receiver_name']?></li>
               <li> Phone Number : <?=$order['phone_number']?></li>
               <li> Complete Address : <?=$order['complete_address']?></li>
               <li> Postal Code : <?=$order['postal']?></li>
               <li> Order Date : <?=date('d F Y H:i:s', $order['order_date'])?></li>
               <li> Transfer Receipt Image : <a href="<?=base_url()?>AdminOrder/receipt/<?=$order['order_id']?>">View</a></li>
               <li> Order Account : <a href="#"><?= $account['first_name' ]. " " . $account['last_name'] ?></a></li>
               <li> Courier : <?=$order['name']?></li>
               <li> Airway Bill : <?=$order['airway_bill']?></li>
               <li> Status : <?=$order['status_name']?></li>
           </ul>
           <button class="btn btn-primary float-right mr-2" type="button" data-toggle="modal" data-target="#updateStatus">Update Status</button>
           <button <?= $order['airway_bill'] ? '':'disabled' ?> class="btn btn-outline-primary float-right mr-2" data-toggle="modal" data-target="#editAirway">Edit Airway Bill</button>
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

<!-- Modal -->
<div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditStatusTitle">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="orderStatusSelect">Order Status</label>
            <select class="form-control" id="orderStatusSelect" name="orderStatus">
              <?php foreach($order_status as $od) : ?>
                <option <?=$order['order_status'] == $od['id'] ? 'selected' : ''?> value="<?=$od['id']?>"><?= $od['status_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updateStatus" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if($order['airway_bill']): ?>

  <!-- Modal -->
  <div class="modal fade" id="editAirway" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAirwayEditTitle">Edit Airway Bill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="inputAirway">Airway Bill</label>
            <input type="number" class="form-control" name="airwayBill" id="inputAirway" value="<?=$order['airway_bill']?>">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="updateAirwayBill" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php endif; ?>

<script>
$(function(){
  $('#orderStatusSelect').change(function(){
    if($(this).val() == 3){
      $(this).parent().append('<div class="form-group airwayInput mt-2"><label for="airwayBill">Enter an airway bill</label><input name="airwayBill" type="number" class="form-control" id="airwayBill" required></div>');
    } else{
      $('.airwayInput').remove();
    }
  });
});
</script>