<?php

session_start();

include_once("../config/database.php");

include_once("../includes/header/login_header.php");

include_once("../includes/navbar/login_navbar.php");

?>


<!-- ================= LOGIN SECTION ================= -->

<section class="login-section">


    <div class="login-card">


        <div class="row g-0 h-100">


            <!-- ================= LEFT IMAGE ================= -->

            <div class="col-lg-6 login-left">


                <div class="text-center p-3">


                    <img
                        src="../assets/images/login img.png"
                        alt="Login Image"
                        class="img-fluid login-image"
                    >


                    <h3 class="fw-bold welcome-heading">

                        Welcome Back!

                    </h3>


                    <p class="welcome-text">

                        Manage your hospital and clinic activities
                        easily and efficiently.

                    </p>


                </div>


            </div>


            <!-- ================= RIGHT LOGIN FORM ================= -->

            <div class="col-lg-6 login-right">


                <div class="login-content">


                    <!-- ================= SUCCESS MESSAGE ================= -->

                    <?php

                    if(isset($_SESSION['success'])){

                    ?>

                        <div class="alert alert-info alert-dismissible fade show">

                            <?php

                            echo $_SESSION['success'];

                            ?>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    <?php

                        unset($_SESSION['success']);

                    }

                    ?>


                    <!-- ================= LOGIN ERROR ================= -->

                    <?php

                    if(isset($_SESSION['login_error'])){

                    ?>

                        <div class="alert alert-danger alert-dismissible fade show">

                            <?php

                            echo $_SESSION['login_error'];

                            ?>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    <?php

                        unset($_SESSION['login_error']);

                    }

                    ?>


                    <!-- ================= HEADING ================= -->

                    <div class="text-center mb-3">


                        <h2 class="fw-bold login-heading mb-1">

                            Login

                        </h2>


                        <p class="login-subtitle mb-0">

                            Login to your account

                        </p>


                    </div>


                    <!-- ================= LOGIN FORM ================= -->

                    <form
                        action="../queries/query.php"
                        method="POST"
                    >


                        <!-- EMAIL -->

                        <div class="mb-3">


                            <label class="form-label fw-semibold">

                                Email Address

                            </label>


                            <input
                                type="text"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                            >


                        </div>


                        <!-- PASSWORD -->

                        <div class="mb-3">


                            <label class="form-label fw-semibold">

                                Password

                            </label>


                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                            >


                        </div>


                        <!-- LOGIN BUTTON -->

                        <button
                            type="submit"
                            class="btn w-100 py-2 fw-bold text-white login-submit"
                            name="login_user"
                        >

                            <i class="fa-solid fa-right-to-bracket me-2"></i>

                            Login

                        </button>


                        <!-- REGISTER -->

                        <div class="text-center mt-3">


                            <span class="register-text">

                                Don't have an account?

                            </span>


                            <a
                                href="register.php"
                                class="fw-bold text-decoration-none ms-1"
                                style="color:#087f8c;"
                            >

                                Register

                            </a>


                        </div>
                        <div class="text-center mt-2">
                          <a href="../index.php" style="color:#066B76;">
                           <i class="fa-solid fa-house me-1"></i>Back to Home
                          </a>
                        </div>

                    </form>


                </div>


            </div>


        </div>


    </div>


</section>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>