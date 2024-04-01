<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>

    <!-- Navigation bar -->
    <?php include('nav.php'); ?>

    <!-- Profile content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="profile-cover"></div>
                <img src="<?php echo base_url() . "avatar.jpg"; ?>" alt="Avatar" class="profile-avatar mx-auto d-block">
                <div class="profile-details text-center">
                    <h1><?= session('user')['name'] ?></h1>
                    <p>Email: <?= session('user')['email'] ?></p>
                    <p>Phone Number: <?= session('user')['phone'] ?></p>
                    <p>Interest: <?= session('user')['interest'] ?></p>

                    <div class="mt-5">
                        <a href="/logout">
                            <div class="btn btn-danger logoutBtn">Logout</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>