<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= $active1 ?? '' ?>" aria-current="page" href="/dashboard">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active2 ?? '' ?>" href="/buddies">Buddies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Discover</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $active3 ?? '' ?>" href="/settings">Setting & Privacy</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <div class="btn btn-danger logoutBtn">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>