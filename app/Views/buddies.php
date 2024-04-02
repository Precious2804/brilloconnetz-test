<!DOCTYPE html>
<html lang="en">
<?php include('head.php');
?>

<body>

    <!-- Navigation bar -->
    <?php
    $active2 = 'active';
    include('nav.php');
    ?>

    <!-- Profile content -->
    <div class="container mt-5 offset-md-2">
        <h1 class="mb-3"> Buddies</h1>
        <div class="float-left mb-5">
            <h4>Buddies that you share similar interest with</h4>
        </div>
        <?php
        if (!$buddies) { ?>
            <div class="alert alert-info text-center">
                <p>You currently do not have buddies that share similar interest with you</p>
            </div>
        <?php } ?>
        <div class="row mt-3">
            <?php
            foreach ($buddies as $item) { ?>
                <div class="card col-md-3 mx-4 mb-3">
                    <img src="<?php echo base_url() . "avatar.jpg"; ?>" alt="Avatar" class="buddies-avatar mx-auto d-block">
                    <div class="profile-details text-center">
                        <h1><?= $item['name'] ?></h1>
                        <p>Email: <?= $item['email'] ?></p>
                        <p>Phone Number: <?= $item['phone'] ?></p>
                        <p>Interest: <?= $item['interest'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Footer -->
        <?php include('footer.php'); ?>

        <!-- Bootstrap JS bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>