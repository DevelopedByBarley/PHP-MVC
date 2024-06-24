<?php $adminLevel = 3 ?>

<div class="container-fluid">
    <div class="row dark-bg-gray-900">
        <div class="col-12 col-lg-4 offset-xl-1">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://mdbootstrap.com/img/new/avatars/8.jpg">
                <div class="mt-2"><span class="fw-bold text-xl">Barley</span> <span>(Level 3)</span></div><span>developedbybarley@gmail.com</span><span> </span>
                <div class="mt-1 badge bg-sky-500  p-2">
                    (2024-01-01)
                </div>
            </div>

            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-right">Profile Settings</h5>
                </div>
                <div class="row mt-2">
                    <div class="col-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Password</label>
                        <input type="password" class="form-control" placeholder="enter phone number" value="">
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center justify-content-center mt-5">
                    <button class="btn bg-yellow-500 hover-bg-yellow-600 text-white  profile-button" type="button">Update Profile</button>
                    <button data-bs-toggle="modal" data-bs-target="#addAdminModel" class="btn bg-purple-500 hover-bg-purple-600 text-white  profile-button" type="button"><span class="px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Admin</span></button>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-8 col-xl-7">
            <div class=" d-flex p-5 my-5 align-items-start justify-content-center flex-column-reverse gap-5 table-responsive">
                <table class="table align-middle mb-0 rounded rounded-lg shadow">
                    <thead class="bg-teal-500">
                        <tr>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">John Doe</p>
                                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-lime-500 rounded-pill d-inline">Level 3</span>
                            </td>
                            <td>2024-02-10</td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Alex Ray</p>
                                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-cyan-500 rounded-pill d-inline">Level 2</span>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">2024-03-10</p>
                            </td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Kate Hunington</p>
                                        <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-orange-500 rounded-pill d-inline">Level 1</span>
                            </td>
                            <td>2023-10-10</td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">John Doe</p>
                                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-lime-500 rounded-pill d-inline">Level 3</span>
                            </td>
                            <td>2024-02-10</td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Alex Ray</p>
                                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-cyan-500 rounded-pill d-inline">Level 2</span>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">2024-03-10</p>
                            </td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Kate Hunington</p>
                                        <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-orange-500 rounded-pill d-inline">Level 1</span>
                            </td>
                            <td>2023-10-10</td>
                            <td>
                                <div class="btn-group gap-2">
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                        Show
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">John Doe</p>
                                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-lime-500 rounded-pill d-inline">Level 3</span>
                            </td>
                            <td>2024-02-10</td>
                            <td>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                    Show
                                </button>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Alex Ray</p>
                                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-cyan-500 rounded-pill d-inline">Level 2</span>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">2024-03-10</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white">
                                    Show
                                </button>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white">
                                    Delete
                                </button>
                            </td>
                        </tr>

                    </tbody>

                    <?php include 'app/Views/public/components/Pagination.php' ?>
                </table>
            </div>
        </div>

    </div>
</div>




<!-- Modal -->
<div class="modal fade " id="addAdminModel" tabindex="-1" role="dialog" aria-labelledby="addAdminModelLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name " required>
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Password</label>
                        <div class="d-flex gap-2">
                            <input type="text" id="password" name="password" class="form-control" class="work-id" required "/>
                            <button type=" button" class="btn border pw-generator">Generate</button>
                        </div>
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

