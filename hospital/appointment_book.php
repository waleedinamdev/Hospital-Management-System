<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/index_header.php");
include_once("../includes/navbar/index_navbar.php");




$doctor_query = "SELECT id, name, specialization FROM doctors ORDER BY name ASC";

$doctor_result = mysqli_query($conn, $doctor_query);

?>


<style>


    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:Arial,sans-serif;
        background:#f6fbfc;
        color:#183b4a;
    }


    .appointment-container{
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:30px 20px;
    }


    .appointment-card{
        width:100%;
        max-width:850px;

        background:#ffffff;

        border:1px solid #dce7e9;

        border-radius:10px;

        box-shadow:0 6px 25px rgba(0,0,0,.08);

        overflow:hidden;
    }


    .appointment-header{
        background:#e9f9fa;

        padding:20px 25px;

        display:flex;
        align-items:center;

        gap:15px;

        border-bottom:1px solid #e9f9fa;
    }


    .appointment-icon{
        width:48px;
        height:48px;

        flex-shrink:0;

        border-radius:50%;

        background:#ffffff;

        color:#066B76;

        display:flex;
        align-items:center;
        justify-content:center;

        font-size:21px;
    }


    .appointment-header-content h1{
        font-size:22px;

        color:#066B76;

        margin-bottom:3px;

        font-weight:600;
    }


    .appointment-header-content p{
        font-size:13px;

        color:#52717a;

        margin:0;
    }



    .alert{
        margin:18px 25px 0;

        padding:11px 14px;

        border-radius:6px;

        font-size:13px;

        position:relative;
    }


    .appointment-form{
        padding:22px 25px 25px;
    }


    .form-row{
        display:grid;

        grid-template-columns:1fr 1fr;

        gap:18px;

        margin-bottom:15px;
    }


    .form-group{
        margin-bottom:0;
    }




    label{
        display:block;

        margin-bottom:6px;

        font-size:14px;

        font-weight:600;

        color:#36525b;
    }


    .required{
        color:#c0392b;
    }


    

    .form-control{
        width:100%;

        height:40px;

        padding:7px 11px;

        border:1px solid #d5e3e6;

        border-radius:6px;

        outline:none;

        font-size:14px;

        color:#183b4a;

        background:#ffffff;

        transition:all .2s ease;
    }


    .form-control::placeholder{
        color:#8a9ba0;

        font-size:13px;
    }


    .form-control:focus{
        border-color:#066B76;

        box-shadow:0 0 0 2px rgba(6,107,118,.10);
    }


    select.form-control{
        cursor:pointer;
    }



    textarea.form-control{
        height:75px;

        padding:9px 11px;

        resize:none;
    }



    .full-width{
        margin-bottom:15px;
    }


    .section-title{
        display:flex;

        align-items:center;

        gap:8px;

        margin:4px 0 15px;

        color:#066B76;

        font-size:16px;

        font-weight:600;
    }


    .section-title i{
        font-size:15px;
    }

    .appointment-info{
        margin-top:3px;

        margin-bottom:15px;

        padding:10px 12px;

        border-radius:6px;

        background:#dce7e9;

        border:1px solid #cbdcde;

        color:#52717a;

        font-size:12px;
    }


    .appointment-info i{
        color:#066B76;
    }


    .appointment-info strong{
        color:#066B76;
    }



    .button-row{
        display:flex;

        gap:10px;

        align-items:center;
    }


    .book-btn{
        height:40px;

        padding:0 20px;

        border:none;

        border-radius:6px;

        background:#066B76;

        color:white;

        font-size:14px;

        font-weight:600;

        cursor:pointer;

        transition:background .2s ease;
    }


    .book-btn:hover{
        background:#04545d;
    }


    .back-btn{
        display:inline-flex;

        align-items:center;

        justify-content:center;

        height:40px;

        padding:0 18px;

        border-radius:6px;

        border:1px solid #cbdcde;

        background:#ffffff;

        color:#066B76;

        text-decoration:none;

        font-size:14px;

        transition:all .2s ease;
    }


    .back-btn:hover{
        background:#dce7e9;

        color:#066B76;
    }


   

    @media(max-width:700px){

        .appointment-container{
            padding:20px 12px;
        }


        .appointment-card{
            max-width:100%;
        }


        .appointment-header{
            padding:18px;
        }


        .appointment-form{
            padding:20px 18px;
        }


        .alert{
            margin-left:18px;
            margin-right:18px;
        }


        .form-row{
            grid-template-columns:1fr;

            gap:15px;

            margin-bottom:15px;
        }


        .appointment-header-content h1{
            font-size:20px;
        }


        .button-row{
            flex-direction:column;

            align-items:stretch;
        }


        .book-btn,
        .back-btn{
            width:100%;
        }

    }

</style>


<div class="appointment-container">

    <div class="appointment-card">


       

        <div class="appointment-header">

            <div class="appointment-icon">

                <i class="bi bi-calendar-plus"></i>

            </div>


            <div class="appointment-header-content">

                <h1>
                    Book Appointment
                </h1>

                <p>
                    Enter your information and appointment details.
                </p>

            </div>

        </div>



        <?php if(isset($_SESSION['appointment_success'])){ ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?php

            echo $_SESSION['appointment_success'];

            unset($_SESSION['appointment_success']);

            ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

        <?php } ?>



        <?php if(isset($_SESSION['appointment_error'])){ ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <?php echo $_SESSION['appointment_error']; ?>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        <?php

            unset($_SESSION['appointment_error']);

        }

        ?>



        <div class="appointment-form">

            <form
                method="POST"
                action="../queries/query.php"
            >



                <div class="section-title">

                    <i class="bi bi-person"></i>

                    Patient Information

                </div>


                <!-- NAME + EMAIL -->

                <div class="form-row">

                    <div class="form-group">

                        <label>

                            Your Name
                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="patient_name"
                            class="form-control"
                            placeholder="Enter your full name"
                        >

                    </div>


                    <div class="form-group">

                        <label>

                            Email
                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email"
                        >

                    </div>

                </div>


                <!-- PHONE + GENDER -->

                <div class="form-row">

                    <div class="form-group">

                        <label>

                            Phone
                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Enter phone number"
                        >

                    </div>


                    <div class="form-group">

                        <label>

                            Gender
                            <span class="required">*</span>

                        </label>

                        <select
                            name="gender"
                            class="form-control"
                        >

                            <option value="">
                                Select Gender 
                            </option>

                            <option value="Male">
                                Male
                            </option>

                            <option value="Female">
                                Female
                            </option>

                        </select>

                    </div>

                </div>


                <!-- DOB + DOCTOR -->

                <div class="form-row">

                    <div class="form-group">

                        <label>

                            Date of Birth
                            <span class="required">*</span>

                        </label>

                        <input
                            type="date"
                            name="date_of_birth"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>

                            Select Doctor
                            <span class="required">*</span>

                        </label>

                        <select
                            name="doctor_id"
                            class="form-control"
                        >

                            <option value="">
                                 Select Doctor 
                            </option>

                            <?php

                            if(mysqli_num_rows($doctor_result) > 0){

                                while($doctor = mysqli_fetch_assoc($doctor_result)){

                            ?>

                                <option value="<?php echo $doctor['id']; ?>">

                                    Dr. <?php echo $doctor['name']; ?>

                                    -

                                    <?php echo $doctor['specialization']; ?>

                                </option>

                            <?php

                                }

                            }
                            else{

                            ?>

                                <option value="">

                                    No doctors available

                                </option>

                            <?php

                            }

                            ?>

                        </select>

                    </div>

                </div>


                <!-- ADDRESS and blood-group -->

                <div class="form-row">

                 <div class="form-group">
                    <label>
                        Address
                        <span class="required">*</span>
                    </label>

                    <textarea
                        name="address"
                        class="form-control"
                        placeholder="Enter your address"
                    ></textarea>
                    </div>
                    <div class="form-group">
                                <label>
                                Blood Group
                                <span class="required">*</span>
                                </label>

                                <select
                                    name="blood_group"
                                     class="form-control"
                                    
                                >

                                    <option value="">
                                        Select Blood Group
                                    </option>

                                    <option value="A+">
                                        A+
                                    </option>

                                    <option value="B+">
                                        B+
                                    </option>

                                    <option value="AB+">
                                        AB+
                                    </option>

                                    <option value="AB-">
                                        AB-
                                    </option>

                                    <option value="O+">
                                        O+
                                    </option>

                                    <option value="O-">
                                        O-
                                    </option>

                                

                                </select>
                    </div>

                </div>


                <!-- =================================
                     APPOINTMENT INFORMATION
                ================================== -->

                <div class="section-title">

                    <i class="bi bi-calendar-check"></i>

                    Appointment Information

                </div>


                <!-- DATE + TIME -->

                <div class="form-row">

                    <div class="form-group">

                        <label>

                            Appointment Date
                            <span class="required">*</span>

                        </label>

                        <input
                            type="date"
                            name="appointment_date"
                            class="form-control"
                            min="<?php echo date('Y-m-d'); ?>"
                        >

                    </div>


                    <div class="form-group">

                        <label>

                            Appointment Time
                            <span class="required">*</span>

                        </label>

                        <input
                            type="time"
                            name="appointment_time"
                            class="form-control"
                        >

                    </div>

                </div>


                <!-- REASON -->

                <div class="full-width">

                    <label>

                        Reason for Appointment
                        <span class="required">*</span>

                    </label>

                    <textarea
                        name="reason"
                        class="form-control"
                        placeholder="Enter reason for your appointment..."
                    ></textarea>

                </div>


                <!-- =================================
                     INFORMATION BOX
                ================================== -->

                <div class="appointment-info">

                    <i class="bi bi-info-circle"></i>

                    Your appointment will remain

                    <strong>Pending</strong>

                    until the administrator approves it.

                </div>


                <!-- =================================
                     BUTTONS
                ================================== -->

                <div class="button-row">

                    <button
                        type="submit"
                        name="book_appointment"
                        class="book-btn"
                    >

                        <i class="bi bi-calendar-check"></i>

                        Book Appointment

                    </button>


                    <a
                        href="./index.php"
                        class="back-btn"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Back to Home

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>




<?php

include_once("../includes/footer/footer.php");

?>