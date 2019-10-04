<!-- Begin Page Content -->
<div class="container-fluid" data-page="pending orders">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Pending Orders</h1>
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
								<input type="radio" value="order_date" name="order" checked>
							</div>
						</div>
						<input type="text" value="By Date" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input value="courier_id" type="radio" name="order">
							</div>
						</div>
						<input type="text" value="By Courier" disabled class="form-control"
							aria-label="Text input with radio button">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9">
            <?= $this->session->flashdata('msg'); ?>
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-danger">Showing All Pending Orders</h6>
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
                                    <th>Courier</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="pendingOrderTableBody">
                                <?php foreach($pendingOrder as $index=>$po): ?>
                                    <tr>
                                        <td><?= ++$index ?></td>
                                        <td><a href="<?=base_url()?>AdminOrder/details/<?=$po['order_id']?>"><?= $po['order_id'] ?></a></td>
                                        <td><?= date('d F Y', $po['order_date']) ?></td>
                                        <td><a href="<?=base_url()?>AdminOrder/receipt/<?=$po['order_id']?>">View</a></td>
                                        <td><?= $po['name'] ?></td>
                                        <td>
                                            <a href="<?=base_url()?>AdminOrder/approve_order/<?=$po['order_id']?>?>"
                                                onclick="return confirm('Approve Order ? ');"
                                                class="btn btn-sm btn-success btn-circle mb-2" title="Approve Order">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="<?=base_url()?>AdminOrder/decline_order/<?=$po['order_id']?>"
                                                class="btn btn-sm btn-danger btn-circle mb-2"
                                                onclick="return confirm('Decline Order ? ');" title="Decline Order">
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

<script>

    $(function(){

        const link = '<?=base_url()?>';

        $('input[type=radio]').click(function(){
            let orderBy = $(this).val();

            $.ajax({
                url: '<?=base_url()?>AdminOrder/orderbyajax',
                data:{
                    order_by: orderBy
                },
                method: 'post',
                dataType: 'json',
                success: function(result){
                    console.log(result);
                    $('.pendingOrderTableBody').empty();
                    $.each(result, function(i, e){
                        $('.pendingOrderTableBody').append('<tr><td>' + ++i + '</td><td><a href="'+ link +'AdminOrder/details/'+ e.order_id +'">'+ e.order_id +'</a></td><td>'+ e.order_date +'</td><td><a href="'+link+'AdminOrder/receipt/'+e.order_id+'">View</a></td><td>'+e.name+'</td><td><a href="'+link+'AdminOrder/approve_order/'+e.order_id+'"class="btn btn-sm mr-1 btn-success btn-circle mb-2" onclick="return confirm("Approve Order ? ");" title="Approve Order"><i class="fas fa-check"></i></a><a href="'+link+'AdminOrder/decline_order/'+e.order_id+'"class="btn btn-sm btn-danger btn-circle mb-2"onclick="return confirm("Decline Order ? ");" title="Decline Order"><i class="fas fa-trash"></i></a></td></tr>');
                    });
                }
            });
        });
    });

</script>
