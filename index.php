<?php

include("connection.php");

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {

        $stmt = $conn->prepare(
            "INSERT INTO contacts (name, email, subject, message)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $success_message = "Your message has been successfully submitted!";
        } else {
            $error_message = "There was an error submitting your message.";
        }

        $stmt->close();

    } else {
        $error_message = "Please complete all fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>GameVault PH | Video Game Retail</title>


    <!-- ================= BOOTSTRAP 5 ================= -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- ================= CUSTOM CSS ================= -->

    <style>

        /* =========================================================
           GENERAL
        ========================================================= */

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 75px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #08090d;
            color: #f5f5f5;
            margin: 0;
        }

        section {
            position: relative;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {
            background: rgba(5, 6, 10, 0.96) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: 1px;
            color: #ffffff !important;
        }

        .navbar-brand span {
            color: #00a8ff;
        }

        .nav-link {
            color: #b8bec9 !important;
            font-weight: 500;
            margin-left: 10px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #00a8ff !important;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.2);
        }


        /* =========================================================
           HERO / HOME
        ========================================================= */

        .hero {
            min-height: 92vh;

    background-image:
        linear-gradient(
            90deg,
            rgba(5, 6, 10, 0.95) 0%,
            rgba(5, 6, 10, 0.80) 45%,
            rgba(5, 6, 10, 0.45) 100%
        ),
        url("images/gamingbadforyou_featcrop.jpg");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: scroll;

    color: white;

    display: flex;
    align-items: center;

    border-bottom: 1px solid rgba(0, 168, 255, 0.15);
        }

        .hero h1 {
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 900;
            letter-spacing: -2px;
            line-height: 0.98;
            margin-bottom: 25px;
        }

        .hero h1::after {
            content: "";
            display: block;
            width: 90px;
            height: 4px;
            background: #00a8ff;
            margin-top: 22px;
            border-radius: 5px;
        }

        .hero .lead {
            color: #d8dce5;
            max-width: 700px;
            font-size: 1.25rem;
            line-height: 1.7;
        }

        .hero p:not(.lead) {
            color: #9fa6b2;
            max-width: 700px;
            line-height: 1.7;
        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .btn-primary {
            background: #00a8ff;
            border-color: #00a8ff;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #008ed6;
            border-color: #008ed6;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 168, 255, 0.25);
        }

        .btn-outline-light {
            border-color: #555d69;
            color: #ffffff;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-outline-light:hover {
            background: #ffffff;
            border-color: #ffffff;
            color: #08090d;
        }


        /* =========================================================
           SECTION TITLES
        ========================================================= */

        .section-title {
            font-weight: 800;
            font-size: 2.4rem;
            margin-bottom: 50px;
            color: #ffffff;
            position: relative;
        }

        .section-title::after {
            content: "";
            display: block;
            width: 55px;
            height: 3px;
            background: #00a8ff;
            margin: 15px auto 0;
            border-radius: 5px;
        }


        /* =========================================================
           SERVICES
        ========================================================= */

        #services {
            background: #0c0e13;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .service-card {
            background: #12151c;
            border: 1px solid #20242d;
            border-radius: 10px;
            color: #ffffff;
            transition: 0.3s;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-8px);
            border-color: #00a8ff;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        }

        .service-card .card-body {
            padding: 30px 20px;
        }

        .service-card h4 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .service-card p {
            color: #9fa6b2;
            line-height: 1.7;
        }


        /* =========================================================
           PRODUCTS
        ========================================================= */

        #products {
            background: #08090d !important;
        }

        .product-card {
            background: #11141a;
            border: 1px solid #20242d;
            border-radius: 10px;
            color: #ffffff;
            overflow: hidden;
            transition: 0.35s;
        }

        .product-card:hover {
            transform: translateY(-8px);

            border-color: #00a8ff;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.5),
                0 0 20px rgba(0, 168, 255, 0.08);
        }


        /* =========================================================
           GAME COVER IMAGES
        ========================================================= */

        .product-card img {
            height: 260px;
            width: 100%;

            /*
                contain keeps the entire game cover visible
                instead of zooming/cropping it.
            */
            object-fit: contain;

            background-color: #0b0d12;

            padding: 10px;

            display: block;

            transition: 0.4s;
        }

        .product-card:hover img {
            transform: scale(1.03);
        }


        /* =========================================================
           PRODUCT CARD CONTENT
        ========================================================= */

        .product-card .card-body {
            padding: 22px;
        }

        .product-card .card-title {
            font-weight: 700;
            color: #ffffff;
            min-height: 48px;
        }

        .product-card .card-text {
            color: #969daa;
            font-size: 0.95rem;
            line-height: 1.6;
            min-height: 75px;
        }

        .product-card h5:last-child {
            color: #00a8ff;
            font-weight: 800;
            margin-top: 18px;
        }


        /* =========================================================
           ABOUT
        ========================================================= */

        .about-section {
            background:
                linear-gradient(
                    135deg,
                    #10131a,
                    #08090d
                );

            color: white;

            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .about-section p {
            color: #aeb4bf;
            line-height: 1.8;
        }

        .about-section .section-title {
            text-align: left;
        }

        .about-section .section-title::after {
            margin-left: 0;
        }

        .developer-box {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 35px;
            backdrop-filter: blur(10px);
        }

        .developer-box h3 {
            font-weight: 800;
            margin-bottom: 20px;
        }


        /* =========================================================
           CONTACT
        ========================================================= */

        #contact {
            background: #0c0e13;
        }

        .form-label {
            color: #dce0e7;
            font-weight: 600;
        }

        .form-control {
            background: #11141a;
            border: 1px solid #292e38;
            color: #ffffff;
            padding: 13px 15px;
            border-radius: 7px;
        }

        .form-control:focus {
            background: #11141a;
            color: #ffffff;
            border-color: #00a8ff;

            box-shadow:
                0 0 0 0.2rem rgba(0, 168, 255, 0.12);
        }

        .form-control::placeholder {
            color: #686f7b;
        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .alert {
            border-radius: 8px;
            border: none;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            background: #050609;
            color: #747b87;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        footer small {
            color: #505661;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 768px) {

            .hero {
                min-height: 80vh;
                padding: 80px 0;
            }

            .hero h1 {
                font-size: 3.2rem;
            }

            .hero .lead {
                font-size: 1.05rem;
            }

            .section-title {
                font-size: 2rem;
            }

            /*
                Slightly smaller images on mobile
                so the product cards remain compact.
            */
            .product-card img {
                height: 250px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     NAVIGATION
========================================================= -->

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

    <div class="container">

        <!-- Brand -->

        <a
            class="navbar-brand"
            href="#home"
        >
            GAMEVAULT <span>PH</span>
        </a>


        <!-- Bootstrap Navbar Toggler -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Bootstrap Navbar Collapse -->

        <div
            class="collapse navbar-collapse"
            id="navbarNav"
        >

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#home"
                    >
                        Home
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#services"
                    >
                        Services
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#products"
                    >
                        Products
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#about"
                    >
                        About Us
                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="#contact"
                    >
                        Contact Us
                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>



<!-- =========================================================
     HOME
========================================================= -->

<section
    id="home"
    class="hero"
>

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

                <h1>
                    GameVault PH
                </h1>


                <p class="lead mt-3">

                    Your destination for popular video games,
                    exciting gaming experiences, and great titles
                    for players of all kinds.

                </p>


                <p>

                    From tactical shooters and fighting games to
                    racing, open-world adventures, role-playing games,
                    and action-packed experiences, GameVault PH brings
                    some of gaming's most exciting titles together
                    in one place.

                </p>


                <div class="mt-4">

                    <a
                        href="#products"
                        class="btn btn-primary btn-lg me-2 mb-2"
                    >
                        Browse Games
                    </a>


                    <a
                        href="#contact"
                        class="btn btn-outline-light btn-lg mb-2"
                    >
                        Contact Us
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     SERVICES
========================================================= -->

<section
    id="services"
    class="py-5"
>

    <div class="container">

        <h2 class="text-center section-title">
            Our Services
        </h2>


        <div class="row g-4">


            <!-- GAME RETAIL -->

            <div class="col-md-6 col-lg-3">

                <div class="card service-card h-100">

                    <div class="card-body text-center">

                        <h4 class="card-title">
                            Game Retail
                        </h4>

                        <p class="card-text">

                            Browse and purchase popular video game
                            titles for different gaming platforms.

                        </p>

                    </div>

                </div>

            </div>



            <!-- GAME RECOMMENDATIONS -->

            <div class="col-md-6 col-lg-3">

                <div class="card service-card h-100">

                    <div class="card-body text-center">

                        <h4 class="card-title">
                            Game Recommendations
                        </h4>

                        <p class="card-text">

                            Discover games based on your preferred
                            genre, playstyle, and gaming interests.

                        </p>

                    </div>

                </div>

            </div>



            <!-- PRE-ORDER -->

            <div class="col-md-6 col-lg-3">

                <div class="card service-card h-100">

                    <div class="card-body text-center">

                        <h4 class="card-title">
                            Pre-Order Service
                        </h4>

                        <p class="card-text">

                            Reserve selected upcoming titles and
                            stay updated on their availability.

                        </p>

                    </div>

                </div>

            </div>



            <!-- GAMING ASSISTANCE -->

            <div class="col-md-6 col-lg-3">

                <div class="card service-card h-100">

                    <div class="card-body text-center">

                        <h4 class="card-title">
                            Gaming Assistance
                        </h4>

                        <p class="card-text">

                            Get assistance with game selection,
                            platforms, editions, and basic product
                            information.

                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     PRODUCTS
========================================================= -->

<section
    id="products"
    class="py-5"
>

    <div class="container">

        <h2 class="text-center section-title">
            Featured Games
        </h2>


        <div class="row g-4">


            <!-- =================================================
                 1. RAINBOW SIX SIEGE
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/MV5BMTMyODFkZDYtN2QyNy00ZTFkLWI1NWUtNzU0NGYwMjVhNTAzXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                        class="card-img-top"
                        alt="Tom Clancy's Rainbow Six Siege"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Tom Clancy's Rainbow Six Siege

                        </h5>


                        <p class="card-text">

                            A tactical first-person shooter focused
                            on teamwork, strategy, and close-quarters
                            combat.

                        </p>


                        <h5>
                            PHP 1,499
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 2. CALL OF DUTY
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Call_of_Duty_Modern_Warfare_(2019)_cover.jpg"
                        class="card-img-top"
                        alt="Call of Duty Modern Warfare"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Call of Duty: Modern Warfare

                        </h5>


                        <p class="card-text">

                            Experience intense modern military
                            action through competitive multiplayer
                            and cinematic gameplay.

                        </p>


                        <h5>
                            PHP 2,999
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 3. GRAND THEFT AUTO V
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Grand_Theft_Auto_V.png"
                        class="card-img-top"
                        alt="Grand Theft Auto V"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Grand Theft Auto V

                        </h5>


                        <p class="card-text">

                            Explore a massive open world filled with
                            missions, characters, vehicles, and
                            multiplayer activities.

                        </p>


                        <h5>
                            PHP 1,799
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 4. TEKKEN 5 DARK RESURRECTION
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/tekken.webp"
                        class="card-img-top"
                        alt="Tekken 5 Dark Resurrection"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Tekken 5: Dark Resurrection

                        </h5>


                        <p class="card-text">

                            Experience fast-paced fighting action
                            with a variety of characters, stages,
                            and intense one-on-one battles.

                        </p>


                        <h5>
                            PHP 1,499
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 5. NEED FOR SPEED MOST WANTED
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Nfs-most-wanted-2012-gen-packart.jpg"
                        class="card-img-top"
                        alt="Need for Speed Most Wanted"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Need for Speed: Most Wanted

                        </h5>


                        <p class="card-text">

                            Race through the streets, compete against
                            rival drivers, and build your reputation
                            in high-speed street racing.

                        </p>


                        <h5>
                            PHP 1,499
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 6. CYBERPUNK 2077
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Cyberpunk_2077_box_art.jpg"
                        class="card-img-top"
                        alt="Cyberpunk 2077"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Cyberpunk 2077

                        </h5>


                        <p class="card-text">

                            Explore a futuristic open-world
                            role-playing game set in Night City.

                        </p>


                        <h5>
                            PHP 2,499
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 7. RISE OF THE TOMB RAIDER
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Rise_of_the_Tomb_Raider.jpg"
                        class="card-img-top"
                        alt="Rise of the Tomb Raider"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Rise of the Tomb Raider

                        </h5>


                        <p class="card-text">

                            Join Lara Croft on an action-packed
                            adventure involving exploration,
                            survival, ancient mysteries, and
                            dangerous environments.

                        </p>


                        <h5>
                            PHP 1,999
                        </h5>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 8. ASSASSIN'S CREED SHADOWS
            ================================================== -->

            <div class="col-md-6 col-lg-3">

                <div class="card product-card h-100">

                    <img
                        src="images/Assassin's_Creed_Shadows_cover.png"
                        class="card-img-top"
                        alt="Assassin's Creed Shadows"
                    >


                    <div class="card-body">

                        <h5 class="card-title">

                            Assassin's Creed Shadows

                        </h5>


                        <p class="card-text">

                            Experience an action role-playing
                            adventure set in historical Japan.

                        </p>


                        <h5>
                            PHP 3,499
                        </h5>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     ABOUT US
========================================================= -->

<section
    id="about"
    class="about-section py-5"
>

    <div class="container">

        <div class="row align-items-center">


            <!-- BUSINESS INFORMATION -->

            <div class="col-lg-6">

                <h2 class="section-title">
                    About GameVault PH
                </h2>


                <p>

                    GameVault PH is a proposed video game retail
                    business created for gamers who want to discover
                    popular and exciting video game titles in one
                    convenient place.

                </p>


                <p>

                    Our goal is to provide an organized and
                    user-friendly gaming store where customers can
                    explore different genres, learn about available
                    games, and find titles that match their interests.

                </p>


                <p>

                    The website features a selection of action,
                    tactical, racing, fighting, role-playing, and
                    open-world games.

                </p>

            </div>



            <!-- DEVELOPER INFORMATION -->

            <div class="col-lg-6">

                <div class="developer-box">

                    <h3>
                        About the Developer
                    </h3>


                    <p>

                        I am a student and aspiring IT professional
                        interested in programming, web development,
                        cybersecurity, and technology.

                    </p>


                    <p>

                        GameVault PH was developed as a demonstration
                        of my ability to create a responsive website
                        using HTML, CSS, Bootstrap 5, PHP, and MySQL.

                    </p>


                    <p class="mb-0">

                        The project combines a modern gaming-inspired
                        interface with a functional database-connected
                        Contact Us form.

                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     CONTACT US
========================================================= -->

<section
    id="contact"
    class="py-5"
>

    <div class="container">

        <h2 class="text-center section-title">
            Contact Us
        </h2>


        <div class="row justify-content-center">

            <div class="col-lg-8">


                <!-- =================================================
                     SUCCESS MESSAGE
                ================================================== -->

                <?php if (!empty($success_message)): ?>

                    <div
                        class="alert alert-success"
                        role="alert"
                    >

                        <?php echo $success_message; ?>

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     ERROR MESSAGE
                ================================================== -->

                <?php if (!empty($error_message)): ?>

                    <div
                        class="alert alert-danger"
                        role="alert"
                    >

                        <?php echo $error_message; ?>

                    </div>

                <?php endif; ?>



                <!-- =================================================
                     CONTACT FORM
                ================================================== -->

                <form
                    method="POST"
                    action="#contact"
                >


                    <!-- FULL NAME -->

                    <div class="mb-3">

                        <label
                            for="name"
                            class="form-label"
                        >
                            Full Name
                        </label>


                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="Enter your full name"
                            required
                        >

                    </div>



                    <!-- EMAIL -->

                    <div class="mb-3">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Email Address
                        </label>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email"
                            required
                        >

                    </div>



                    <!-- SUBJECT -->

                    <div class="mb-3">

                        <label
                            for="subject"
                            class="form-label"
                        >
                            Subject
                        </label>


                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            class="form-control"
                            placeholder="Enter your subject"
                            required
                        >

                    </div>



                    <!-- MESSAGE -->

                    <div class="mb-3">

                        <label
                            for="message"
                            class="form-label"
                        >
                            Message
                        </label>


                        <textarea
                            id="message"
                            name="message"
                            class="form-control"
                            rows="5"
                            placeholder="Enter your message"
                            required
                        ></textarea>

                    </div>



                    <!-- SUBMIT BUTTON -->

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Send Message
                    </button>


                </form>


            </div>

        </div>

    </div>

</section>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="py-4 text-center">

    <div class="container">

        <p class="mb-0">

            &copy; 2026 GameVault PH.
            All Rights Reserved.

        </p>


        <small>

            Static Website Development Activity

        </small>

    </div>

</footer>



<!-- =========================================================
     BOOTSTRAP 5 JAVASCRIPT
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>