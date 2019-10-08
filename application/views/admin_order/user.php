 <!-- Begin Page Content -->
 <div class="container-fluid">

 	<!-- Page Heading -->
 	<h1 class="h3 mb-4 text-gray-800"><a href="#" onclick="history.go(-1)"> < User Details</a></h1>
 	<div class="row">
 		<div class="col-sm-4 text-center mb-4">
 			<img src="<?=base_url()?>assets/img/profile/<?=$user['image']?>" class="img-thumbnail" alt="User Image">
 		</div>
 		<div class="col-sm-8">
 			<ul class="list-group">
             <li class="list-group-item"><b>User ID : <?=$user['id']?></b></li>
 				<li class="list-group-item"><b>Name : <?=$user['first_name'] . ' ' . $user['last_name']?></b></li>
 				<li class="list-group-item">E-Mail : <?=$user['email']?></li>
 				<li class="list-group-item">Default Address : <?=$user['address'] ? $user['address'] : 'Default address is not set'?></li>
 				<li class="list-group-item">Member since : <?=date('d F Y', $user['date_created'])?></li>
 			</ul>
             <button tyoe="button" class="btn btn-primary w-100 mt-3" onclick="window.print()">Print</button>
 		</div>
 	</div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
