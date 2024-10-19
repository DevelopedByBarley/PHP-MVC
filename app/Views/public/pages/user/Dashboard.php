<section class="h-100 gradient-custom-2">
  <div class="container-fluid py-5 h-100">
    <div class="row d-flex justify-content-center">
      <div class="col col-lg-9 col-xl-8">
        <div class="card">
          <div class="bg-cobalt-900 rounded-top text-white d-flex flex-column">
            <div class="ms-3 mt-5 d-flex">
              <div class="blur-load">
                <img src="<?= "/public/assets/uploads/images/$user->fileName" ?? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp' ?>""
                alt=" Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2 w-15" />

              </div>
            </div>
            <div class="ms-3 mt-3">
              <h5><?= $user->name ?></h5>
              <p><?= $user->email ?></p>
            </div>
          </div>
          <div class="p-4 text-black bg-body-tertiary">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between  text-center py-1 text-body">
              <div class="text-center">
                <button type="button" class="btn btn-warning text-white" style="z-index: 1;">
                  Edit profile
                </button>
                <button type="button" class="btn btn-danger text-white" style="z-index: 1;">
                  Delete profile
                </button>
              </div>
              <div class="d-flex align-items-center justify-content-center my-3">
                <div>
                  <p class="mb-1 h5">253</p>
                  <p class="small text-muted mb-0">Photos</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5">1026</p>
                  <p class="small text-muted mb-0">Followers</p>
                </div>
                <div>
                  <p class="mb-1 h5">478</p>
                  <p class="small text-muted mb-0">Following</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-4 text-black">
            <div class="mb-5  text-body">
              <p class="lead fw-normal mb-1">About</p>
              <div class="p-4 bg-body-tertiary">
                <p class="font-italic mb-1">Web Developer</p>
                <p class="font-italic mb-1">Lives in New York</p>
                <p class="font-italic mb-0">Photographer</p>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 text-body">
              <p class="lead fw-normal mb-0">Recent photos</p>
              <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
            </div>
            <div class="row g-2">
              <div class="col mb-2 blur-load">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp" alt="image 1"
                  class="w-100 rounded-3">
              </div>
              <div class="col mb-2 blur-load">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp" alt="image 1"
                  class="w-100 rounded-3">
              </div>
            </div>
            <div class="row g-2">
              <div class="col blur-load">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp" alt="image 1"
                  class="w-100 rounded-3">
              </div>
              <div class="col blur-load">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp" alt="image 1"
                  class="w-100 rounded-3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>