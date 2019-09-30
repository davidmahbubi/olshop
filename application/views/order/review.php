<div class="container main-container" data-navmenu="my-order">
	<div class="row m-0 mt-4">
		<div class="col-lg">
			<h1>Write a review</h1>
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
							<a class="nav-link">Status
								<?= $orderStatus['id'] == 6 ? '<i class="fas fa-check ml-2"></i>':'' ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link active">Review</a>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md mb-3">
							<ul class="list-group">
                                <form action="" method="POST">
                                    <?php foreach($orderProduct as $op) : ?>
                                    <li class="list-group-item product-item">
                                        <h4><?= $op['name'] ?></h4>
                                        <img src="<?=base_url()?>assets/img/product/<?=$op['img']?>" width="100" height="75"
                                            alt="" class="img-thumbnail mb-2" />
                                        <br>
                                        <div class="rating-block">
                                            <i class="fas rating fa-star"></i>
                                            <i class="fas rating fa-star"></i>
                                            <i class="fas rating fa-star"></i>
                                            <i class="fas rating fa-star"></i>
                                            <i class="fas rating fa-star"></i>
                                        </div>
                                        <input type="hidden" name="rating-<?=$op['id']?>" required>
                                        <input type="hidden" name="productId-<?=$op['id']?>" value="<?=$op['id']?>">
                                        <div class="form-group mt-1">
                                            <label for="reviewText">Review</label>
                                            <textarea class="form-control" id="reviewText" rows="3" name="review-<?=$op['id']?>"></textarea>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                    <button type="submit" value="1" name="submit_bt" class="btn dv-bg-primary text-white mt-3">Send Review</button>
                                </form>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function () {

		$('.rating').css({
			color: 'grey',
			cursor: 'pointer'
		});

		let currBlock;
		let starList;
        let starGiven;

		$.each($('.rating-block'), function (k, l) {

			$.each($(l).find('i'), function (i, e) {

				$(e).hover(function () {

					currBlock = $(this).parent();
					starList = ($(currBlock).find('i'));
                    starGiven = i + 1;

					for (let j = 0; j <= i; j++) {
						starList[j].style.color = 'blue';
					}
				}, function () {
                    let inputVal = $(e).parent().next().val();
                    $(e).parent().find('i').css('color', 'grey');
					if(inputVal != ""){
                        for(let z = 0; z < inputVal; z++){
                            starList[z].style.color = 'blue';
                        }
                    }
				});

                $(e).click(function(){
                    $(e).parent().next().val(starGiven);
                });
			});
            let input = $(l).next();
		});

	});

</script>
