<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-shopping-cart"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MHB's Shop</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item -->
  <li class="nav-item">
    <a class="nav-link" href="<?=base_url('admin')?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span class="navbar-title">Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- Heading -->
  <div class="sidebar-heading">
    Order
  </div>

  <!-- Nav Item -->
  <li class="nav-item">
    <a class="nav-link" href="charts.html">
    <i class="fas fa-exclamation-circle fa-fw"></i>
      <span class="navbar-title">Pending Orders</span></a>
  </li>

  <!-- Nav Item -->
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="far fa-fw fa-clock"></i>
      <span class="navbar-title">Uncomplete Order</span></a>
  </li>

  <!-- Nav Item -->
  <li class="nav-item">
    <a class="nav-link" href="<?=base_url('AdminOrder')?>">
    <i class="fas fa-fw fa-shopping-cart"></i>
      <span class="navbar-title">All Order</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- Heading -->
  <div class="sidebar-heading">
    Product
  </div>

  <!-- Nav Item -->
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
    <i class="fas fa-plus fa-fw"></i>
      <span class="navbar-title">Add Product</span></a>
  </li>

   <!-- Nav Item -->
   <li class="nav-item">
    <a class="nav-link" href="tables.html">
    <i class="fas fa-fw text-gray fa-boxes"></i>
      <span class="navbar-title">Product List</span></a>
  </li>

   <!-- Nav Item -->
   <li class="nav-item">
    <a class="nav-link" href="tables.html">
    <i class="fas fa-list-ul fa-fw"></i>
      <span class="navbar-title">Product Category</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?=base_url()?>auth/admin_logout">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Log out</span></a>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->