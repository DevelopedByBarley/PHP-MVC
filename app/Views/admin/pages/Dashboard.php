<?php include('app/Views/admin/components/Header.php') ?>


<main id="admin-dashboard">
  <div class="container-fluid mb-5">
    <div class="row gap-3 d-flex align-items-center justify-content-center">
      <div class="col-12 col-md-5 col-lg-3 col-xl-2 min-h-200 border bg-cyan-500 hover-bg-cyan-700 dark-bg-cyan-700 dark-bg-hover-cyan-600 transition-ease-in-out-300  d-flex align-items-center justify-content-between gray-50 shadow-lg rounded">
        <div>
          <h1>150</h1>
          <p>New registrations</p>
        </div>
        <div>
          <i class="fa-solid fa-user-plus text-7xl"></i>
        </div>
      </div>
      <div class="col-12 col-md-5 col-lg-3 col-xl-2 min-h-200 border bg-amber-500 hover-bg-amber-700 dark-bg-amber-700 dark-bg-hover-amber-600 transition-ease-in-out-300  d-flex align-items-center justify-content-between gray-50 shadow-lg rounded">
        <div>
          <h1>50</h1>
          <p>Unique visitors</p>
        </div>
        <div>
          <i class="fa-solid fa-chart-simple text-7xl"></i>
        </div>
      </div>
      <div class="col-12 col-md-5 col-lg-3 col-xl-2 min-h-200 border bg-indigo-500 hover-bg-indigo-700 dark-bg-indigo-700 dark-bg-hover-indigo-600 transition-ease-in-out-300 d-flex align-items-center justify-content-between gray-50 shadow-lg rounded">
        <div>
          <h1>600</h1>
          <p>Likes</p>
        </div>
        <div>
          <i class="fa-solid fa-thumbs-up text-7xl"></i>
        </div>
      </div>
      <div class="col-12 col-md-5 col-lg-3 col-xl-2 min-h-200 border bg-rose-500 hover-bg-rose-700 dark-bg-rose-700 dark-bg-hover-rose-600 transition-ease-in-out-300  d-flex align-items-center justify-content-between gray-50 shadow-lg rounded">
        <div>
          <h1>4</h1>
          <p>Admins</p>
        </div>
        <div>
          <i class="fa-solid fa-user-plus text-7xl"></i>
        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid mb-5 my-5" style="margin-top: -2.5rem;">
    <div class="row gap-3 d-flex align-items-center justify-content-center">
      <div class="col-12 col-md-6 col-lg-6 col-xl-7 min-h-300 border bg-gray-50 dark-bg-gray-900 shadow-lg rounded">
        <div class="bg-gray-50 dark-bg-gray-800">
          <h4 class="p-3 mb-3 dark-gray-900">Admin List</h4>
        </div>

        <div class="admins min-h-300 overflow-y-scroll" style="max-height: 320px;">
          <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Bill Gates</div>
                Level 3
              </div>
              <div class="operations">
                <button class="btn btn-outline-info ">show</button>
                <button class="btn btn-outline-danger ">delete</button>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Elon Musk</div>
                Level 1
              </div>
              <div class="operations">
                <button class="btn btn-outline-info ">show</button>
                <button class="btn btn-outline-danger ">delete</button>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Jeff Besos</div>
                Level 2
              </div>
              <div class="operations">
                <button class="btn btn-outline-info ">show</button>
                <button class="btn btn-outline-danger ">delete</button>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Mark Zuckerberg</div>
                Level 3
              </div>
              <div class="operations">
                <button class="btn btn-outline-info ">show</button>
                <button class="btn btn-outline-danger ">delete</button>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Jon Doe</div>
                Level 1
              </div>
              <div class="operations">
                <button class="btn btn-outline-info">show</button>
                <button class="btn btn-outline-danger">delete</button>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="mx-2">
                <img style="height: 40px; width: 40px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" />
              </span>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Jon Doe</div>
                Level 1
              </div>
              <div class="operations">
                <button class="btn btn-outline-info">show</button>
                <button class="btn btn-outline-danger">delete</button>
              </div>
            </li>
          </ol>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 col-xl-3 min-h-400 border bg-gray-50 dark-bg-gray-900 shadow-lg rounded d-flex align-items-center justify-content-center">
        <div class="admin-settings min-h-300 h-100 d-flex align-items-center justify-content-center mx-3">
          <span>
            <img  src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 90px; height: 90px" class="rounded-circle mx-3" />
            </span>
          <div >
            <p class="mb-0"><span class="fw-bolder text-3xl">Barley</span> <span>(Level 3)</span></p>
            <p>developedbybarley@gmail.com</p>
            <button class="btn bg-purple-600 hover-bg-purple-700 px-4">
              <span><i class="fa-solid fa-gears text-2xl gray-50"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="container-fluid px-5">
    <div class="row my-7">
      <div class="col-12 px-5">
        <h1>Progress 2</h1>
        <label>Progress 1</label>
        <div class="progress">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 2</label>
        <div class="progress">
          <div class="progress-bar bg-secondary" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 3</label>
        <div class="progress">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 4</label>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 5</label>
        <div class="progress">
          <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 6</label>
        <div class="progress">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label>Progress 7</label>
        <div class="progress">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid px-5">
    <div class="row">
      <div class="col-12 col-md-10 mx-auto mb-3 col-xl-6">
        <h4>Registrations chart in line</h4>
        <canvas id="myChart"></canvas>
      </div>

      <div class="col-12 col-md-10 mx-auto mb-3 col-xl-4">
        <h4>Registrations chart in donut</h4>
        <canvas id="myChart_2"></canvas>
      </div>
    </div>
  </div>


  <?php include 'app/Views/admin/pages/Table.php' ?>


</main>



