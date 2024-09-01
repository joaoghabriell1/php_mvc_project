<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body-bg-light mt-5">
            <div class="p-2">
                <h2>Create An account </h2>
                <p> Please fill out this form to register with us</p>
            </div>
            <form class="p-2" method="post" action="<?php echo URLROOT; ?>users/register">
                <div class="form-group my-2">
                    <label for="name">Name: <sup>*</sup> </label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo !empty($data['name_error']) ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['name_error'] ?>
                    </span>
                </div>
                <div class="form-group my-2">
                    <label for="email">Email: <sup>*</sup> </label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo !empty($data['email_error']) ? 'is-invalid' : '' ?>" value="<?php echo empty($data['email']) ? '' : empty($data['email']) ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['email_error'] ?>
                    </span>
                </div>
                <div class="form-group my-2">
                    <label for="password">Password: <sup>*</sup> </label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo !empty($data['email_error']) ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['password_error'] ?>
                    </span>
                </div>
                <div class="form-group my-2">
                    <label for="confirm_password">Confirm your password: <sup>*</sup> </label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo !empty($data['confirm_password_error']) ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedbak">
                        <?php echo $data['confirm_password_error'] ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-bloc">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ?>users/login" class="brn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>