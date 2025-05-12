<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .hero-section .position-absolute.bottom-0 {
            transform: translateX(-50%) translateY(50%);
        }

        @media (max-width: 768px) {
            .hero-section .position-absolute.bottom-0 {
                width: 90% !important;
            }

            .hero-section .d-flex.align-items-center {
                flex-direction: column;
            }

            .hero-section .border-end {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6;
                padding-right: 0 !important;
                margin-right: 0 !important;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
                width: 100%;
            }

            .hero-section .flex-shrink-1 {
                width: 100% !important;
            }
        }

        section {
            padding: 80px 0;
        }

        .section-header {
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .feature-card {
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-card {
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        .footer {
            background-color: #343a40;
        }

        .social-links a {
            display: inline-block;
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: #0d6efd;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            section {
                padding: 60px 0;
            }

            .hero-section {
                padding: 80px 0;
                text-align: center;
            }

            .hero-section img {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>


    <!-- Navbar Template -->
    @include('layouts_web.navbar')
    <!-- Hero Section Template -->
    @yield('content')
    <!-- Footer Template -->
    @include('layouts_web.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Form submission handling
        const contactForm = document.querySelector('.contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Here you would typically send the form data to a server
                alert('Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
                this.reset();
            });
        }
    </script>
</body>

</html>
