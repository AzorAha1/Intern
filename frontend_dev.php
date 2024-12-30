<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction to Frontend Development | FMC-BKD</title>
    <link href="img/logo.jpg" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }
        header {
            background: #343a40;
            color: #fff;
            padding: 30px 0;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover {
            color: #00c4cc;
        }
        .container {
            margin-top: 40px;
        }
        h2, h3 {
            color: #343a40;
        }
        section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        section h3 {
            color: #00c4cc;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            padding: 8px;
            font-size: 1.1rem;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
        .footer-text {
            font-size: 1rem;
            margin: 0;
        }
        .btn-primary {
            background-color: #00c4cc;
            border: none;
            color: white;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #007b83;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="text-center">Introduction to Frontend Development</h1>
            <p class="text-center">FMC-BKD ICT Internship Application Portal</p>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">FMC-BKD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="apply.html">Apply</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <section>
            <h2 class="text-center">What We Offer</h2>
            <p>
                The "Introduction to Frontend Development" course is designed for individuals who are new to web development. In this course, you'll learn the essential tools and technologies that make up the frontend of a website, including HTML, CSS, and JavaScript.
            </p>
        </section>

        <section>
            <h3>Course Highlights</h3>
            <ul>
                <li>Introduction to HTML: Structure and elements of a webpage</li>
                <li>Understanding CSS: Styling web pages with colors, fonts, and layouts</li>
                <li>Basic JavaScript: Adding interactivity to webpages</li>
                <li>Responsive design: Making websites work on any device (mobile, tablet, desktop)</li>
                <li>Introduction to web accessibility: Ensuring websites are usable for everyone</li>
                <li>Creating your first project: A simple, interactive webpage</li>
            </ul>
        </section>

        <section>
            <h3>Learning Outcomes</h3>
            <ul>
                <li>Develop a strong understanding of HTML structure and how to create web pages.</li>
                <li>Learn CSS to style and layout web pages with different colors, fonts, and designs.</li>
                <li>Understand JavaScript to create dynamic and interactive web pages.</li>
                <li>Understand the principles of responsive web design for mobile-first development.</li>
                <li>Learn basic web accessibility to ensure your websites are inclusive.</li>
            </ul>
        </section>

        <section>
            <h3>Who Should Enroll?</h3>
            <p>
                This course is ideal for beginners, students, or professionals looking to start a career in web development. If you're interested in learning how to build websites from scratch and gain the essential skills for frontend development, this course is perfect for you.
            </p>
            <p><strong>Duration:</strong> 4 Weeks</p>
            <p><strong>Format:</strong> Online and On-Site</p>
            <p><strong>Fee:</strong> Free for internship applicants</p>
            <a href="apply.html" class="btn btn-primary">Apply Now</a>
        </section>
    </main>

    <footer>
        <div class="container">
            <p class="footer-text text-center">&copy; <script>document.write(new Date().getFullYear());</script> FMC-BKD. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>