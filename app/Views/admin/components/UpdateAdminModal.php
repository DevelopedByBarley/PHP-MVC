<div class="modal fade" id="updateAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Profil frissítése</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/admin/update">
                    <?= $csrf->generate() ?>

                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Name</label>
                        <input name="updated_name" type="text" value="<?= $admin['name'] ?? '' ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name " required data-validators='{
                            "name": "updated_name",
                            "required": true,
                            "minLength": 12,
                            "maxLength": 50
                        }'>
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="form3Example3">Email address</label>
                        <input name="updated_email" type="email" id="form3Example3" class="form-control" disabled value="<?= $admin['email'] ?? '' ?>" />
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Prev password</label>
                        <input type="text" id="prev_password" name="prev_password" class="form-control" required data-validators='{
                                "name": "prev_password",
                                "required": true
                            }' />
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" id="password" name="updated_password" class="password form-control" data-password-compare=1 required data-validators='{
                                "name": "updated_password",
                                "required": true
                            }' />
                        <button type="button" class="d-inline btn border pw-generator">Generate</button>
                    </div>

                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Repeat password</label>
                        <input type="text" id="repeat" name="repeat" class="form-control" required data-validators='{
                                "name": "repeat",
                                "comparePw": true
                            }' />
                    </div>


                    <?php if ((int)$admin['level'] === 3) : ?>
                        <div class="form-group my-2">
                            <label for="exampleInputPassword1">Level</label>
                            <select class="form-select" aria-label="Default select example"  required>
                                <option value="" selected>Select admin level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    <?php endif ?>
                    <div class="avatars">
                        <div class="row">
                            <label for="avatars" class="my-3">Avatar kiválasztása</label>
                            <?php foreach (AVATARS as $avatar) : ?>
                                <div class="col-2 d-flex align-items-center justify-content-center mb-2">
                                    <div class="form-check form-check-inline image-radio">
                                        <input required class="form-check-input" <?php echo $avatar === $admin['avatar'] ? 'checked' : '' ?> type="radio" name="updated_avatar_radio" id="updated_avatar_radio-<?php echo $avatar; ?>" value="<?php echo $avatar; ?>">
                                        <label class="form-check-label" for="updated_avatar_radio-<?php echo $avatar; ?>">
                                            <img src="/public/assets/images/avatars/<?php echo $avatar; ?>.png" class="h-45 w-45" alt="<?php echo ucfirst($avatar); ?>">
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>