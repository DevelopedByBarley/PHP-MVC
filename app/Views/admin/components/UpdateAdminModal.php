<div class="modal fade" id="updateAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Profil frissítése</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/hello" class="p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-right">Profile Settings</h5>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12"><label class="labels">Name</label>
                            <input name="updated_name" type="text" class="form-control" required placeholder="first name" value="<?= $admin['name'] ?? '' ?>" data-validators='{
                                            "name": "updated_name",
                                            "required": true,
                                            "minLength": 12,
                                            "maxLength": 50
                                        }'>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Password</label>
                            <input name="updated_password" type="text" class="form-control" required data-validators='{
                                            "name": "updated_password",
                                            "required": true,
                                            "password": true
                                        }'>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
                        <button type="submit" class="btn btn-primary">Megerősít</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>