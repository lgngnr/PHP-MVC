<?php require APPROOT . "/views/include/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2> Create and account </h2>
            <p> Please fillup this form to register with us </p>
            <form action="<?php echo URLROOT . "/users/register";?>" method="post">
                <div class="form-group">
                    <!-- Name -->
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg
                        <?php echo !empty($data['name_error']) ? 'is-invalid' : '' ;?>" 
                        value="<?php echo $data['name'] ?>">
                    <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                    <!-- Email -->
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg
                        <?php echo !empty($data['email_error']) ? 'is-invalid' : '' ;?>" 
                        value="<?php echo $data['email'] ?>">
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                    <!-- Password -->
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg
                        <?php echo !empty($data['password_error']) ? 'is-invalid' : '' ;?>" 
                        value="<?php echo $data['password'] ?>">
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                    <!-- Confirm Password -->
                    <label for="c_password">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="c_password" class="form-control form-control-lg
                        <?php echo !empty($data['c_password_error']) ? 'is-invalid' : '' ;?>" 
                        value="<?php echo $data['c_password'] ?>">
                    <span class="invalid-feedback"><?php echo $data['c_password']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                    <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . "/views/include/footer.php"; ?>