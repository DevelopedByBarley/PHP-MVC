<?php
$csrf = $params['csrf'];
?>

<section class="vh-100 gradient-custom sc-bg">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form action="/admin/login" method="POST">
              <?= $csrf->generate() ?>

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">ADMIN</h2>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input class="form-control py-2" id="inputEmailAddress" type="text" placeholder="Enter email address" name="name">
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input class="form-control py-2" id="inputPassword" type="password" placeholder="Enter password" name="password" >
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>