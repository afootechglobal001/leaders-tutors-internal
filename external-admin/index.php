<?php include 'config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Admin Portal</title>
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-div">
        <div class="login-image-div">
            <div class="logo-div">
                <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="Logo">
            </div>


            <div class="bottom-container">
                <h1>
                    Leaders Tutors -
                    <span>Admin Portal</span>
                </h1>

                <p>
                    Manage tutorials, monitor students, organize exams, and track subscription activities
                    from one centralized admin dashboard.
                </p>
            </div>
        </div>

        <div class="login-card-div">
            <div class="form-section">
                <div class="logo-div">
                    <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="Logo">
                </div>

                <div class="form-div animated fadeIn">
                    <h1> Welcome <span>Back!</span></h1>
                    <p>Please enter your details to login to Leaders Tutor External Exam Admin portal</p>

                    <div class="inner-form" id="viewLogin">
                        <div class="text_field_container" id="userName_container">
                            <script>
                                textField({
                                    id: 'userName',
                                    title: 'Email Address'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="password_container">
                            <script>
                                textField({
                                    id: 'password',
                                    title: 'Password',
                                    type: 'password'
                                });
                            </script>
                        </div>

                        <div class="btn-div">
                            <button class="btn" id="submitBtn" title="Log In" onclick="_confirmLogin();">Log In <i class="bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>