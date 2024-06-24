<?php
$csrf = $params['csrf'] ?? null;
$currentUrl = $_SERVER['REQUEST_URI'];
?>

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
            <span>
                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
            </span> Barley
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
                    <li class="list-group-item <?= $currentUrl == '/admin/dashboard' ? 'active' : '' ?> border-0 rounded-0 py-3" aria-current="true">Dashboard</li>
                </a>
                <a href="/admin/settings" class="text-decoration-none" disabled>
                    <li class="list-group-item <?= $currentUrl == '/admin/settings' ? 'active' : '' ?> border-0 rounded-0 py-3">Settings</li>
                </a>
                <a href="/admin/table" class="text-decoration-none">
                    <li class="list-group-item <?= $currentUrl == '/admin/table' ? 'active' : '' ?> border-0 rounded-0 py-3">Table</li>
                </a>
                <a href="/admin/form" class="text-decoration-none">
                    <li class="list-group-item <?= $currentUrl == '/admin/form' ? 'active' : '' ?> border-0 rounded-0 py-3">Form</li>
                </a>
                <a href="/admin/messages" class="text-decoration-none">
                    <li class="list-group-item <?= $currentUrl == '/admin/messages' ? 'active' : '' ?> border-0 rounded-0 py-3">Messages</li>
                </a>
                <a href="/admin/calendar" class="text-decoration-none">
                    <li class="list-group-item <?= $currentUrl == '/admin/calendar' ? 'active' : '' ?> border-0 rounded-0 py-3">Calendar</li>
                </a>
            </ul>
        </div>
    </div>
</div>
