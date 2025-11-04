<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "host";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginn.php");
    exit;
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
// Total Appointments
$appointments = $conn->query("SELECT COUNT(*) AS total FROM appointments")->fetch_assoc()['total'];

// Total Check-ins
$checkins = $conn->query("SELECT COUNT(*) AS total FROM checkins")->fetch_assoc()['total'];

// Total Patients Registered
$patients = $conn->query("SELECT COUNT(*) AS total FROM patient_registration")->fetch_assoc()['total'];

// Years of Service (hardcoded for now)
$years_of_service = 21;
?>

<!DOCTYPE html> 
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

  <title>Lifeline Hospital</title>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }
    html {
  scroll-behavior: smooth;
}
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    header {
      background-color:rgb(131, 192, 245);
      color:rgb(102, 23, 172);
      padding: 20px 0;
      text-align: center;
    }
    header h1 {
  font-size: 68px;
  font-family: 'Playfair Display', serif;
  margin: 0;
}
header p {
  font-size: 25px;
  font-family: 'Playfair Display', serif;
  margin: 10px 0 0 0;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 240px;
  background-color: rgb(176, 205, 230);
  padding-top: 120px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  z-index: 999;
  overflow-y: auto; /* Already present — good */
  padding-bottom: 100px; /* Add this to give room for scrolling */
}

nav a,
nav .dropbtn {
  display: block;
  width: 100%;
  text-align: left;
  padding: 12px 20px;
  color: rgb(231, 18, 149);
  text-decoration: none;
  font-weight: bold;
  font-size: 16px;
  background: none;
  border: none;
}

nav a:hover,
nav .dropbtn:hover {
  background-color: rgba(255, 255, 255, 0.3);
}


    .hero {
      padding: 50px 0;
      text-align: center;
      background-color: #e3f2fd;
    }

    .hero img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(235, 65, 65, 0.92);
    }

    .section {
      padding: 50px 0;
      text-align: center;
    }

    .section h2 {
      color: #0069d9;
    }

    .services {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 30px;
    }

    .service-card {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      width: 250px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    footer {
      background-color: #5a85b1;
      color: white;
      text-align: center;
      padding: 20px 10px;
      margin-top: 50px;
    }
    #backToTop {
  position: fixed;
  bottom: 30px;
  right: 20px;
  font-size: 20px;
  background-color:rgba(230, 204, 220, 0.84);
  color: rgb(11, 188, 85);
  padding: 8px;
  border-radius: 15%;
  text-align: center;
  text-decoration: none;
  box-shadow: 0 0 10px rgba(93, 14, 231, 0.97);
  transition: background-color 0.3s;
}

#backToTop:hover {
  background-color:rgba(240, 107, 189, 0.84);
.image-scroll-section {
  padding: 40px 20px;
  background-color: #f8f9fa;
  text-align: center;
}
}

.image-scroll-section h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  color:rgb(231, 18, 149);
  margin-bottom: 20px;
}

.scroll-wrapper {
  overflow: hidden;
  width: 100%;
  position: relative;
}

.scroll-gallery {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch; /* important for iOS */
  gap: 10px;
  padding: 10px;
  white-space: nowrap; /* ensures no wrapping */
}

.scroll-gallery img {
  flex: 0 0 auto;/* ✅ Ensures images stay side-by-side */
  width: 250px;
  height: 160px;
  object-fit: cover;
  border-radius: 10px;
  transition: transform 0.3s;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
}

.scroll-gallery img:hover {
  transform: scale(1.05);
}

.scroll-btn {
  background-color:rgb(231, 18, 149);
  color: white;
  border: none;
  font-size: 28px;
  padding: 10px;
  cursor: pointer;
  position: absolute;
  z-index: 1;
  top: 50%;
  transform: translateY(-50%);
  border-radius: 50%;
  opacity: 0.7;
}

.scroll-btn:hover {
  background-color: #8a0858;
}

.scroll-btn.left {
  left: 10px;
}

.scroll-btn.right {
  right: 10px;
}
.lightbox {
  display: none;
  position: fixed;
  z-index: 1000;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.9);
  text-align: center;
}

.lightbox-content {
  margin: auto;
  display: block;
  max-width: 80%;
  max-height: 80%;
  border-radius: 10px;
  box-shadow: 0 0 20px white;
}

.lightbox-close {
  position: absolute;
  top: 25px;
  right: 40px;
  color: white;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}
.lightbox-close:hover {
  color: #ccc;
}
/* Dropdown menu styles */
.dropdown {
  position: relative;
  z-index: 1000; /* Add this */
}


.dropbtn {
  background-color: rgb(176, 205, 230);
  color: rgb(231, 18, 149);
  padding: 16px 24px;        /* Increase padding */
  font-size: 15px;           /* Increase font size */
  font-weight: bold;
  border: none;
  cursor: pointer;
  font-family: inherit;
  border-radius: 8px;        /* rounded corners */
}

.dropdown-content {
  display: none;
  max-height: 300px; /* Limit visible height */
  overflow-y: auto;  /* Enable scrolling inside */
  width: 100%;
  background-color: white;
  box-shadow: none;
  border-radius: 0;
  z-index: 1001; /* Make sure it appears above other content */
  position: relative;
}



.submenu-content {
  position: static;
  display: none;
}

.submenu-content a:hover {
  background-color: rgb(229, 235, 236);
}

.user-display {
  position: fixed;
  top: 15px;
  right: 120px; /* next to logout button */
  background-color: rgba(176, 205, 230, 0.95);
  color: #7b026a;
  padding: 8px 14px;
  border-radius: 6px;
  font-weight: bold;
  font-size: 15px;
  font-family: 'Segoe UI', sans-serif;
  animation: slideIn 1.2s ease-in-out;
  box-shadow: 0 0 8px rgba(0,0,0,0.2);
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.main-content,
header {
  margin-left: 240px;
  transition: margin-left 0.3s ease-in-out;
}

body.menu-collapsed .main-content,
body.menu-collapsed header {
  margin-left: 0;
}
body.menu-collapsed {
  padding-top: 60px; /* so content doesn't clash with button */
}

header {
  margin-left: 240px;
}
.dropbtn,
.has-submenu {
  cursor: pointer;
}
@media screen and (max-height: 600px) {
  .dropdown-content {
    max-height: 300px;
    overflow-y: auto;
  }
}
.dropup .dropdown-content {
  bottom: 100%;
  top: auto;
  transform: translateY(-10px); /* slight lift */
  position: absolute;
}
nav {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 240px;
  background-color: rgb(153, 204, 249);
  padding-top: 120px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  z-index: 1000;
  overflow-y: auto;
  transition: transform 0.3s ease-in-out;
}

nav.collapsed {
  transform: translateX(-100%);
}

#sidebarToggle {
  position: fixed;
  top: 20px;
  left: 20px;
  z-index: 1001;
  background-color: #5a85b1;
  color: white;
  border: none;
  padding: 10px 14px;
  font-size: 20px;
  border-radius: 6px;
  cursor: pointer;
  display: none; /* Show only on small screens */
}
@media screen and (max-width: 768px) {
  #sidebarToggle {
    display: block;
  }
}
@media screen and (max-width: 768px) {
  header {
    margin-left: 0;
    padding: 15px 10px;
    text-align: center;
  }

  header h1 {
    font-size: 32px;
  }

  header p {
    font-size: 16px;
  }

  .container {
    flex-direction: column;
    align-items: center;
    padding: 0 10px;
  }

  .container img {
    height: 80px;
  }

  nav {
    width: 220px;
    padding-top: 100px;
  }

  .main-content {
    margin-left: 0;
    padding: 0 15px;
  }

  .services {
    flex-direction: column;
    align-items: center;
  }

  .service-card {
    width: 90%;
    max-width: 340px;
  }

  .scroll-wrapper {
    flex-direction: column;
    align-items: center;
  }



  .scroll-gallery {
    overflow-x: scroll;
    gap: 10px;
    padding: 10px 0;
  }

  .scroll-gallery img {
    height: 140px;
    width: 220px;
  }

  .user-display {
    position: static;
    margin-top: 10px;
    text-align: center;
  }

  #backToTop {
    right: 10px;
    bottom: 20px;
    font-size: 16px;
    padding: 6px;
  }

  .dropbtn {
    padding: 12px;
    font-size: 14px;
  }

  .dropdown-content a {
    font-size: 14px;
    padding: 10px;
  }

  footer {
    font-size: 14px;
    padding: 15px 5px;
  }
}
.dropdown-section-header {
  font-weight: bold;
  color: #e3139f;
  font-size: 16px;
  padding: 10px 20px 5px;
  background-color: #ffffff;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #eee;
  font-family: 'Segoe UI', sans-serif;
}

.submenu-section a {
  display: block;
  padding: 8px 24px;
  color: #333;
  text-decoration: none;
  font-size: 14.5px;
  font-family: 'Segoe UI', sans-serif;
  transition: background 0.2s ease;
}

.submenu-section a:hover {
  background-color: #f0f0f0;
  color: #e3139f;
  font-weight: 600;
}
.report-grid {
  max-width: 1000px;
  margin: auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  text-align: center;
}

.center-grid {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.report-card {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 120px; /* Ensure uniform height */
}

.report-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 18px rgba(0, 0, 0, 0.15);
}

.report-card .count {
  font-size: 32px;
  font-weight: bold;
  margin: 0;
  color: #5a2c8a;
  line-height: 1;
}
.report-card h3 {
  margin-top: 10px;
  font-size: 18px;
  color: #333;
  line-height: 1.4;
}
    /* When .show is added via JS, make the dropdown visible */
.dropdown-content.show {
  display: block;
}
  




  </style>
</head>
<body>
  <div class="user-display">
  👤 Logged in as <strong><?php echo htmlspecialchars($username); ?></strong>
</div>

<a href="logout.php" style="position: fixed; top: 15px; right: 15px; background:rgb(102, 23, 172); color: white; border: none; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Logout</a>
  <header>
  <div class="container" style="display: flex; align-items: center; gap: 20px;">
    <img src=https://img.icons8.com/?size=100&id=46599&format=png&color=000000 alt="Lifeline Hospital Logo" style="height: 120px;">
    <div>
      <h1 style="margin: 0; font-size: 55px;">Lifeline Hospital</h1>
      <p style="margin: 5px 0; font-size: 24px;">Compassionate Care. Modern Medicine.</p>
    </div>
  </div>
</header>
<button id="sidebarToggle" title="Toggle Menu">&#9776;</button>


  <nav>
    <a href="#">Home</a>
    <a href="#services">Our Services</a>
    <a href="#about">About Us</a>
    <a href="#contact">Contact Us</a>
    <a href="#privacy">Privacy Policy</a>
<div class="dropdown">
  <button class="dropbtn">Patient Information⚓</button>
  <div class="dropdown-content">
    <div class="dropdown-section-header">Appointments</div>
    <div class="submenu-section">
      <a href="book.php">Book an Appointment</a>
      <a href="reschedule.php">Reschedule an Appointment</a>
      <a href="cancel.php">Cancel an Appointment</a>
      <a href="guidelines.php">Appointment Guidelines</a>
    </div>

    <a href="report.php">Report Online</a>
    <a href="registration.php">Patient Registration</a>
    <a href="visiting.php">Visiting Hours</a>
    <a href="request.php">Medical Records</a>
    <a href="patients.php">Inpatient & Outpatient Services</a>
    <a href="billing.php">Billing Information</a>
    <a href="faqs.php">FAQ's</a>
    <a href="support.php">Contact Support</a>
  </div>
</div>


<div class="dropdown dropup">
  <button class="dropbtn">Clinical Services⚓</button>
  <div class="dropdown-content">

    <div class="dropdown-section-header">Homecare Services</div>
    <div class="submenu-section">
      <a href="homecare.php">Homecare Overview</a>
    </div>

    <div class="dropdown-section-header">Diagnostics</div>
    <div class="submenu-section">
      <a href="lab.php">Lab Testing</a>
      <a href="xray.php">X-Ray</a>
      <a href="ultrascan.php">Ultrascan</a>
      <a href="ctscan.php">CT Scan / MRI</a>
    </div>

    <div class="dropdown-section-header">Surgical Services</div>
    <div class="submenu-section">
      <a href="ent.php">ENT</a>
      <a href="general.php">General Surgery</a>
    </div>

    <div class="dropdown-section-header">Emergency</div>
    <div class="submenu-section">
      <a href="ambulance.php">Ambulance</a>
      <a href="aid.php">First Aid</a>
    </div>

    <div class="dropdown-section-header">Specialists</div>
    <div class="submenu-section">
      <a href="pediatrics.php">Pediatrics</a>
      <a href="gynecologists.php">Gynecologists</a>
      <a href="cardiologists.php">Cardiology</a>
      <a href="dentists.php">Dentists</a>
      <a href="orthopedics.php">Orthopedics</a>
      <a href="psychiatry.php">Psychiatry</a>
    </div>

    <div class="dropdown-section-header">Rehabilitation & Therapy</div>
    <div class="submenu-section">
      <a href="physio.php">Physiotherapy</a>
      <a href="occupational.php">Occupational Therapy</a>
      <a href="speech.php">Speech Therapy</a>
    </div>

    <div class="dropdown-section-header">Preventative Care</div>
    <div class="submenu-section">
      <a href="vaccination.php">Vaccination / Immunization</a>
      <a href="screening.php">Health Screening</a>
      <a href="antenatal.php">Antenatal Care</a>
    </div>

    <div class="dropdown-section-header">Chronic Disease Management</div>
    <div class="submenu-section">
      <a href="diabetes.php">Diabetes</a>
      <a href="hiv.php">HIV</a>
      <a href="covid.php">COVID-19</a>
      <a href="hyper.php">Hypertension</a>
      <a href="tb.php">Tuberculosis</a>
    </div>

  </div>
</div>




  </nav>
  <div class="main-content">


<h2 style="text-align: center; font-size: 36px; color: #5c033a; font-family: 'Playfair Display', serif; margin-top: 40px;">
  Explore Our Services
</h2>

<section class="image-scroll-section">
  <div class="scroll-wrapper">
    <button class="scroll-btn left" onclick="scrollGallery('left')">&#10094;</button>

    <div class="scroll-gallery" id="scrollGallery">
      <img src="images/download.jpeg" alt="1" onclick="openLightbox(this.src)">
      <img src="images/maternity.jpeg" alt="2" onclick="openLightbox(this.src)">
      <img src="images/ward.jpeg" alt="3" onclick="openLightbox(this.src)">
      <img src="images/mother.jpeg" alt="4" onclick="openLightbox(this.src)">
      <img src="images/lab.jpeg" alt="5" onclick="openLightbox(this.src)">
      <img src="images/pharmacy.jpeg" alt="6" onclick="openLightbox(this.src)">
      <img src="images/dentist.jpeg" alt="7" onclick="openLightbox(this.src)">
      <img src="images/optician.jpeg" alt="8" onclick="openLightbox(this.src)">
      <img src="images/child.jpeg" alt="9" onclick="openLightbox(this.src)">
      <img src="images/emergency.jpeg" alt="10" onclick="openLightbox(this.src)">
      <img src="images/reception.jpeg" alt="11" onclick="openLightbox(this.src)">
      <img src="images/lifeline.jpeg" alt="12" onclick="openLightbox(this.src)">
    </div>

    <button class="scroll-btn right" onclick="scrollGallery('right')">&#10095;</button>
  </div>
</section>


  <section class="section" id="services">
    <div class="container">
      <h2>Our Services</h2>
      <div class="services">
  <div class="service-card">
    <h3>Emergency Care</h3>
    <p>Round-the-clock emergency services with expert staff and advanced equipment.</p>
  </div>
  <div class="service-card">
    <h3>Diagnostics</h3>
    <p>Accurate and timely lab tests and imaging with latest diagnostic tools.</p>
  </div>
  <div class="service-card">
    <h3>Outpatient Clinics</h3>
    <p>Consult specialists in cardiology, pediatrics, orthopedics, and more.</p>
  </div>
  <div class="service-card">
    <h3>Pharmacy</h3>
    <p>Well-stocked pharmacy with essential medications, open 24/7 for patient convenience.</p>
  </div>
  <div class="service-card">
    <h3>Mother & Child Care</h3>
    <p>Comprehensive maternity and pediatric services to support healthy moms and babies.</p>
  </div>
  </section>

  <section class="section" id="about" style="background-color: #e9ecef;">
    <div class="container">
      <h2>About Us</h2>
      <p>Lifeline Hospital has served the community for over 20 years, offering affordable and accessible care for all. Lifeline Hospital began its journey with an aim of providing patient satisfaction and a goal of saving and enriching lives. We work to improve access, efficiency, flexibility and accountability in healthcare. It has developed bespoke models of healthcare that meet health-related needs of the diverse population we serve. Over time, the immense public approval of services offered by our employees has led to our robust growth.</p>
    </div>
  </section>
  
   <section class="section" id="privacy" style="background-color: #e9ecaf;">
    <div class="container">
      <h2>🔒 Our Privacy Commitment</h2>
      <p>Lifeline Hospital is dedicated to safeguarding your personal and health-related information. We collect essential details such as your full name, contact information, ID, medical history, and billing data. This information is used solely to provide quality healthcare services, process payments, maintain accurate medical records, and fulfill legal obligations.

We apply industry-standard security measures to protect your data, and access is strictly limited to authorized personnel. We do not share your information without your explicit consent, except in cases where it is required by law or necessary for referrals to other medical providers.

You have full rights to access, update, or request deletion of your personal information by contacting our medical records office. We’re transparent about how we handle your data, and any changes to our privacy practices will be clearly posted on our website.</p>
    </div>
  </section>
<section style="background-color:#f9f9f9; padding: 40px 20px;">
  <!-- First Grid: 3 Cards -->
  <div class="report-grid">
    <div class="report-card" data-count="<?php echo $appointments; ?>">
      <p class="count">0</p>
      <h3>Appointments Made</h3>
    </div>

    <div class="report-card" data-count="<?php echo $checkins; ?>">
      <p class="count">0</p>
      <h3>Total Check-ins</h3>
    </div>

    <div class="report-card" data-count="<?php echo $patients; ?>">
      <p class="count">0</p>
      <h3>Patients Registered</h3>
    </div>
  </div>

  <!-- Second Grid: Centered Single Card -->
  <div class="center-grid">
    <div class="report-card" data-count="<?php echo $years_of_service; ?>">
      <p class="count">0</p>
      <h3>Years of Service</h3>
    </div>
  </div>
</section>



  <section class="section" id="contact" style="background-color: #ffffff;">
  <div class="container">
    <h2>Contact Us</h2>
    <p>If you have any questions or need help, feel free to reach out.</p>
    <p><strong>☎️Call:</strong> +254 700066999</p>
    <p><strong>💬SMS/WhatsApp:</strong> +254 734 345 656</p>
    <p><strong>📩 Email:</strong> info@lifelinehospital.co.ke</p>
    <p><strong>📌Address:</strong> Lifeline Hospital. Nakuru, Kenya</p>
  </div>
</section>

  <footer>
    <p>&copy; 2025 Lifeline Hospital. All rights reserved.</p>
  </footer>
  <script>
  window.onload = () => {
    if (window.location.hash) {
      history.replaceState(null, null, window.location.pathname);
    }
  };
</script>
<button id="backToTop" title="Back to top">&#8679;</button>
  <script>
  window.onload = () => {
    if (window.location.hash) {
      history.replaceState(null, null, window.location.pathname);
    }
  };
  const backToTopBtn = document.getElementById("backToTop");

  // Show button when user scrolls down 300px
  window.onscroll = function () {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
      backToTopBtn.style.display = "block";
    } else {
      backToTopBtn.style.display = "none";
    }
  };
  // Scroll to top when clicked
  backToTopBtn.onclick = function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  };
</script>


<script>
  const gallery = document.getElementById("scrollGallery");

  function scrollGallery(direction) {
    const img = gallery.querySelector("img");
    const scrollAmount = img.offsetWidth +1;

    if (direction === 'left') {
      if (gallery.scrollLeft === 0) {
        gallery.scrollTo({ left: gallery.scrollWidth, behavior: 'smooth' });
      } else {
        gallery.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      }
    } else {
      const atEnd = gallery.scrollLeft + gallery.clientWidth >= gallery.scrollWidth - scrollAmount;
      if (atEnd) {
        gallery.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        gallery.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }
  }

  // Auto-scroll right every 3 seconds
  setInterval(() => {
    scrollGallery('right');
  }, 3000);
</script>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
  <span class="lightbox-close">&times;</span>
  <img class="lightbox-content" id="lightbox-img">
  <script>
  function openLightbox(src) {
    document.getElementById("lightbox-img").src = src;
    document.getElementById("lightbox").style.display = "block";
  }

  function closeLightbox() {
    document.getElementById("lightbox").style.display = "none";
  }
</script>
</div>  
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggles = document.querySelectorAll(".dropbtn");

    dropdownToggles.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const content = this.nextElementSibling;

        // Close other dropdowns
        document.querySelectorAll(".dropdown-content").forEach(function (dropdown) {
          if (dropdown !== content) dropdown.style.display = "none";
        });

        // Toggle current dropdown
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    });

    // Same logic for nested submenus
    const submenuToggles = document.querySelectorAll(".has-submenu");

    submenuToggles.forEach(function (submenu) {
      submenu.addEventListener("click", function () {
        const submenuContent = this.nextElementSibling;

        if (submenuContent.style.display === "block") {
          submenuContent.style.display = "none";
        } else {
          submenuContent.style.display = "block";
        }
      });
    });

    // Optional: Close dropdowns if you click outside
    window.addEventListener("click", function (event) {
      if (!event.target.matches('.dropbtn') && !event.target.matches('.has-submenu')) {
        document.querySelectorAll(".dropdown-content").forEach(d => d.style.display = "none");
        document.querySelectorAll(".submenu-content").forEach(s => s.style.display = "none");
      }
    });
  });
</script>
<script>
document.querySelectorAll(".dropdown").forEach(dropdown => {
  dropdown.querySelector(".dropbtn").addEventListener("click", function () {
    const dropdownContent = this.nextElementSibling;
    const rect = this.getBoundingClientRect();
    const screenHeight = window.innerHeight;

    // If there's not enough space below, open upward
    if (screenHeight - rect.bottom < 200) {
      dropdown.classList.add("dropup");
    } else {
      dropdown.classList.remove("dropup");
    }
  });
});
</script>
<script>
  const toggleBtn = document.getElementById("sidebarToggle");
  const sidebar = document.querySelector("nav");

  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");
    document.body.classList.toggle("menu-collapsed");
  });

  // Show toggle on smaller screens
  function handleResize() {
    if (window.innerWidth <= 768) {
      toggleBtn.style.display = "block";
      sidebar.classList.add("collapsed");
      document.body.classList.add("menu-collapsed");
    } else {
      toggleBtn.style.display = "none";
      sidebar.classList.remove("collapsed");
      document.body.classList.remove("menu-collapsed");
    }
  }

  window.addEventListener("resize", handleResize);
  window.addEventListener("load", handleResize);
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".report-card");

  counters.forEach(card => {
    const countEl = card.querySelector(".count");
    const target = +card.dataset.count;
    let current = 0;
    const increment = Math.ceil(target / 100); // Adjust speed here

    const updateCount = () => {
      current += increment;
      if (current >= target) {
        countEl.textContent = target;
      } else {
        countEl.textContent = current;
        requestAnimationFrame(updateCount);
      }
    };

    updateCount();
  });
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dropdownButtons = document.querySelectorAll('.dropbtn');

    dropdownButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent bubbling

        // Close all other dropdowns
        document.querySelectorAll('.dropdown-content').forEach(menu => {
          if (menu !== this.nextElementSibling) {
            menu.classList.remove('show');
          }
        });

        // Toggle the current dropdown
        const dropdown = this.nextElementSibling;
        dropdown.classList.toggle('show');
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function () {
      document.querySelectorAll('.dropdown-content').forEach(menu => {
        menu.classList.remove('show');
      });
    });
  });
</script>


</body>
</html> 