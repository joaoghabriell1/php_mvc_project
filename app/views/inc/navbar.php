    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
        <div class="container">
            <a class="navbar-brand" href="<?php echo !isLoggedIn() ? URLROOT : URLROOT . 'posts/index' ?>">Shareposts</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $data['url'] == 'home' ?  'active' : '' ?>" aria-current="page" href="<?php echo !isLoggedIn() ? URLROOT : URLROOT . 'posts/index' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $data['url'] == 'about' ?  'active' : '' ?>" aria-current="page" href="<?php echo URLROOT . 'home/about'  ?>">About</a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['url'] == 'register' ?  'active' : '' ?>" aria-current="page" href="<?php echo URLROOT . 'users/logout'  ?>">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['url'] == 'register' ?  'active' : '' ?>" aria-current="page" href="<?php echo URLROOT . 'users/register'  ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['url'] == 'login' ?  'active' : '' ?>" aria-current="page" href="<?php echo URLROOT . 'users/login'  ?>">Login</a>
                        </li>
                    <?php endif;  ?>
                </ul>
            </div>
        </div>
    </nav>