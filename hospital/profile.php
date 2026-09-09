<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/index_header.php");
include_once("../includes/navbar/index_navbar.php");



$user_id = $_SESSION['user_id'];

if (!$user_id) {
    header("Location: ../auth/login.php");
    exit();
}



$query = "SELECT id, name, email, role, profile_image, status FROM users WHERE id = ? AND status = 1";
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die("Database query failed.");
}
mysqli_stmt_bind_param( $stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);



if (!$user) {

    session_destroy();

    header("Location: ../auth/login.php");

    exit();
}

?>



    <style>
        body {

            background: #f5fbfc;

        }

        .profile-section {

            min-height: calc(100vh - 100px);

            padding: 60px 20px;

        }

        .profile-container {

            max-width: 850px;

            margin: 0 auto;

        }



        .profile-heading {

            text-align: center;

            margin-bottom: 35px;

        }


        .profile-heading h2 {

            color: #183b4a;

            font-size: 32px;

            font-weight: 700;

            margin-bottom: 8px;

        }


        .profile-heading p {

            color: #6c757d;

            margin: 0;

            font-size: 15px;

        }




        .profile-card {

            background: #ffffff;

            border-radius: 20px;

            padding: 40px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.08);

        }



        .profile-image-area {

            text-align: center;

            margin-bottom: 25px;

        }


        .profile-image {

            width: 120px;

            height: 120px;

            border-radius: 50%;

            object-fit: cover;

            border: 5px solid #e9f9fa;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.08);

        }


        .default-profile {

            width: 120px;

            height: 120px;

            border-radius: 50%;

            background: #e9f9fa;

            color: #087f8c;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            font-size: 55px;

            border: 5px solid #e9f9fa;

        }




        .profile-name {

            text-align: center;

            color: #183b4a;

            font-size: 27px;

            font-weight: 700;

            margin-bottom: 6px;

        }


        .profile-email {

            text-align: center;

            color: #6c757d;

            margin-bottom: 35px;

        }


        .info-box {

            background: #f8fcfd;

            border: 1px solid #e3f1f3;

            border-radius: 12px;

            padding: 20px;

            height: 100%;

            transition: 0.3s;

        }


        .info-box:hover {

            transform: translateY(-2px);

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.05);

        }



        .info-label {

            display: block;

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 8px;

        }


    

        .info-value {

            color: #183b4a;

            font-size: 17px;

            font-weight: 600;

            word-break: break-word;

        }


        .role-badge {

            display: inline-block;

            background: #e9f9fa;

            color: #087f8c;

            padding: 6px 16px;

            border-radius: 20px;

            font-size: 14px;

            font-weight: 600;

            text-transform: capitalize;

        }


  

        .change-password-btn {

            display: inline-block;

            background: #087f8c;

            color: #ffffff;

            text-decoration: none;

            border: none;

            border-radius: 10px;

            padding: 12px 25px;

            font-weight: 600;

            transition: 0.3s;

        }


        .change-password-btn:hover {

            background: #066c77;

            color: #ffffff;

            transform: translateY(-2px);

        }


   

        @media (max-width: 768px) {

            .profile-section {

                padding: 35px 15px;

            }


            .profile-card {

                padding: 25px 20px;

            }


            .profile-heading h2 {

                font-size: 27px;

            }


            .profile-name {

                font-size: 24px;

            }

        }

    </style>





<section class="profile-section">

    <div class="container profile-container">



        <div class="profile-heading">

            <h2>
                My Profile
            </h2>

            <p>
                View your personal account information
            </p>

        </div>




        <div class="profile-card">



            <div class="profile-image-area">


                <?php if (!empty($user['profile_image'])): ?>

                    <img
                        src="../uploads/<?php echo ($user['profile_image']); ?>"
                        alt="Profile Image"
                        class="profile-image"
                    >

                <?php else: ?>

                    <div class="default-profile">

                        <i class="fa-solid fa-user"></i>

                    </div>

                <?php endif; ?>


            </div>


            <!-- =================================================
                 USER NAME
            ================================================= -->

            <h3 class="profile-name">

                <?php
                echo ($user['name']);
                ?>

            </h3>


    

            <p class="profile-email">

                <?php
                echo ($user['email']);
                ?>

            </p>



            <div class="row g-3">


           

                <div class="col-md-6">

                    <div class="info-box">

                        <span class="info-label">

                            Full Name

                        </span>


                        <span class="info-value">

                            <?php
                            echo ($user['name']);
                            ?>

                        </span>

                    </div>

                </div>


          

                <div class="col-md-6">

                    <div class="info-box">

                        <span class="info-label">

                            Email Address

                        </span>


                        <span class="info-value">

                            <?php
                            echo ($user['email']);
                            ?>

                        </span>

                    </div>

                </div>


            

                <div class="col-md-6">

                    <div class="info-box">

                        <span class="info-label">

                            Account Type

                        </span>


                        <span class="role-badge">

                            <?php
                            echo ($user['role']);
                            ?>

                        </span>

                    </div>

                </div>


            </div>


            

        </div>


    </div>

</section>


</body>

</html>