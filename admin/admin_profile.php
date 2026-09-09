<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");


// GET USER ID

$user_id = $_SESSION['user_id'];


// GET ADMIN DATA

$sql = "SELECT * FROM users WHERE id = '$user_id'";

$result = mysqli_query($conn, $sql);

$admin = mysqli_fetch_assoc($result);


// PROFILE IMAGE

if ($admin['profile_image'] != "") {

    $profileImage = "../uploads/admin/" . $admin['profile_image'];

} else {

    $profileImage = "";

}

?>

<style>

    body {
        background: #f6fbfc;
        color: #183b4a;
    }

    .profile-page {
        margin-left: 250px;
        padding: 30px;
        min-height: 100vh;
    }

    .profile-title h1 {
        color: #087f8c;
        font-size: 26px;
        margin-bottom: 5px;
    }

    .profile-title p {
        color: #81939a;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .profile-card {
        width: 100%;
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .profile-header {
        background:#e9f9fa;
        color: #183b4a;
        padding: 30px;
        border-bottom: 1px solid #cbdcdf;
    }

    .profile-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
    }

    .default-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
        color: #087f8c;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }

    .profile-header h4 {
        color: #183b4a;
        font-size: 22px;
    }

    .profile-header p {
        color: #5f747c;
        font-size: 14px;
    }

    .profile-header small {
        color: #087f8c;
        font-weight: 600;
    }

    .profile-body {
        padding: 35px;
    }

    .profile-body h5 {
        color: #087f8c;
        font-size: 20px;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
        color: #183b4a;
    }

    .form-control {
        height: 45px;
        border: 1px solid #d7e5e8;
        border-radius: 7px;
    }

    .form-control:focus {
        border-color: #087f8c;
        box-shadow: 0 0 0 0.2rem rgba(8, 127, 140, 0.15);
    }

    .save-btn {
        background: #087f8c;
        color: white;
        border: none;
        height: 45px;
        border-radius: 7px;
        font-weight: 600;
    }

    .save-btn:hover {
        background: #066b76;
        color: white;
    }

    @media(max-width: 768px) {

        .profile-page {
            margin-left: 0;
            padding: 15px;
        }

        .profile-header {
            text-align: center;
        }

        .profile-body {
            padding: 20px;
        }

    }

</style>

</head>

<body>

<div class="profile-page">



    <!-- SUCCESS MESSAGE -->

    <?php if (isset($_SESSION['profile_success'])) { ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?php echo $_SESSION['profile_success']; ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php unset($_SESSION['profile_success']); } ?>


    <!-- ERROR MESSAGE -->

    <?php if (isset($_SESSION['profile_error'])) { ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?php echo $_SESSION['profile_error']; ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php unset($_SESSION['profile_error']); } ?>


    <!-- PROFILE CARD -->

    <div class="card profile-card">

        <!-- PROFILE HEADER -->

        <div class="profile-header d-flex align-items-center gap-4">

            <?php if ($profileImage != "") { ?>

                <img
                    src="<?php echo $profileImage; ?>"
                    class="profile-image"
                    alt="Admin Profile">

            <?php } else { ?>

                <div class="default-avatar">

                    <i class="bi bi-person"></i>

                </div>

            <?php } ?>


            <div>

                <h4 class="mb-1">
                    <?php echo $admin['name']; ?>
                </h4>

                <p class="mb-2">
                    <?php echo $admin['email']; ?>
                </p>

                <small>
                    Administrator
                </small>

            </div>

        </div>


        <!-- EDIT PROFILE -->

        <div class="profile-body">

            <h5>
                <i class="bi bi-pencil-square"></i>
                Edit Profile
            </h5>


            <form
                action="../queries/query.php"
                method="POST"
                enctype="multipart/form-data">


                <!-- NAME -->

                <div class="mb-4">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo $admin['name']; ?>">

                </div>


                <!-- EMAIL -->

                <div class="mb-4">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?php echo $admin['email']; ?>">

                </div>


                <!-- IMAGE -->

                <div class="mb-4">

                    <label class="form-label">
                        Profile Image
                    </label>

                    <input
                        type="file"
                        name="profile_image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                </div>


                <!-- SAVE -->

                <button
                    type="submit"
                    name="update_profile"
                    class="btn save-btn w-100">

                    <i class="bi bi-check-circle"></i>
                    Save Profile

                </button>

            </form>

        </div>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>

</body>

</html>