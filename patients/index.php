<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/patient_header.php");


// Pagination

$page = 1;
$limit = 5;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$offset = ($page - 1) * $limit;

?>

<!-- PATIENTS PAGE -->

<div class="patients-page">

    <div class="container py-5">

        <!-- PAGE HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="page-title mb-1">
                    Patients
                </h2>

                <p class="page-subtitle mb-0">
                    Manage hospital patients and their information
                </p>

            </div>

            <a href="add.php" class="btn-add">
                <i class="fa-solid fa-user-plus me-2"></i>
                Add Patient
            </a>

        </div>


        <!-- SEARCH -->

        <div class="search-card mb-4">

            <form method="GET" action="">

                <div class="row g-3 align-items-center">

                    <div class="col-lg-9">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control search-input"
                                placeholder="Search patient by name, phone or email..."
                                value="<?php
                                if (isset($_GET['search'])) {
                                    echo $_GET['search'];
                                }
                                ?>"
                            >

                        </div>

                    </div>


                    <div class="col-lg-3 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn-search flex-fill"
                        >
                            <i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search
                        </button>

                        <a
                            href="index.php"
                            class="btn-reset flex-fill text-center"
                        >
                            <i class="fa-solid fa-rotate-left me-1"></i>
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        <!-- SESSION MESSAGE -->

        <div class="container-fluid mt-5">

            <?php if (isset($_SESSION['success'])) { ?>

                <div class="alert alert-info alert-dismissible fade show">

                    <?php echo $_SESSION['success']; ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            <?php } ?>

            <?php unset($_SESSION['success']); ?>

        </div>


        <!-- PATIENTS TABLE -->

        <div class="patients-card">

            <!-- CARD HEADER -->

            <div class="patients-header">

                <div>

                    <h3 class="mb-1">
                        Patient List
                    </h3>

                    <small>
                        All registered patients
                    </small>

                </div>

            </div>


            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>Patient</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Blood Group</th>
                            <th>DOB</th>
                            <th>Address</th>
                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        $totalpages = 0;


                        /* SEARCH */

                        if (isset($_GET['search'])) {

                            $search = $_GET['search'];

                            $sql = "SELECT * FROM patients
                                    WHERE name LIKE ?
                                    OR address LIKE ?
                                    OR email LIKE ?";

                            $stmt = mysqli_prepare($conn, $sql);

                            $searchs = "%" . $search . "%";

                            mysqli_stmt_bind_param(
                                $stmt,
                                "sss",
                                $searchs,
                                $searchs,
                                $searchs
                            );

                            mysqli_stmt_execute($stmt);

                            $result = mysqli_stmt_get_result($stmt);


                        } else {


                            /* PAGINATION QUERY */

                            $sql = "SELECT * FROM patients
                                    LIMIT $offset,$limit";

                            $newsql = "SELECT COUNT(*) AS total
                                       FROM patients";

                            $newresult = mysqli_query($conn, $newsql);

                            $newassoc = mysqli_fetch_array($newresult);

                            $preresult = $newassoc['total'];

                            $totalpages = ceil($preresult / $limit);

                            $result = mysqli_query($conn, $sql);

                        }


                        /* SHOW PATIENTS */

                        if (mysqli_num_rows($result) > 0) {

                            while ($show = mysqli_fetch_array($result)) {

                        ?>

                                <tr>

                                    <td>
                                        <?php echo $show['id']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['name']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['email']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['phone']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['gender']; ?>
                                    </td>
                                     <td>
                                        <?php echo $show['blood_group']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['date_of_birth']; ?>
                                    </td>

                                    <td>
                                        <?php echo $show['address']; ?>
                                    </td>

                                    <td>

                                        <a
                                            href="edit.php?id=<?php echo $show['id']; ?>"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        |

                                        <a
                                            href="/hospital/queries/query.php?patient_delete=<?php echo $show['id']; ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>

                                    </td>

                                </tr>

                        <?php

                            }

                        } else {

                        ?>

                            <tr>

                                <td
                                    class="text-danger text-center"
                                    colspan="8">
                                    "No Data Found"
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->

            <ul class="pagination justify-content-center mt-5">

                <?php if ($page > 1) { ?>

                    <li class="page-item">

                        <a
                            class="page-link"
                            href="index.php?page=<?php echo $page - 1; ?>">
                            Previous
                        </a>

                    </li>

                <?php } ?>


                <?php for ($i = 1; $i <= $totalpages; $i++) { ?>

                    <li class="page-item
                        <?php
                        if ($page == $i) {
                            echo "active";
                        }
                        ?>">

                        <a
                            class="page-link"
                            href="index.php?page=<?php echo $i; ?>">

                            <?php echo $i; ?>

                        </a>

                    </li>

                <?php } ?>


                <?php if ($page < $totalpages) { ?>

                    <li class="page-item">

                        <a
                            class="page-link"
                            href="index.php?page=<?php echo $page + 1; ?>">
                            Next
                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>