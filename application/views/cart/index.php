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
            <?php foreach($cart as $c) : ?>
              <tr>
                <th scope="row">1</th>
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
                    class="form-control w-100"
                    id="cartInput"
                  />
                </td>
                <td><?= formatPrice($c['subtotal'], 'Rp'); ?></td>
                <td>
                  <a
                    href="#"
                    class="btn  dv-bg-primary bt-dv-bg-primary text-white mr-2 mt-2"
                  >
                    Details
                  </a>
                  <a href="#" class="btn btn-outline-danger mr-2 mt-2">
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
            <h3>Pay Total : <span class="paytotal">Rp.6.500.000,-</span></h3>
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