<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body-bg-light mt-5">
            <div class="p-2">
                <?php flash('register_success') ?>
                <h2>Login </h2>
                <p>Please fill out your credentials.</p>
            </div>
            <form class="p-2" method="post" action="<?php echo URLROOT; ?>users/login">
                <div class="form-group my-2">
                    <label for="email">Email: <sup>*</sup> </label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo !empty($data['email_error']) ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['email_error'] ?>
                    </span>
                </div>
                <div class="form-group my-2">
                    <label for="password">Password: <sup>*</sup> </label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo !empty($data['password_error']) ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['password_error'] ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-bloc">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ?>users/register" class="brn btn-light btn-block">Don't have an accoun? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>