@extends('layout')
@section('title', "Home page")

@section('content')
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multitenancy Solutions - For a Greener Tomorrow</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header styles */
        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #3498db;
        }

        /* Hero section styles */
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1497436072909-60f360e1d4b1');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero-content {
            max-width: 800px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #2980b9;
        }

        /* Features section styles */
        .features {
            padding: 5rem 2rem;
            background-color: #ecf0f1;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature {
            background-color: #fff;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .feature i {
            font-size: 3rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        .feature h3 {
            margin-bottom: 1rem;
        }

        /* Footer styles */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 2rem 0;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .social-links a {
            color: #ecf0f1;
            font-size: 1.5rem;
            margin-left: 1rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #3498db;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .features-container {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
            }

            .social-links {
                margin-top: 1rem;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Multitenancy Solutions</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>Innovative Solutions for Companies</h1>
                <p>Welcome to our task management system, specifically designed to optimize project handling within subsidiaries. This system is based on a multitenancy approach, allowing each subsidiary to operate independently within a centralized framework that ensures efficient and consistent management.</p>
                <a href="#contact" class="cta-button">Get Started</a>
            </div>
        </section>

        <section id="features" class="features">
            <div class="features-container">
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Multitenancy Architecture</h3>
                    <p>Our system supports multitenancy, enabling multiple clients to operate securely within a single platform.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-tachometer-alt"></i>
                    <h3>Company-Specific Task Management</h3>
                    <p>Organize, assign, and track tasks specifically for each tenant, enhancing productivity and organization.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-recycle"></i>
                    <h3>Advanced Web Security</h3>
                    <p>Built with robust security protocols to protect tenant data and prevent unauthorized access.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h3>Data Isolation & Privacy</h3>
                    <p>Ensure data privacy and isolation between tenants, maintaining a secure environment for all users.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Eco Solutions. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
@endsection