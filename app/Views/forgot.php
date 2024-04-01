<!doctype html>
<html lang="en">
<?php include('auth_head.php'); ?>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('forgot/submit') ?>" method="post">
                    <h2>Request Password Reset</h2>
                    <?php if (session()->has('fail')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('fail') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <p>A password reset link has been sent to <b><?= session('success') ?></b>. Please visit your email and click the link to proceed</p>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <p class="link">Don't have an account? <a href="/register">Sign Up</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>