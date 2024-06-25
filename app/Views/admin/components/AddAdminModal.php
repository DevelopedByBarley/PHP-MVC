<!-- Modal -->
<div class="modal fade " id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="exampleModalLabel">Add admin</h5>
                <button type="button" class="close border-0 rounded-circle" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name " required data-validators='{
                                            "name": "name",
                                            "required": true,
                                            "minLength": 12,
                                            "maxLength": 50
                                        }'>
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" id="password" name="password" class="form-control" class="work-id" required data-validators='{
                                "name": "password",
                                "required": true
                            }' />
                        <button type="button" class="d-inline btn border pw-generator">Generate</button>
                    </div>

                    <div class="form-group my-2">
                        <label for="exampleInputPassword1">Level</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option value="" selected>Select admin level</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
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