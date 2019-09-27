<div class="container main-container" data-navmenu="my-cart">
      <div class="row m-0 mt-4">
        <div class="col-lg">
          <h1>My Cart</h1>
          <table class="table mt-3">
            <thead class="thead-dark dv-bg-primary">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Price (@)</th>
                <th scope="col">Buy Total</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php foreach($cart as $c) : ?>
              <tr>
                <th scope="row"><?= $i++ ?></th>
                <td>
                  <img
                    src="<?=base_url()?>assets/img/product/<?=$c['image']?>"
                    width="70"
                    height="100"
                    class="img-thumbnail d-inline-block mr-2"
                    alt=""
                  />
                  <h5 class="d-inline"><?= $c['name'] ?></h5>
                </td>
                <td><?= formatPrice($c['price'], 'Rp') ?></td>
                <td>
                  <input
                    type="number"
                    value="<?=$c['qty']?>"
                    min="1"
                    class="form-control w-100 itemTotal"
                    id="cartInput"
                  />
                  <input type="hidden" class="rowid" value="<?=$c['rowid']?>">
                </td>
                <td><?= formatPrice($c['subtotal'], 'Rp'); ?></td>
                <td>
                  <a
                    href="<?=base_url()?>product/details/<?=$c['id']?>"
                    class="btn  dv-bg-primary bt-dv-bg-primary text-white mr-2 mt-2"
                  >
                    Details
                  </a>
                  <a onclick="return confirm('really want to delete this item from cart?');" href="<?=base_url()?>cart/removecartitem/<?=$c['rowid']?>" class="btn btn-outline-danger mr-2 mt-2">
                    Delete
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="bottom w-100 position-fixed card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h3>Pay Total : <span class="paytotal"><?= formatPrice($this->cart->total(), 'Rp') ?></span></h3>
          </div>
          <div class="col-md-4">
            <button
              type="button"
              class="btn text-white dv-bg-primary bt-dv-bg-primary
              float-right"
            >
              Checkout
            </button>
          </div>
        </div>
      </div>
    </div>

    <script>

      $(".itemTotal").keypress(function (evt) {
          evt.preventDefault();
      });
    
      $('.itemTotal').change(function(){

        let itemVal = $(this).val();
        let rowId = $(this).next().val();
        let curElement = $(this);

        if( itemVal <= 0){
          $(this).val(1);
        }

        $.ajax({
          url: '<?=base_url()?>cart/edittotal',
          data: {
            total: itemVal,
            rowid: rowId
          },
          method: 'post',
          dataType: 'json',
          success: function(result){
            if(!result.stats){
              alert('Failed to increase / decrease qty !');
            } else{
              $(curElement).parent().next().html(result.data.curItem.subtotal);
              $('.paytotal').html(result.data.totalPrice);
            }
          }
        });
      });
    
    </script>