<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pharmacy MS - Algeria</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <style>
            :root {
                --primary: #10B981; /* Emerald 500 */
                --primary-dark: #059669; /* Emerald 600 */
                --secondary: #34D399; /* Emerald 400 */
                --dark: #1F2937;
                --light: #F9FAFB;
                --white: #FFFFFF;
                --glass: rgba(255, 255, 255, 0.95);
            }
            body {
                font-family: 'Outfit', sans-serif;
                margin: 0;
                padding: 0;
                background-color: var(--light);
                color: var(--dark);
                overflow-x: hidden;
            }
            
            /* Navbar */
            .navbar {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 1.5rem 2rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                z-index: 50;
                box-sizing: border-box;
            }
            .nav-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: var(--primary-dark);
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: default;
                pointer-events: none;
            }
            .nav-links {
                display: flex;
                gap: 0.75rem;
            }

            .hero-section {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
                position: relative;
                overflow: hidden;
            }
            /* Abstract shapes */
            .shape {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                z-index: 0;
            }
            .shape-1 {
                top: -10%;
                left: -10%;
                width: 500px;
                height: 500px;
                background: rgba(52, 211, 153, 0.3);
                animation: float 20s infinite ease-in-out;
            }
            .shape-2 {
                bottom: -10%;
                right: -10%;
                width: 600px;
                height: 600px;
                background: rgba(16, 185, 129, 0.2);
                animation: float 25s infinite ease-in-out reverse;
            }
            @keyframes float {
                0% { transform: translate(0, 0); }
                50% { transform: translate(50px, 50px); }
                100% { transform: translate(0, 0); }
            }
            
            .content-card {
                position: relative;
                z-index: 10;
                background: var(--glass);
                backdrop-filter: blur(20px);
                padding: 3rem 4rem;
                border-radius: 2rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
                text-align: center;
                max-width: 500px;
                width: 90%;
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: transform 0.3s ease;
            }
            .content-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            }
            
            .logo-container {
                margin-bottom: 2rem;
                display: flex;
                justify-content: center;
            }
            .logo-img {
                width: 120px;
                height: 120px;
                object-fit: contain;
                border-radius: 50%;
                background: var(--dark);
                padding: 10px;
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
            }
            
            .title {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 0.5rem;
                background: linear-gradient(to right, var(--primary-dark), var(--primary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .subtitle {
                font-size: 1.1rem;
                color: #6B7280;
                margin-bottom: 2.5rem;
            }
            
            .cta-buttons {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: 600;
                border-radius: 0.75rem;
                text-decoration: none;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            
            /* Navbar button specific */
            .nav-btn {
                padding: 0.5rem 1.25rem;
                font-size: 0.85rem;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                color: white;
                box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
            }
            .btn-primary:hover {
                transform: scale(1.02);
                box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
            }
            
            .btn-outline {
                background: transparent;
                color: var(--dark);
                border: 2px solid #E5E7EB;
            }
            .btn-outline:hover {
                border-color: var(--primary);
                color: var(--primary);
                background: rgba(16, 185, 129, 0.05);
            }

            .user-links {
                margin-top: 1rem;
                display: flex;
                justify-content: center;
                gap: 1rem;
            }
            
            .footer-info {
                margin-top: 2rem;
                font-size: 0.8rem;
                color: #9CA3AF;
            }

            /* Responsive */
            @media (min-width: 640px) {
                .cta-buttons {
                    flex-direction: row;
                    justify-content: center;
                }
                .btn {
                    width: auto;
                    min-width: 140px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Top Navbar -->
        <nav class="navbar">
            <span class="nav-brand">
                Pharmacy MS
            </span>
            <div class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary nav-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline nav-btn">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary nav-btn">Register</a>
                @endauth
            </div>
        </nav>

        <div class="hero-section">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            
            <div class="content-card">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/pharmacy_logo.jpg') }}" alt="Pharmacy Logo" class="logo-img">
                </div>
                
                <h1 class="title">Pharmacy MS</h1>
                <p class="subtitle">Professional Pharmaceutical Management</p>
                
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline">Create Account</a>
                    @endauth
                </div>

                <div class="footer-info">
                    Algerian Pharmaceutical Management System
                </div>
            </div>
        </div>
    </body>
</html>
