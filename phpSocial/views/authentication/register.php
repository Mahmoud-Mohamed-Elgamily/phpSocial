<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-content=" width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card" style="height:450px">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png"
                            class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="../../controller/authenticationController.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">U</span>
                            </div>
                            <input required type="text" name="userName" class="form-control input_user" placeholder="username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">E</span>
                            </div>
                            <input required type="email" name="email" class="form-control input_user" placeholder="Email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text">P</span>
                            </div>
                            <input required type="password" name="Password1" class="form-control input_pass"
                                placeholder="password">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text">P</span>
                            </div>
                            <input required type="password" name="Password2" class="form-control input_pass"
                                placeholder="re-enter password">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="font-size: 17px;font-family: monospace;">I</div>
                            </div>
                            <input required type="file" class="form-control" name="image">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="register" class="btn login_btn">Sign Up</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>