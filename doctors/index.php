<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/doctor_header.php");


///Pagination///

$page=1;
$limit=5;
if(isset($_GET['page'])){
$page=(int)$_GET['page'];
}
$offset=($page-1)*$limit;
?>



<body>
<div class="container py-5">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="page-title mb-1">
                Doctors
            </h2>

            <p class="page-subtitle mb-0">
                Manage hospital doctors
            </p>

        </div>

        <a href="/hospital/doctors/add.php" class="btn btn-add">
            <i class="fa-solid fa-plus"></i>
            Add Doctor
        </a>

    </div>


    <!-- Search -->

    <div class="search-card mb-4">

        <form method="GET">

            <div class="row g-2">

                <div class="col-md-6">

                    <div class="input-group">

                        

                        <input
                            type="text"
                            name="search"
                            class="form-control search-input"
                            placeholder="Search doctor..."
                             value="<?php if(isset($_GET['search'])){
                                $search=$_GET['search'];
                                echo $search;
                                 
                            } ?>"
                        >

                    </div>

                </div>

                <div class="col-auto">

                    <button
                        type="submit"
                        class="btn btn-search"
                    >
                        Search
                    </button>

                </div>

                <div class="col-auto">

                    <a
                        href="index.php"
                        class="btn btn-reset"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>

 <!--------------SESSION start--->
        <div class="container-fluid mt-5">
                        <?php if(isset($_SESSION['success'])){?>
                        <div class="alert alert-info alert-dismissible fade show">
                            <?php echo $_SESSION['success'] ;?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php }unset($_SESSION['success'])?>
        </div>



    <!-- Doctors Table -->

    <div class="card doctors-card">

        <div class="card-header doctors-header">

            <h3 class="mb-0">
                Doctors Record
            </h3>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle text-center mb-0">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Doctor</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Specialization</th>

                            <th>Qualification</th>

                              <!-- <th>Gender</th> -->
                        
                              <!-- <th>image</th> -->


                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>
                        <?php
                       $totalpages=0;
                        if (isset($_GET['search']) ) {
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM doctors WHERE name LIKE ? OR specialization LIKE ? OR email LIKE ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            $searchs = "%" . $search . "%";
                            mysqli_stmt_bind_param($stmt,"sss",$searchs,$searchs, $searchs);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                        } else {

                            $sql="SELECT * from doctors limit $offset,$limit";
                                $newsql="SELECT count(*) as total from doctors";
                                $newresult=mysqli_query($conn ,$newsql);
                                $newassoc=mysqli_fetch_array($newresult);
                                $preresult=$newassoc['total'];
                                $totalpages=ceil($preresult / $limit);
                                $result=mysqli_query($conn ,$sql);
                        }

                        if (mysqli_num_rows($result) > 0) {

                            while ($show = mysqli_fetch_array($result)) {

                        ?>
                         <tr>
                            <td><?php echo $show['id'] ?></td>
                            <td><?php echo $show['name'] ?></td>
                            <td><?php echo $show['email'] ?></td>
                            <td><?php echo $show['phone'] ?></td>
                            <td><?php echo $show['specialization'] ?></td>
                            <td><?php echo $show['qualification'] ?></td>
                            <!-- <td><?php echo $show['gender'] ?></td> -->
                            <!-- <td>
                            <img src="../uploads/images/<?php echo $show['profile_image']; ?>" height="50px" width="60px" class='img-fluid'>
                            </td>  -->
                            <td><?php echo $show['status'] ?></td>
                             <td>
                                <a href="edit.php?id=<?php echo $show['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen-to-square"></i></a> |
                                <a href="/hospital/queries/query.php?doctor_delete=<?php echo $show['id'] ?> " class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fa-solid fa-trash-can"></i></a>
                             </td> 
                         </tr>   
                        <?php
                            }
                        }else{

                        ?>
                        <tr><td class="text-danger text-center" colspan="6">"No Data Found"</td></tr>

                        
                        <?php } ?> 
                        


                        




                   

                    </tbody>

                </table>

                <!--- Pagination----->
                <ul class="pagination justify-content-center mt-5">
                    <?php
                    if($page>1){
                    ?>
                      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $page - 1; ?>"> <i class="fa-solid fa-circle-chevron-left"></i></a></li>
                    <?php } ?>

                    <?php for($i=1; $i<=$totalpages; $i++) { 
                    ?>
                    <li class="page-item <?php if($page==$i){echo "active";}  ?>">
                    <a class="page-link <?php if($page==$i){ echo "bg-success text-white border-light"; } ?> " href="index.php?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                    <?php } ?>

                    <?php
                    if($page<$totalpages){
                    ?>
                    <li class="page-item">
                    <a class="page-link " href="index.php?page=<?php echo $page + 1; ?>"> <i class="fa-solid fa-circle-chevron-right"></i></a></li>
                    <?php } ?>
                 </ul>

            </div>

        </div>


    </div>

</div>

<?php

include_once("../includes/footer/footer.php");

?>