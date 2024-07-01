<!--
    Meg kell néznünk adott e már le feedbacket ip alapján
    Ha igen nem jelenitjük meg a modalt
    Ha nem akkor igen de azt is úgy hogy kb 5 perc után jelenjen meg függetlenül attól hogy refreshel az ember teljen az idő , mondjuk localstorage segitségével
-->


<div class="modal fade rating-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Feedback Modal</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="/feedback" method="POST" enctype="multipart/form-data">
                                <p>Please select your preferred style:</p>

                                <div class="d-flex flex-wrap align-items-center justify-content-center">
                                    <!-- Smileys -->
                                    <div class="form-check">
                                        <input class="form-check-input visually-hidden" type="radio" name="feedback" id="style1" value="1">
                                        <label class="form-check-label smiley-label" for="style1">
                                            <span class="smiley-icon" role="img" aria-label="Smiley">😊</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input visually-hidden" type="radio" name="feedback" id="style2" value="2">
                                        <label class="form-check-label smiley-label" for="style2">
                                            <span class="smiley-icon" role="img" aria-label="Smiley">😄</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input visually-hidden" type="radio" name="feedback" id="style3" value="3">
                                        <label class="form-check-label smiley-label" for="style3">
                                            <span class="smiley-icon" role="img" aria-label="Smiley">😉</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input visually-hidden" type="radio" name="feedback" id="style4" value="4">
                                        <label class="form-check-label smiley-label" for="style4">
                                            <span class="smiley-icon" role="img" aria-label="Smiley">😎</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input visually-hidden" type="radio" name="feedback" id="style5" value="5">
                                        <label class="form-check-label smiley-label" for="style5">
                                            <span class="smiley-icon" role="img" aria-label="Smiley">🤗</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="submitFeedbackBtn">Elküldés</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>