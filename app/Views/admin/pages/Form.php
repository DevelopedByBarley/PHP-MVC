<header class="vh-100 d-flex align-items-center justify-content-center flex-column" style="background: url(/public/assets/images/conference_1.jpg) center center/cover;"></header>
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="title text-3xl text-center my-5 main-green fw-bolder">Kedves Kollegák</h2>
                <div class="text-base">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero purus. Duis eu interdum nisl. Mauris hendrerit facilisis risus sed viverra. Curabitur euismod suscipit dapibus. Etiam lacinia rutrum quam, ac venenatis magna. Donec augue augue, egestas faucibus velit ac, tristique varius metus. In fermentum, orci posuere placerat finibus, urna lacus eleifend diam, lacinia tincidunt sem nisi quis dolor. Quisque pellentesque blandit elementum.
                    </p>
                    <p>
                        Nullam mi mauris, imperdiet id condimentum et, rhoncus aliquet sapien. Sed condimentum purus eleifend neque rhoncus, a tincidunt libero mattis. Fusce sollicitudin lorem id interdum ullamcorper. Morbi cursus mi nec lectus maximus aliquam nec sed lacus. Vestibulum nulla leo, aliquam non gravida eu, gravida sed mi. Donec molestie lorem sit amet leo efficitur, a porta nisi dignissim. Vestibulum commodo arcu et condimentum bibendum. Curabitur dignissim, odio quis ultricies fringilla, tortor ipsum mattis nibh, quis placerat nulla eros dignissim arcu. Nullam aliquam molestie tellus, non porttitor ex accumsan id. In sodales tortor non pulvinar consectetur. Curabitur viverra tempor facilisis. Curabitur egestas viverra volutpat.
                    </p>
                    <p class="fw-bold">
                        Csatlakozzon Ön is és jelölje be a naptárában a dátumot!
                    </p>
                    <p class="text-base"><span class="fw-bold main-red">DÁTUM:</span> 2024.11.06. 09:00-14:30</p>
                    <p class="text-base"><span class="fw-bold main-red">HELYSZÍN: </span>Campona Cinema City Mozi - Budapest, Nagytétényi út 37-48, 122 (embedd térképpel is mehet)</p>
                </div>
            </div>
        </div>


        <div id="program" class="row my-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="timeline-title fw-bolder my-3 text-2xl main-dark dark-text-slate-50">
                    Programterv
                </h2>

                <ul class="p-0">
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark dark-text-slate-50 fw-bolder">
                            09:00-09:15
                        </h3>
                    </li>
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark dark-text-slate-50 fw-bolder">
                            09:15-10:00
                        </h3>
                        <h3 class="text-base px-5">
                            Előadás 1
                        </h3>
                    </li>
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark dark-text-slate-50 fw-bolder">
                            10:00-11:00
                        </h3>
                        <h3 class="text-base px-5">
                            Előadás 2
                        </h3>
                    </li>
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark dark-text-slate-50 fw-bolder">
                            11:00-11:15
                        </h3>
                        <h3 class="text-base px-5">
                            Kávészünet
                        </h3>
                    </li>
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark dark-text-slate-50 fw-bolder">
                            11:15-12:15
                        </h3>
                        <h3 class="text-base px-5">
                            Előadás 3
                        </h3>
                    </li>
                    <li class="list-group-item d-flex align-items-center p-3 light-border-slate-300 border-slate-50 border-top border-bottom">
                        <h3 class="text-base main-dark fw-bolder dark-text-slate-50">
                            12:15-13:00
                        </h3>
                        <h3 class="text-base px-5">
                            Ebéd
                        </h3>
                    </li>
                </ul>

                <p class="mt-5 fst-italic">Várjuk szeretettel!</p>

                <div class="mb-5 text-center">
                    <img src="/public/assets/images/icon.png" style="height: 80px; width: 95px;" alt="">
                </div>
            </div>
        </div>


    </div>

    <div class="container-fluid py-5">
        <div class="container" id="registration">
            <div class="row">
                <div class="col col-lg-8 mx-auto">
                    <form action="/user/register" method="POST">
                        <!-- Name -->
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <label class="form-label  " for="name">Név</label>
                                <input type="text" id="name" name="name" placeholder="Teljes név" class="form-control" required value="<?php echo isset($prev) ? $prev['name'] : '' ?>" validators='{
                "name": "name",
                "split": true,
                "required": true,
                "minLength": 5,
                "maxLength": 50
              }' />


                                <?php if (!empty($errors['name'])): ?>
                                    <div class="alert alert-danger p-1" role="alert">
                                        <?php foreach ($errors['name'] as $error): ?>
                                            <p class="m-0"><?= $error ?></p>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>

                            <!-- Company -->
                            <div class="col-12 col-lg-6 mb-4">
                                <label class="form-label" for="company">Cég / Autós iskola</label>
                                <input type="text" id="company" name="company" placeholder="Cég / Autós iskola pontos neve" class="form-control" value="<?php echo isset($prev) ? $prev['company'] : '' ?>" validators='{
             "name": "company",
             "required": true,
             "minLength": 5,
             "maxLength": 100
         }' required />
                                <?php if (!empty($errors['company'])): ?>
                                    <div class="alert alert-danger p-1" role="alert">
                                        <?php foreach ($errors['company'] as $error): ?>
                                            <p class="m-0"><?= $error ?></p>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!-- Post -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label  " for="post">Beosztás</label>
                                <input type="text" id="post" name="post" placeholder="Beosztás" class="form-control" value="<?php echo isset($prev) ? $prev['post'] : '' ?>" validators='{
             "name": "post",
             "required": true,
             "minLength": 5,
             "maxLength": 50
         }' required />
                                <?php if (!empty($errors['post'])): ?>
                                    <div class="alert alert-danger p-1" role="alert">
                                        <?php foreach ($errors['post'] as $error): ?>
                                            <p class="m-0"><?= $error ?></p>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4">
                                <label class="form-label  " for="email">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="E-mail cím" class="form-control " value="<?php echo isset($prev) ? $prev['email'] : '' ?>" validators='{
             "name": "email",
             "email": true,
             "required": true,
             "minLength": 5,
             "maxLength": 50
         }' required />
                                <?php if (!empty($errors['email'])): ?>
                                    <div class="alert alert-danger p-1" role="alert">
                                        <?php foreach ($errors['email'] as $error): ?>
                                            <p class="m-0"><?= $error ?></p>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>

                            <!-- Phone -->
                            <div class="col-12 col-lg-6 mb-4">
                                <label class="form-label  " for="phone">Telefonszám</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefonszám pl. +36-20-123-4567" value="<?php echo isset($prev) ? $prev['phone'] : '' ?>" validators='{
             "name": "phone",
             "required": true,
             "phone": true,
             "minLength": 9,
             "maxLength": 17
         }' required />
                                <?php if (!empty($errors['phone'])): ?>
                                    <div class="alert alert-danger p-1" role="alert">
                                        <?php foreach ($errors['phone'] as $error): ?>
                                            <p class="m-0"><?= $error ?></p>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!-- Intolerance -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="intolerance" class="form-label  ">Amennyiben Ön bármilyen ételintoleranciával rendelkezik, kérjük, előre jelezze csapatunknak!</label>
                                <textarea class="form-control" id="intolerance" placeholder="Ételintolerancia leírása" rows="4" name="intolerance"><?php echo isset($prev) ? $prev['intolerance'] : '' ?></textarea>
                            </div>
                        </div>

                        <!-- Comment -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="comment" class="form-label  ">Megjegyzés</label>
                                <textarea class="form-control" id="comment" placeholder="Megjegyzés..." rows="4" name="comment"><?php echo isset($prev) ? $prev['comment'] : '' ?></textarea>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" required />
                                    <label class="form-check-label" for="form6Example8"> Az <a href="#">adatkezelési tájékoztatót</a> elolvastam, elfogadom </label>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-check mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" required />
                                    <label class="form-check-label" for="form6Example8">
                                        Hozzájárulok, hogy a rendezvényen kép- és videófelvétel készülhet rólam, melyet a szervezők marketing és kommunikációs célokra felhasználhatnak.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-block mb-4 bg-success">Regisztrácó</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>
<footer class="py-5" id="contact">
    <p class="text-center">
        Copyright © 2024 – Készítette a <a href="https://max.hu">Max & Future webteam</a>
    </p>
</footer>