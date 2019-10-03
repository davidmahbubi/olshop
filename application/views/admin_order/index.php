<!-- Begin Page Content -->
<div class="container-fluid" data-page="all order">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Order</h1>
<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Order totals</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($allOrder) ?> Orders</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-2x text-gray fa-boxes"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row">
        <div class="col-lg">
            <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Show All Order</h6>
            </div>
            <div class="card-body">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="inputSearch" placeholder="Find order id">
              <div class="position-absolute d-none searchSuggestShade bg-white pt-2 pb-2" id="searchSuggestShade" style="width: 100%; top: 38px; box-shadow: 0px 5px 7px rgba(0,0,0,.5);">
              <ul class="pl-2 mb-0" id="suggestUl" style="list-style-type: none;">
              </ul>
            </div>
            </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Receiver Name</th>
                      <th>Order Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($allOrder as $aod): ?>
                      <tr>
                        <td><a href="<?=base_url()?>AdminOrder/details/<?=$aod['order_id']?>"><?= $aod['order_id'] ?></a></td>
                        <td><?= $aod['receiver_name'] ?></td>
                        <td><?= date('d F Y', $aod['order_date']) ?></td>
                        <td><?= $aod['status_name'] ?></td>
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
    
    const searchSuggest = $('#searchSuggestShade');
    const url = '<?=base_url()?>';

    $('#inputSearch').keyup(function(){

      let query = $(this).val();

      if(query == ''){
        closeShade();
      }

      $.ajax({
        url: url + 'AdminOrder/search',
        data:{
          query: query
        },
        method: 'post',
        dataType: 'json',
        success: function(result){
          clearItem();
          if(result.length != 0 ){
            $.each($(result), function(i, e){
              $(searchSuggest).removeClass('d-none');
              $('#suggestUl').append('<li><a href="'+url+'AdminOrder/details/'+e.id+'">' + e.id +'</a></li>');
            });
          } else{
              $(searchSuggest).removeClass('d-none');
              $('#suggestUl').append('<li><a>ID Not found</a></li>');
            }
          }
        })
      });

      function clearItem(){
        $('#suggestUl').empty();
      };

      function closeShade(){
        $(searchSuggest).removeClass('d-none');
        $(searchSuggest).addClass('d-none');
      }
    });


</script>