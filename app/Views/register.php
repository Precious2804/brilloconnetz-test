<!doctype html>
<html lang="en">
<?php include('auth_head.php'); ?>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="form-title">Register Here</h2>
                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <p>A verification link has been sent to your email <b><?= session('success') ?></b>. Please visit your email and click the link to verify your account and then proceed</p>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('register/submit') ?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="interest" class="form-label">Special Interest</label>
                        <select class="form-select" name="interest" required>
                            <option selected>Select your special interest</option>
                            <option value="Football">Football</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Ice Hockey">Ice Hockey</option>
                            <option value="Motorsports">Motorsports</option>
                            <option value="Bandy">Bandy</option>
                            <option value="Rugby">Rugby</option>
                            <option value="Skiing">Skiing</option>
                            <option value="Shooting">Shooting</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <p class="link">Already have an account? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
