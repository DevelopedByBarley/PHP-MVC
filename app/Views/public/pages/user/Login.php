  <div class="container py-5 h-100 vh-100 pr-font mt-5 pr-font">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card border-0" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center shadow">
            <form action="/user/login" class="text-start" method="POST">
              <?= $csrf->generate() ?>

              <div class="mb-md-5 mt-md-4">
                <div class="d-flex align-items-center justify-content-center gap-3">
                  <h2 class="fw-bold mb-2 text-uppercase">Bejelentkezés </h2>
                </div>
                <p class="text-center mb-4">Kérjük írja be e-mail címét és jelszavát</p>

                <section class="my-3">
                  <div class="form-outline form-white mb-4">
                    <input type="email" name="email" data-validator="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail cím" required>
                    <label class="form-label" for="typeEmailX">E-mail</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" name="password" class="form-control" data-validator="password" id="exampleInputPassword1" placeholder="Jelszó" required>
                    <label class="form-label" for="typePasswordX">Jelszó</label>
                  </div>
                </section>

                <div class="text-center">
                  <button class="btn bg-slate-900 text-white btn-lg px-5" type="submit">Bejelentkezés</button>
                </div>

                <p class="fw-bolder text-sm bg-orange-500 text-white mt-3 p-3 rounded text-center">ITT TALÁN FEL KÉNE HÍVNI A FELHASZNÁLÓK FIGYELMÉT HOGY EZ A PORTÁL A SZÜLŐK RÉSZÉRE KÉSZÜLT </p>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>