<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark dv-bg-primary">
      <div class="container">
        <div class="row w-100 d-block position-relative">
          <div class="col-lg-12">
            <img src="<?=base_url('assets/')?>img/logo_transparent_clean.png" alt="Logo" width="180" />
            <button
              class="navbar-toggler float-right dv-nav-bt"
              type="button"
              data-toggle="collapse"
              data-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav dv-navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url()?>"
                    >Home</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url('product')?>">Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Today Offer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Shipping Countt</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">My Cart</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Account Name</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url('auth')?>">Log In</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- End of navbar -->