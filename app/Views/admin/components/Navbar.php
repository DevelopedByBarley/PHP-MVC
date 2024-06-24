<?php $csrf = $params['csrf'] ?? null ?>


<nav class="navbar navbar-expand-lg">
	<div class="w-100 d-flex align-items-center justify-content-between">
		<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
			<i class="fas fa-bars"></i>
		</button>
		<div class="w-100 d-flex justify-content-end px-2">
			<div class="form-check form-switch mt-2 mx-3">
				<input class="form-check-input" type="checkbox" role="switch" id="theme-toggle">
			</div>
			<form action="/admin/logout" method="POST">
				<?= $csrf->generate() ?>
				<button type="submit" class="btn btn-outline-danger">Logout</button>
			</form>
		</div>
	</div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="offcanvasExampleLabel">
			<span><img style="height: 35px; width:35px;" class="rounded-circle mx-2" src="https://fakeimg.pl/300/" /> </span> Barley
		</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<div>
			Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
		</div>
		<div class="dropdown mt-5">
			<ul class="list-group border-0">
				<a href="/admin/dashboard" class="text-decoration-none">
					<li class="list-group-item active border-0 rounded-0 py-3" aria-current="true">Dashboard</li>
				</a>
				<a href="/admin/settings" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Admin</li>
				</a>
				<a href="/admin/messages" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Messages</li>
				</a>
				<a href="/admin/messages" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Calendar</li>
				</a>
				<a href="/admin/table" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Table</li>
				</a>
				<a href="/admin/messages" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Pagination</li>
				</a>
				<a href="/admin/messages" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">Form</li>
				</a>
				<a href="/admin/messages" class="text-decoration-none">
					<li class="list-group-item border-0 rounded-0 py-3">And a fifth one</li>
				</a>

			</ul>


		</div>
	</div>
</div>