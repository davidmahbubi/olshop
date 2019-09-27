<div class="container main-container" data-navmenu="user">
      <h1 class="mt-4 ml-3">Account Settings</h1>
      <div class="row m-0 mt-4">
        <div class="col-lg-4">
          <img src="<?=base_url()?>assets/img/profile/<?=$user["image"]?>" class="img-thumbnail mt-2" />
          <button
            type="button"
            class="btn bt-dv-bg-primary text-white dv-bg-primary w-100 mt-2"
          >
            Change Profile Picture
          </button>
        </div>
        <div class="col-lg-8">
          <ul class="list-group mt-3">
            <li class="list-group-item">
              <i class="fas fa-fw fa-user-alt mr-2"> </i>
              <span><?= $user["first_name"] . " " .$user["last_name"] ?></span>
            </li>
            <li class="list-group-item">
              <i class="fas fa-fw fa-envelope-open-text mr-2"></i>
              <span><?= $user["email"] ?></span>
            </li>
            <li class="list-group-item">
              <i class="fas fa-fw fa-map-marker-alt mr-2"></i>
              <span
                ><?= $user["address"] ? $user["address"]:'Address not registered !' ?></span
              >
            </li>
          </ul>
          <button
            class="btn dv-bg-primary text-white mt-2 float-right w-100 mb-2"
            data-toggle="modal"
            data-target="#exampleModal"
          >
            Edit Profile
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn dv-bg-primary bt-dv-bg-primary text-white"
            >
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>