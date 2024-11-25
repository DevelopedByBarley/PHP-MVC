<main class="flex-shrink-0">

    <header class="py-5 mt-5 min-vh-75 d-flex align-items-center justify-content-center">
        <div class="container px-5 flex">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder mb-2">
                            <?php echo TEXTS['header']['title'][$lang]; ?>
                        </h1>
                        <p class="lead fw-normal mb-4">
                            <?php echo TEXTS['header']['desc'][$lang]; ?>
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-outline-light btn-lg px-4" href="#features">
                                <?php echo TEXTS['header']['button'][$lang]; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <div class="blur-load">
                        <img class="img-fluid rounded-5" loading="lazy" src="https://dummyimage.com/600x400/343a40/6c757d" alt="..." />
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-0">
                        <?php echo TEXTS['features']['intro'][$lang]; ?>
                    </h2>
                </div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-bell"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['toast_notifications']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['toast_notifications']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-shield-lock"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['authentication']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['authentication']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-lock"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['csrf']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['csrf']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-file-earmark"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['filesaver']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['filesaver']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['mailer']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['mailer']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-file-earmark-excel"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['xlsx_export']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['xlsx_export']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-check-circle"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['validation']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['validation']['desc'][$lang]; ?>
                            </p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-gradient rounded-3 mb-3"><i class="bi bi-blockquote-right"></i></div>
                            <h2 class="h5">
                                <?php echo TEXTS['features']['skeleton']['title'][$lang]; ?>
                            </h2>
                            <p class="mb-0">
                                <?php echo TEXTS['features']['skeleton']['desc'][$lang]; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial section-->
    <div class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">
                            <?php echo TEXTS['testimonial']['quote'][$lang]; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

