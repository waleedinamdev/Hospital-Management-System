<?php
session_start();

include_once("../config/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Hospital Management System</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
    >


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: Arial, sans-serif;
            background: #f7fbfc;
            color: #183b4a;
        }


        /* ================= NAVBAR ================= */

        .main-navbar {

            width: 100%;
            height: 75px;

            padding: 0 7%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: white;

            box-shadow: 0 3px 15px rgba(0,0,0,0.08);

        }


        /* LOGO */

        .navbar-logo {

            width: 250px;
            height: 75px;

            object-fit: contain;

        }


        /* NAV BUTTONS */

        .nav-buttons {

            display: flex;
            gap: 10px;

        }


        .login-btn,
        .register-btn {

            text-decoration: none;

            padding: 9px 20px;

            border-radius: 8px;

            font-weight: bold;

            transition: 0.3s;

        }


        /* LOGIN */

        .login-btn {

            color: #087f8c;

            background: white;

            border: 2px solid #087f8c;

        }


        /* REGISTER ACTIVE */

        .register-btn.active {

            color: white;

            background: #087f8c;

            border: 2px solid #087f8c;

        }


        .login-btn:hover {

            color: white;

            background: #087f8c;

        }


        .register-btn:hover {

            color: #087f8c;

            background: white;

        }


        /* ================= REGISTER SECTION ================= */

        .register-section {

            min-height: calc(100vh - 75px);

            padding: 10px 15px;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        /* REGISTER CARD */

        .register-card {

            width: 100%;

            max-width: 900px;

            background: white;

            border-radius: 18px;

            overflow: hidden;

            box-shadow: 0 8px 25px rgba(0,0,0,0.10);

        }


        /* LEFT SIDE */

        .register-left {

            min-height: 420px;

            background: #e9f9fa;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .register-image {

            max-height: 250px;

            width: auto;

            max-width: 90%;

            object-fit: contain;

        }


        .register-welcome {

            color: #183b4a;

            font-size: 22px;

            margin-top: 8px;

            margin-bottom: 5px;

        }


        .register-description {

            color: #6b8087;

            font-size: 13px;

            line-height: 1.5;

        }


        /* ================= RIGHT FORM ================= */

        .register-content {

            padding: 18px 35px;

        }


        .register-heading {

            margin-bottom: 12px;

        }


        .register-heading h2 {

            color: #183b4a;

            font-size: 26px;

            margin-bottom: 2px;

        }


        .register-heading p {

            color: #6b8087;

            font-size: 13px;

            margin-bottom: 0;

        }


        /* FORM FIELDS */

        .register-field {

            margin-bottom: 9px;

        }


        .register-field label {

            color: #183b4a;

            font-size: 14px;

            margin-bottom: 3px;

        }


        .register-field input {

            height: 38px;

            padding: 5px 12px;

            font-size: 14px;

            border: 1px solid #d5e2e5;

            border-radius: 7px;

        }


        .register-field input:focus {

            border-color: #087f8c;

            box-shadow: 0 0 5px rgba(8,127,140,0.18);

        }


        /* REGISTER BUTTON */

        .register-submit {

            height: 39px;

            padding: 5px;

            margin-top: 4px;

            background: #087f8c;

            border: none;

            border-radius: 7px;

        }


        .register-submit:hover {

            background: #066b76;

        }


        /* LOGIN TEXT */

        .register-login {

            margin-top: 10px;

            font-size: 13px;

            color: #6b8087;

        }


        .register-login a {

            color: #087f8c;

            margin-left: 5px;

        }


        /* ALERT */

        .alert {

            padding: 7px 12px;

            margin-bottom: 8px;

            font-size: 13px;

        }


        /* ================= RESPONSIVE ================= */

        @media (max-width: 991px) {

            .register-card {

                max-width: 500px;

            }

            .register-content {

                padding: 25px;

            }

        }


        @media (max-width: 600px) {

            .main-navbar {

                padding: 0 15px;

            }


            .navbar-logo {

                width: 180px;

                height: 65px;

            }


            .login-btn,
            .register-btn {

                padding: 7px 10px;

                font-size: 13px;

            }


            .register-content {

                padding: 20px;

            }

        }

    </style>

</head>


<body>


<!-- ================= NAVBAR ================= -->

<header class="main-navbar">


    <!-- LOGO -->

    <a href="../index.php">

        <img
            src="../assets/images/logo.png"
            alt="Hospital Logo"
            class="navbar-logo"
        >

    </a>


    <!-- BUTTONS -->

    <div class="nav-buttons">

        <a
            href="login.php"
            class="login-btn"
        >

            <i class="fa-solid fa-right-to-bracket me-1"></i>

            Login

        </a>


        <a
            href="register.php"
            class="register-btn active"
        >

            <i class="fa-solid fa-user-plus me-1"></i>

            Register

        </a>

    </div>

</header>



<!-- ================= REGISTER SECTION ================= -->

<div class="register-section">


    <div class="register-card">


        <div class="row g-0">


            <!-- ================= LEFT IMAGE ================= -->

            <div class="col-lg-6 d-none d-lg-flex register-left">

                <div class="text-center p-3">


                    <img
                        src="../assets/images/register.PNG"
                        alt="Register Artwork"
                        class="register-image"
                    >


                    <h3 class="fw-bold register-welcome">

                        Hospital Management System

                    </h3>


                    <p class="register-description">

                        Create your account and manage healthcare
                        activities easily and efficiently.

                    </p>


                </div>

            </div>



            <!-- ================= RIGHT REGISTER FORM ================= -->

            <div class="col-lg-6 d-flex align-items-center">


                <div class="register-content w-100">


                    <!-- SUCCESS -->

                    <?php if(isset($_SESSION['success'])) { ?>

                        <div class="alert alert-info alert-dismissible fade show">

                            <?php echo $_SESSION['success']; ?>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    <?php

                        unset($_SESSION['success']);

                    } ?>


                    <!-- ERROR -->

                    <?php if(isset($_SESSION['register_error'])) { ?>

                        <div class="alert alert-danger alert-dismissible fade show">

                            <?php echo $_SESSION['register_error']; ?>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    <?php

                        unset($_SESSION['register_error']);

                    } ?>



                    <!-- HEADING -->

                    <div class="text-center register-heading">

                        <h2 class="fw-bold">

                            Create Account

                        </h2>


                        <p>

                            Register your account

                        </p>

                    </div>



                    <!-- ================= FORM ================= -->

                    <form
                        action="../queries/query.php"
                        method="POST"
                    >


                        <!-- NAME -->

                        <div class="register-field">

                            <label class="form-label fw-semibold">

                                Name

                            </label>


                            <input
                                type="text"
                                name="uname"
                                class="form-control"
                                placeholder="Enter your name"
                                maxlength="100"
                            >

                        </div>



                        <!-- EMAIL -->

                        <div class="register-field">

                            <label class="form-label fw-semibold">

                                Email Address

                            </label>


                            <input
                                type="text"
                                name="uemail"
                                class="form-control"
                                placeholder="Enter your email"
                                maxlength="150"
                            >

                        </div>



                        <!-- PASSWORD -->

                        <div class="register-field">

                            <label class="form-label fw-semibold">

                                Password

                            </label>


                            <input
                                type="password"
                                name="upassword"
                                class="form-control"
                                placeholder="Enter your password"
                            >

                        </div>



                        <!-- CONFIRM PASSWORD -->

                        <div class="register-field">

                            <label class="form-label fw-semibold">

                                Confirm Password

                            </label>


                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                placeholder="Confirm your password"
                            >

                        </div>



                        <!-- REGISTER BUTTON -->

                        <div class="d-grid">


                            <button
                                type="submit"
                                class="btn register-submit fw-bold text-white"
                                name="user_register"
                            >

                                <i class="fa-solid fa-user-plus me-2"></i>

                                Create Account

                            </button>


                        </div>



                        <!-- LOGIN -->

                        <div class="text-center register-login">


                            <span>

                                Already have an account?

                            </span>


                            <a
                                href="login.php"
                                class="fw-bold text-decoration-none"
                            >

                                Login

                            </a>


                        </div>


                    </form>


                </div>

            </div>

        </div>

    </div>

</div>


</body>

</html>