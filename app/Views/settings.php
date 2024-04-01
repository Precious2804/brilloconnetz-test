<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>

    <!-- Navigation bar -->
    <?php include('nav.php'); ?>

    <!-- Profile content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 mb-2">
                <a href="/logout">
                    <div class="btn btn-danger logoutBtn">Logout</div>
                </a>
            </div>
            <div class="col-md-8 offset-md-2">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-md-8 offset-md-2 mb-5">
                <h5>Update Profile</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('settings/update') ?>" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= session('user')['name'] ?>" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= session('user')['email'] ?>" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?= session('user')['phone'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="interest" class="form-label">Special Interest</label>
                                <select class="form-select" name="interest">
                                    <?php
                                    $interests = ['Football', 'Basketball', 'Ice Hockey', 'Motorsports', 'Bandy', 'Rugby', 'Skiing', 'Shooting'];
                                    foreach ($interests as $interest) {
                                        $selected = session('user')['interest'] === $interest ? 'selected' : '';
                                        echo "<option value='$interest' $selected>$interest</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 offset-md-2 mb-5">
                <h5>Change Password</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('settings/update-pass') ?>" method="post">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="password" name="old_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="password" name="password_confirm" required>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
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