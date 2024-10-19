<?php $csrf = $params['csrf'] ?? null ?>

<section class="mt-5 gradient-custom pr-font">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card border-0" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center shadow">
            <form action="/user/register" method="POST" class="text-start" enctype="multipart/form-data">
              <?= $csrf->generate() ?>

              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">User Register</h2>
                <p class="text-muted mb-5">Please enter your details to register.</p>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" 
                         validators='{
                           "name": "name",
                           "required": true,
                           "minLength": 12,
                           "maxLength": 50,
                           "split": true
                         }' aria-describedby="nameHelp" required>
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" 
                         validators='{
                           "name": "email",
                           "required": true,
                           "email": true,
                           "minLength": 12,
                           "maxLength": 50
                         }' aria-describedby="emailHelp" required>
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" 
                         validators='{
                           "name": "password",
                           "required": true,
                           "password": true
                         }' required>
                </div>

                <div class="mb-3">
                  <label for="formFileMultiple" class="form-label">File Upload</label>
                  <input class="form-control" type="file" id="formFileMultiple" name="file" required>
                </div>

                <button class="btn bg-slate-900 text-white btn-lg px-5 mt-4" type="submit">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
