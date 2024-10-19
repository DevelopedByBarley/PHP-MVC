<div class="container-fluid min-h-95 d-flex p-5 my-5 align-items-start justify-content-center flex-column-reverse gap-5 table-responsive">
  <table class="table align-middle mb-0 rounded rounded-lg shadow">
    <thead class="bg-teal-500">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($users as $user): ?>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="<?= "/public/assets/uploads/images/$user->fileName" ?? 'https://mdbootstrap.com/img/new/avatars/8.jpg' ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
              <div class="ms-3">
                <p class="fw-bold mb-1"><?= $user->name ?></p>
              </div>
            </div>
          </td>
          <td>
            <p class="text-muted mb-0"><?= $user->email ?></p>
          </td>
          <td>
            <span class="badge bg-lime-500 rounded-pill d-inline">
              <?= $user->created_at ?>
            </span>
          </td>
          <td>Senior</td>
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
      <?php endforeach ?>
    </tbody>

    <?php include 'app/Views/public/components/Pagination.php' ?>
  </table>
</div>