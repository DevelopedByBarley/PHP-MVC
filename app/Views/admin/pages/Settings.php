<?php
$admin = $params['admin'] ?? null;
$level = $admin['level'] ?? null;
?>

<div class="container-fluid">
    <div class="row dark-bg-gray-900">
        <div class="col-12 <?= (int)$level === 3 ? 'col-lg-4 offset-xl-1' : '' ?>">
            <div class="d-flex flex-column align-items-center text-center p-3 pt-5">
                <img class="rounded-circle mt-5" width="150px" src="https://mdbootstrap.com/img/new/avatars/8.jpg">
                <div class="mt-2"><span class="fw-bold text-xl"><?= $admin['name'] ?></span> <span>(Level <?= $level ?>)</span></div><span><?= $admin['email'] ?></span><span> </span>
                <div class="mt-1 badge bg-sky-500  p-2 mt-2">
                    (<?= $admin['created_at'] ?>)
                </div>
            </div>

            <div class="d-flex gap-3 align-items-center justify-content-center">
                <button data-bs-toggle="modal" data-bs-target="#updateAdminModal" class="btn bg-yellow-500 hover-bg-yellow-600 text-white  profile-button" type="button">Update Profile</button>
                <button data-bs-toggle="modal" data-bs-target="#addAdminModal" class="btn bg-purple-500 hover-bg-purple-600 text-white  profile-button" type="button"><span class="px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Admin</span></button>
            </div>

        </div>
        <?php if ((int)$level === 3) : ?>
            <div class="col-12 col-lg-8 col-xl-7">
                <div class=" d-flex p-5 my-5 align-items-start justify-content-center flex-column-reverse gap-5 table-responsive">
                    <table class="table align-middle mb-0 rounded shadow ">
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
        <?php endif ?>

    </div>
</div>





<?php include 'app/Views/admin/components/UpdateAdminModal.php'?>
<?php include 'app/Views/admin/components/AddAdminModal.php'?>






