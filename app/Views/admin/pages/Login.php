<section class="vh-100 gradient-custom pr-font">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card  border-0 shadow dark-bg-gray-900 " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form action="/admin/login" method="POST" class="text-start">
              <?= $csrf->generate() ?>

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">ADMIN</h2>
                <p class="mb-3">Please enter your login and password!</p>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="typeEmailX">Username</label>
                  <input class="form-control py-2" id="inputEmailAddress" type="text" placeholder="Enter username" name="name">
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input class="form-control py-2" id="inputPassword" type="password" placeholder="Enter password" name="password">
                </div>

                <button class="btn bg-slate-900 text-white btn-lg px-5" type="submit">Login</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>