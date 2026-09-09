
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hospital / Clinic Management System</title>

 <!--Font awesome link---->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

section {
    scroll-margin-top: 90px;
}

body {
    font-family: Arial, sans-serif;
    background: #f7fbfc;
    color: #183b4a;
}


/* ================= NAVBAR ================= */

.navbar {
    width: 100%;
    min-height: 75px;
    padding: 0 7%;

    display: flex;
    align-items: center;
    justify-content: space-between;

    background: white;

    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);

    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #087f8c;
}

.logo span {
    margin-left: 5px;
}

.navbar nav {
    display: flex;
    gap: 30px;
}

.navbar nav a {
    text-decoration: none;
    color: #183b4a;
    font-weight: 600;
    transition: 0.3s;
}

.navbar nav a:hover {
    color: #087f8c;
}

.nav-buttons {
    display: flex;
    gap: 10px;
}
.login-btn,
.register-btn {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
}

.login-btn.active {
    color: white;
    background: #087f8c;
    border: 2px solid #087f8c;
}


.login-btn ,.register-btn  {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
    color: #087f8c;
    border: 2px solid #087f8c;
    transition: 0.3s;
}

.login-btn:hover {
    color: #087f8c;
    background: white;
}
.register-btn:hover {
    color: white;
    background: #087f8c;
}
/* ================= HERO ================= */

.hero {
    min-height: 600px;
    padding: 70px 7%;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 50px;

    background: linear-gradient(
        135deg,
        #e9f9fa,
        #ffffff
    );
}

.hero-content {
    flex: 1;
}

.hero-content h1 {
    font-size: 52px;
    line-height: 1.15;
    margin-bottom: 25px;
}

.hero-content h1 span {
    display: block;
    color: #087f8c;
}

.hero-content p {
    font-size: 18px;
    line-height: 1.7;
    max-width: 600px;
    color: #55717c;
}

.hero-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.primary-btn,
.secondary-btn {
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 30px;
    font-weight: bold;
}

.primary-btn {
    background: #087f8c;
    color: white;
}

.secondary-btn {
    border: 2px solid #087f8c;
    color: #087f8c;
}

.hero-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}


/* ================= COMMON HEADING ================= */

.section-heading1 {
    text-align: center;
    max-width: 700px;
    margin: auto;
}

.section-heading1 h2 {
    font-size: 36px;
    margin-bottom: 15px;
    color: #183b4a;
}

.section-heading1 p {
    color: #6b8087;
    line-height: 1.6;
}


/* ================= ABOUT ================= */

.about {
    padding: 90px 7%;
    background: white;
}

.about-container {
    margin-top: 50px;

    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}

.about-box {
    flex: 1;
    min-width: 250px;
    max-width: 350px;

    padding: 35px 25px;

    text-align: center;

    border-radius: 15px;

    background: #f7fbfc;

    transition: 0.3s;
    border: 1px solid #f7fbfc;
}

.about-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    background: #E9F9FA;
    border: 1px solid #087F8C;
}

.icon {
    font-size: 30px;
    margin-bottom: 15px;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    border: 2px solid #087f8c ;
    padding: 5px;
    margin: 0 auto 15px auto;
    background-color: #087F8C;
    color: white;
}

.about-box h3 {
    margin-bottom: 12px;
}

.about-box p {
    color: #6b8087;
    line-height: 1.6;
}


/* ================= SERVICES ================= */

.services {
    padding: 90px 7%;
    background-color:#087F8C;
}
.section-heading {
    text-align: center;
    max-width: 700px;
    margin: auto;
}

.section-heading h2 {
    font-size: 36px;
    margin-bottom: 15px;
    color: white;
}

.section-heading p {
    color: white;
    line-height: 1.6;
}
.service-container {
    margin-top: 50px;

    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    justify-content: center;
}

.service-card {
    flex: 1;
    min-width: 220px;
    max-width: 280px;

    padding: 35px 25px;

    background: white;

    border-radius: 15px;

    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);

    text-align: center;

    transition: 0.3s;
}

.service-card:hover {
    transform: translateY(-10px);
    background-color: #E9F9FA;

}

.service-icon {
    font-size: 45px;
    margin-bottom: 20px;
}

.service-card h3 {
    margin-bottom: 12px;
}

.service-card p {
    color: #6b8087;
    line-height: 1.6;
}
/* ================= APPOINTMENTS ================= */

.appointment {
    padding: 10px 7% 100px 7% ;
    /* padding: 60px 7% 60px 10%; */
    background: white;
}

.appointment-container {

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 60px;
}


/* LEFT SIDE */

.appointment-info {
    flex: 1;
}

.appointment-info h2 {
    font-size: 35px;
    margin-bottom: 18px;
    color: #183b4a;
}

.appointment-info > p {
    color: #6b8087;
    line-height: 1.7;
    max-width: 600px;
}


.appointment-points {
    margin-top: 30px;

    display: flex;
    flex-direction: column;
    gap: 20px;
}

.appointment-point {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.appointment-point span {
    width: 35px;
    height: 35px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #087f8c;
    color: white;

    font-weight: bold;
}

.appointment-point h3 {
    margin-bottom: 5px;
    color: #183b4a;
}

.appointment-point p {
    color: #6b8087;
}


/* RIGHT CARD */

.appointment-box {
    flex: 0 0 380px;

    padding: 45px 35px;

    text-align: center;

    background: #e9f9fa;

    border-radius: 20px;

    border: 1px solid #cceff1;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);

    transition: 0.3s all;
}

.appointment-icon {
    width: 75px;
    height: 75px;

    margin: 0 auto 20px auto;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #087f8c;
    color: white;

    font-size: 35px;
}

.appointment-box h2 {
    color: #183b4a;
    margin-bottom: 15px;
}

.appointment-box p {
    color: #6b8087;
    line-height: 1.7;
    margin-bottom: 25px;
}

.appointment-btn {
    display: inline-block;

    padding: 13px 25px;

    text-decoration: none;

    background: #087f8c;
    color: white;

    border-radius: 8px;

    font-weight: bold;

    transition: 0.3s;
}

.appointment-box:hover {
    transform: translateY(-8px);
}

/* ================= RESPONSIVE ================= */

@media (max-width: 900px) {

    .appointment-container {
        flex-direction: column;
    }

    .appointment-box {
        width: 100%;
        max-width: 450px;
    }

}

/* ================= WHY US ================= */

.why-us {
    padding: 80px 7%;

    background: #e9f9fa;

    display: flex;
    align-items: center;
    gap: 60px;
}

.why-content {
    flex: 1;
}

.why-content h2 {
    font-size: 35px;
    margin-bottom: 20px;
}

.why-content p {
    color: #607980;
    line-height: 1.7;
}

.features {
    flex: 1;

    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.feature {
    flex: 1;
    min-width: 200px;

    background: white;
    padding: 25px;

    border-radius: 12px;

}

.feature span {
    font-size: 25px;
    color: #087f8c;
}

.feature h3 {
    margin: 10px 0;
}

.feature p {
    color: #6b8087;
}

/* ================= CONTACT US ================= */

.contact-section {
    padding: 90px 7%;
    background: #f7fbfc;
}

.contact-heading {
    margin-bottom: 50px;
}

.contact-heading h2 {
    color: #183b4a;
}

.contact-heading p {
    color: #6b8087;
}


/* CONTACT CONTAINER */

.contact-container {
    max-width: 1100px;
    margin: auto;

    display: flex;
    gap: 40px;
    align-items: stretch;
}


/* ================= CONTACT INFO ================= */

.contact-info {
    flex: 1;

    padding: 40px;

    background: #087f8c;
    color: white;

    border-radius: 18px;
}

.contact-info h2 {
    font-size: 30px;
    margin-bottom: 15px;
}

.contact-info > p {
    line-height: 1.7;
    margin-bottom: 30px;
    color: #e9f9fa;
}


/* CONTACT DETAILS */

.contact-detail {
    display: flex;
    align-items: center;
    gap: 15px;

    margin-bottom: 25px;
}

.contact-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    border-radius: 50%;

    background: white;
    color: #087f8c;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
}

.contact-detail h3 {
    font-size: 17px;
    margin-bottom: 5px;
}

.contact-detail p {
    margin: 0;
    color: #e9f9fa;
    font-size: 14px;
}


/* ================= CONTACT FORM ================= */

.contact-form {
    flex: 1;

    padding: 40px;

    background: white;

    border-radius: 18px;

    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.contact-form h2 {
    color: #183b4a;
    font-size: 30px;
    margin-bottom: 25px;
}


/* FORM ROW */

.form-row {
    display: flex;
    gap: 20px;
}

.form-row .form-group {
    flex: 1;
}


/* FORM GROUP */

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    font-weight: bold;
    color: #183b4a;
}


/* INPUT + TEXTAREA */

.form-group input,
.form-group textarea {

    width: 100%;

    padding: 13px 15px;

    border: 1px solid #d5e2e5;

    border-radius: 8px;

    outline: none;

    font-family: Arial, sans-serif;
    font-size: 15px;

    color: #183b4a;

    transition: 0.3s;

}

.form-group input:focus,
.form-group textarea:focus {

    border-color: #087f8c;

    box-shadow: 0 0 6px rgba(8, 127, 140, 0.15);

}

.form-group textarea {
    resize: vertical;
}


/* ================= CONTACT BUTTONS ================= */

.contact-buttons {
    display: flex;
    gap: 12px;
    margin-top: 5px;
}

.send-btn,
.clear-btn {

    padding: 13px 22px;

    border-radius: 8px;

    font-size: 15px;

    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;

}


/* SEND BUTTON */

.send-btn {

    border: 2px solid #087f8c;

    background: #087f8c;

    color: white;

}

.send-btn:hover {

    background: #066b76;

    border-color: #066b76;

}


/* CLEAR BUTTON */

.clear-btn {

    border: 2px solid #087f8c;

    background: white;

    color: #087f8c;

}

.clear-btn:hover {

    background: #087f8c;

    color: white;

}


/* ================= CONTACT RESPONSIVE ================= */

@media (max-width: 900px) {

    .contact-container {
        flex-direction: column;
    }

    .contact-info,
    .contact-form {
        width: 100%;
    }

}


@media (max-width: 600px) {

    .contact-section {
        padding: 60px 5%;
    }

    .contact-info,
    .contact-form {
        padding: 25px;
    }

    .form-row {
        flex-direction: column;
        gap: 0;
    }

    .contact-buttons {
        flex-direction: column;
    }

    .send-btn,
    .clear-btn {
        width: 100%;
    }

}

/* ================= CTA ================= */

.cta {
    padding: 80px 20px;

    text-align: center;

    background: #087f8c;
    color: white;
}

.cta h2 {
    font-size: 35px;
    margin-bottom: 15px;
}

.cta p {
    margin-bottom: 25px;
}

.cta .primary-btn {
    display: inline-block;
    background: white;
    color: #087f8c;
    transition: 0.3s all;
}
.cta .primary-btn:hover {
    background: #12323D;
    color: white;
}

/* ================= CONTACT US ================= */

.contact-section {
    padding: 90px 7%;
    background: #f7fbfc;
}

.contact-heading {
    margin-bottom: 50px;
}

.contact-heading h2 {
    color: #183b4a;
}

.contact-heading p {
    color: #6b8087;
}


/* CONTACT CONTAINER */

.contact-container {
    max-width: 1100px;
    margin: auto;

    display: flex;
    gap: 40px;
    align-items: stretch;
}


/* ================= CONTACT INFO ================= */

.contact-info {
    flex: 1;

    padding: 40px;

    background: #087f8c;
    color: white;

    border-radius: 18px;
}

.contact-info h2 {
    font-size: 30px;
    margin-bottom: 15px;
}

.contact-info > p {
    line-height: 1.7;
    margin-bottom: 30px;
    color: #e9f9fa;
}


/* CONTACT DETAILS */

.contact-detail {
    display: flex;
    align-items: center;
    gap: 15px;

    margin-bottom: 25px;
}

.contact-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    border-radius: 50%;

    background: white;
    color: #087f8c;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
}

.contact-detail h3 {
    font-size: 17px;
    margin-bottom: 5px;
}

.contact-detail p {
    margin: 0;
    color: #e9f9fa;
    font-size: 14px;
}


/* ================= CONTACT FORM ================= */

.contact-form {
    flex: 1.3;

    padding: 40px;

    background: white;

    border-radius: 18px;

    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.contact-form h2 {
    color: #183b4a;
    font-size: 30px;
    margin-bottom: 25px;
}


/* FORM ROW */

.form-row {
    display: flex;
    gap: 20px;
}

.form-row .form-group {
    flex: 1;
}


/* FORM GROUP */

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    font-weight: bold;
    color: #183b4a;
}


/* INPUT + TEXTAREA */

.form-group input,
.form-group textarea {

    width: 100%;

    padding: 13px 15px;

    border: 1px solid #d5e2e5;

    border-radius: 8px;

    outline: none;

    font-family: Arial, sans-serif;
    font-size: 15px;

    color: #183b4a;

    transition: 0.3s;

}

.form-group input:focus,
.form-group textarea:focus {

    border-color: #087f8c;

    box-shadow: 0 0 6px rgba(8, 127, 140, 0.15);

}

.form-group textarea {
    resize: vertical;
}

/* ================= FOOTER ================= */

footer {
    background: #0A2734;
    color: white;
}
.footer-container {
    padding: 60px 7%;

    display: flex;
    justify-content: space-between;
    gap: 40px;

    flex-wrap: wrap;
}

.footer-about,
.footer-links,
.footer-contact {
    flex: 1;
    min-width: 200px;
}

.footer-about h2 {
    margin-bottom: 15px;
}

.footer-about p {
    color: #b9cbd0;
    line-height: 1.7;
    padding-left: 20px;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-links h3,
.footer-contact h3 {
    margin-bottom: 10px;
}

.footer-links a {
    color: #b9cbd0;
    text-decoration: none;
}

.footer-links a:hover {
    color: white;
}

.footer-contact p {
    color: #b9cbd0;
    margin-bottom: 12px;
}

.copyright {
    padding: 20px;
    text-align: center;

    border-top: 1px solid #31505a;

    color: #b9cbd0;
}


/* ================= RESPONSIVE ================= */

@media (max-width: 900px) {

    .navbar {
        flex-wrap: wrap;
        gap: 15px;
        padding: 20px 5%;
    }

    .navbar nav {
        order: 3;
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero {
        flex-direction: column;
        text-align: center;
    }

    .hero-content p {
        margin: auto;
    }

    .hero-buttons {
        justify-content: center;
    }

    .why-us {
        flex-direction: column;
    }

}


@media (max-width: 600px) {

    .hero-content h1 {
        font-size: 38px;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .doctor-card {
        width: 280px;
        height: 280px;
    }

}



            
        </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->

<header class="navbar">

    <div class="logo">
         <span><img src="\hospital\assets\images\logo.png" alt="" height="90px" width="260px"></span>
    </div>

    <nav>
        
        <a href="#home">Home</a>
        <a href="#about">About Us</a>
        <a href="#services">Services</a>
        <a href="#appoinment">Appoinment</a>
        <a href="#contact">Contact</a>
    </nav>
    

    <div class="nav-buttons">
        <a href="/hospital/auth/login.php" class="login-btn active">Login</a>
        <a href="/hospital/auth/register.php" class="register-btn">Register</a>
    </div>

</header>


<!-- ================= HERO SECTION ================= -->

<section id="home" class="hero">

    <div class="hero-content">

        <h1>
            Hospital & Clinic
            <span>Management System</span>
        </h1>

        <p>
            Manage patients, doctors, appointments and medical
            records easily with our modern healthcare management system.
        </p>

        <div class="hero-buttons">

            <a href="auth/login.php" class="login-btn active ">
                Get Started
            </a>

            <a href="#services" class="register-btn">
                Explore Services
            </a>

        </div>

    </div>

    <div class="hero-image  ">
   
         <img src="\hospital\assets\images\hero.png"  alt="hero_section img" height="450px" width="650px" >
        
    </div>

</section>


<!-- ================= ABOUT SECTION ================= -->

<section id="about" class="about">

    <div class="section-heading1">
        <h2>About Our System</h2>

        <p>
            Our Hospital / Clinic Management System is designed
            to make healthcare management simple, organized and efficient.
        </p>
    </div>

    <div class="about-container">

        <div class="about-box">
            <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
            <h3>Doctor Management</h3>
            <p>
                Easily add, update, search and manage doctor information
                and specializations.
            </p>
        </div>

        <div class="about-box">
            <div class="icon"><i class="fa-solid fa-person-dots-from-line"></i></div>
            <h3>Patient Management</h3>
            <p>
                Store and manage patient information securely and efficiently.
            </p>
        </div>

        <div class="about-box">
            <div class="icon"><i class="fa-solid fa-file-medical"></i></div>
            <h3>Medical Records</h3>
            <p>
                Maintain complete patient medical history,
                diagnosis and prescriptions.
            </p>
        </div>

    </div>

</section>


<!-- ================= SERVICES SECTION ================= -->

<section id="services" class="services">

    <div class="section-heading">

        <h2>Our Services</h2>

        <p>
            Everything you need to manage your hospital or clinic.
        </p>

    </div>


    <div class="service-container">

        <div class="service-card">

            <div class="service-icon"><i class="fa-solid fa-hospital-user"></i></div>

            <h3>Patient Management</h3>

            <p>
                Add, view, edit, delete and search patient records.
            </p>

        </div>


        <div class="service-card">

            <div class="service-icon"><i class="fa-solid fa-user-nurse"></i></div>

            <h3>Doctor Management</h3>

            <p>
                Manage doctors, specializations and their information.
            </p>

        </div>


        <div class="service-card">

            <div class="service-icon"><i class="fa-solid fa-calendar-check"></i></div>

            <h3>Appointments</h3>

            <p>
                Schedule and manage appointments between patients and doctors.
            </p>

        </div>


        <div class="service-card">

            <div class="service-icon"><i class="fa-solid fa-file-medical"></i></div>

            <h3>Medical Records</h3>

            <p>
                Maintain diagnosis, symptoms, prescriptions and medical history.
            </p>

        </div>

    </div>

</section>

<!-- ================= APPOINTMENTS SECTION ================= -->

<section id="appoinment" class="appointment">

    <div class="section-heading">
        <h2>Book an Appointment</h2>

        <p>
            Schedule an appointment with your preferred doctor
            quickly and easily.
        </p>
    </div>

    <div class="appointment-container">

        <!-- LEFT SIDE -->

        <div class="appointment-info">

            <h2>Your Health, Our Priority</h2>

            <p>
                Our appointment system makes it easy for patients
                to choose a doctor, select a date and time, and
                book an appointment.
            </p>

            <div class="appointment-points">

                <div class="appointment-point">
                    <span>✓</span>
                    <div>
                        <h3>Choose Doctor</h3>
                        <p>Select a doctor according to your needs.</p>
                    </div>
                </div>

                <div class="appointment-point">
                    <span>✓</span>
                    <div>
                        <h3>Select Date & Time</h3>
                        <p>Choose a convenient appointment time.</p>
                    </div>
                </div>

                <div class="appointment-point">
                    <span>✓</span>
                    <div>
                        <h3>Book Appointment</h3>
                        <p>Enter your reason and confirm your booking.</p>
                    </div>
                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->

        <div class="appointment-box">

            <div class="appointment-icon">
                <i class="fa-solid fa-user-doctor"></i>
            </div>

            <h2>Need a Doctor?</h2>

            <p>
                Book your appointment today and get the care
                you need from our qualified doctors.
            </p>

            <a href="/hospital/auth/login.php" class="appointment-btn">
                Book Appointment
            </a>

        </div>

    </div>

</section>


<!-- ================= WHY CHOOSE US ================= -->

<section class="why-us">

    <div class="why-content">

        <h2>Why Choose Our System?</h2>

        <p>
            Our system provides an easy and organized way to manage
            daily hospital and clinic activities.
        </p>

    </div>


    <div class="features">

        <div class="feature">
            <span>💡</span>
            <h3>Easy to Use</h3>
            <p>Simple and user-friendly interface.</p>
        </div>

        <div class="feature">
            <span>🔒</span>
            <h3>Secure</h3>
            <p>Patient and medical data is managed securely.</p>
        </div>

        <div class="feature">
            <span>📁</span>
            <h3>Organized</h3>
            <p>All hospital records are organized in one place.</p>
        </div>

        <div class="feature">
            <span>⚡</span>
            <h3>Efficient</h3>
            <p>Save time while managing hospital activities.</p>
        </div>

    </div>

</section>

<!-- ================= CONTACT US ================= -->

<section id="contact" class="contact-section">

    <div class="section-heading contact-heading">
        <h2>Contact Us</h2>
        <p>
            Have any questions or need more information?
            Feel free to contact us.
        </p>
    </div>

    <div class="contact-container">

        <!-- LEFT SIDE -->
        <div class="contact-info">

            <h2>Get In Touch</h2>

            <p>
                We are here to help you. Contact us for any
                questions, appointments or information about
                our healthcare management system.
            </p>

            <div class="contact-detail">
                <div class="contact-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div>
                    <h3>Address</h3>
                    <p>Gujranwala, Punjab, Pakistan</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>

                <div>
                    <h3>Phone</h3>
                    <p>+92 300 1234567</p>
                </div>
            </div>

            <div class="contact-detail">
                <div class="contact-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div>
                    <h3>Email</h3>
                    <p>info@healthcare.com</p>
                </div>
            </div>

         
        </div>


        <!-- RIGHT SIDE FORM -->
        <div class="contact-form">

            <h2>Send Us a Message</h2>

            <form action="#" method="POST">

                <div class="form-row">

                    <div class="form-group">
                        <label for="name">Your Name</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter your name"
                            required
                        >
                    </div>


                    <div class="form-group">
                        <label for="email">Email Address</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        >
                    </div>

                </div>


                <div class="form-group">

                    <label for="message">Message</label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        placeholder="Write your message..."
                        required
                    ></textarea>

                </div>


                <div class="contact-buttons">

                    <button type="submit" class="send-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        Send Message
                    </button>

                    <button type="reset" class="clear-btn">
                        <i class="fa-solid fa-rotate-left"></i>
                        Clear
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

<!-- ================= CTA ================= -->

<section class="cta">

    <h2>Ready to Manage Your Clinic Smarter?</h2>

    <p>
        Start managing patients, doctors and appointments today.
    </p>

    <a href="/hospital/auth/login.php" class="primary-btn">
        Login to System
    </a>

</section>



<!-- ================= FOOTER ================= -->

<footer id="contact">

    <div class="footer-container">

        <div class="footer-about">
            
             <img src="/hospital/assets/images/footer.png" alt=""   height="80px" width="250px"> 
           
            <p>
                Hospital / Clinic Management System
                for efficient healthcare management.
            </p>

        </div>


        <div class="footer-links">

            <h3>Quick Links</h3>

            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#services">Services</a>
            <a href="#appoinment">Appoinments</a>
            <a href="#contact">Contact</a>

        </div>


        <div class="footer-links">

            <h3>Account</h3>

            <a href="/hospital/auth/login.php">Login</a>
            <a href="/hospital/auth/register.php">Register</a>

        </div>


        <div class="footer-contact">

            <h3>Contact Us</h3>

            <p><i class="fa-solid fa-envelope"></i> info@healthcare.com</p>
            <p><i class="fa-solid fa-phone"></i> +92 300 1234567</p>
            <p><i class="fa-solid fa-location-crosshairs"></i> Pakistan</p>

        </div>

    </div>


    <div class="copyright">

        <p>
            © 2026 Hospital / Clinic Management System.
            All Rights Reserved.
        </p>

    </div>

</footer>

</body>
</html>