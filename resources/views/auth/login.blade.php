@extends('layouts.app')

@section('title', 'Login')

@section('head')
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Caveat:wght@700&family=Bangers&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --graffiti-pink: #FF006E;
        --graffiti-yellow: #FFBE0B;
        --graffiti-cyan: #00F5FF;
        --graffiti-orange: #FF6B35;
        --graffiti-purple: #8338EC;
        --graffiti-green: #06FFA5;
        --dark-bg: #1a1a2e;
        --paper-bg: #f5f3ee;
    }

    body {
        background: linear-gradient(135deg, var(--paper-bg) 0%, #ffeaa7 100%);
        position: relative;
        overflow-x: hidden;
    }

    /* Graffiti Typography */
    .graffiti-title {
        font-family: 'Bangers', cursive;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .doodle-text {
        font-family: 'Permanent Marker', cursive;
    }

    .handwritten {
        font-family: 'Caveat', cursive;
        font-weight: 700;
    }

    /* Container with floating background */
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 16px;
        position: relative;
    }

    /* Spray Paint Effects */
    .spray-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        animation: float 8s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-30px) scale(1.1); }
    }

    /* Main Login Card */
    .login-card {
        background: white;
        border: 4px solid #000;
        border-radius: 20px;
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.15);
        padding: 48px 40px;
        position: relative;
        max-width: 480px;
        width: 100%;
        z-index: 10;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-yellow));
        border-radius: 20px;
        z-index: -1;
        opacity: 0.5;
    }

    /* Welcome Title */
    .welcome-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        color: var(--dark-bg);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 8px;
        text-align: center;
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .welcome-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%) skew(-12deg);
        width: 60%;
        height: 6px;
        background: var(--graffiti-yellow);
        border: 2px solid #000;
    }

    .welcome-subtitle {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 24px;
        color: #666;
        text-align: center;
        margin-bottom: 40px;
    }

    /* Form Labels */
    .form-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 15px;
        color: var(--dark-bg);
        margin-bottom: 8px;
        display: block;
    }

    /* Form Inputs */
    .graffiti-input {
        width: 100%;
        padding: 14px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 16px;
        background: white;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .graffiti-input:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-cyan);
    }

    .graffiti-input.error {
        border-color: var(--graffiti-pink);
    }

    .graffiti-input::placeholder {
        color: #999;
        font-weight: 500;
    }

    /* Error Messages */
    .error-message {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 18px;
        color: var(--graffiti-pink);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Custom Checkbox */
    .custom-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .custom-checkbox input[type="checkbox"] {
        appearance: none;
        width: 24px;
        height: 24px;
        border: 3px solid #000;
        border-radius: 6px;
        background: white;
        cursor: pointer;
        position: relative;
        transition: all 0.3s;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
    }

    .custom-checkbox input[type="checkbox"]:checked {
        background: var(--graffiti-cyan);
    }

    .custom-checkbox input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        font-weight: bold;
        color: var(--dark-bg);
    }

    .custom-checkbox input[type="checkbox"]:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .checkbox-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: #666;
        margin-left: 12px;
    }

    /* Submit Button */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 16px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        width: 100%;
        background: var(--graffiti-yellow);
        color: var(--dark-bg);
    }

    .btn-graffiti::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .btn-graffiti:hover::before {
        left: 100%;
    }

    .btn-graffiti:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-graffiti:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    /* Sign Up Link */
    .signup-text {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 20px;
        color: #666;
        text-align: center;
        margin-top: 24px;
    }

    .signup-link {
        color: var(--graffiti-cyan);
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
        border-bottom: 2px solid var(--graffiti-cyan);
    }

    .signup-link:hover {
        color: var(--graffiti-pink);
        border-bottom-color: var(--graffiti-pink);
    }

    /* Demo Accounts Section */
    .demo-section {
        margin-top: 32px;
        padding-top: 32px;
        border-top: 3px dashed #000;
    }

    .demo-title {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: #999;
        text-align: center;
        margin-bottom: 16px;
    }

    .demo-account {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .demo-account:hover {
        transform: translateX(4px);
        box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.15);
    }

    .demo-role {
        color: var(--dark-bg);
        font-family: 'Permanent Marker', cursive;
    }

    .demo-credentials {
        color: #666;
        font-family: 'Courier New', monospace;
        font-size: 12px;
    }

    /* Stickers/Decorations */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 16px;
        font-size: 32px;
        box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.2);
        animation: bob 4s ease-in-out infinite;
        z-index: 5;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(-8deg) translateY(-15px); }
    }

    /* SVG Doodles */
    .doodle-bg {
        position: absolute;
        pointer-events: none;
        opacity: 0.15;
    }

    /* Form Group Spacing */
    .form-group {
        margin-bottom: 24px;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .login-card {
            padding: 32px 24px;
        }

        .welcome-title {
            font-size: 36px;
        }

        .welcome-subtitle {
            font-size: 20px;
        }

        .demo-account {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <!-- Background Spray Paint Effects -->
    <div class="spray-circle" style="background: var(--graffiti-pink); width: 400px; height: 400px; top: -100px; left: -100px;"></div>
    <div class="spray-circle" style="background: var(--graffiti-cyan); width: 350px; height: 350px; top: 50%; right: -80px; animation-delay: -2s;"></div>
    <div class="spray-circle" style="background: var(--graffiti-purple); width: 300px; height: 300px; bottom: -50px; left: 30%; animation-delay: -4s;"></div>

    <!-- SVG Doodles -->
    <svg class="doodle-bg" style="top: 10%; left: 5%; width: 150px; height: 150px;" viewBox="0 0 100 100" fill="none">
        <path d="M20 50 Q 35 20, 50 50 T 80 50" stroke="#000" stroke-width="3"/>
        <circle cx="50" cy="30" r="8" fill="#FFBE0B" stroke="#000" stroke-width="2"/>
    </svg>

    <svg class="doodle-bg" style="bottom: 15%; right: 8%; width: 120px; height: 120px;" viewBox="0 0 100 100" fill="none">
        <path d="M50 10 L60 35 L85 45 L60 55 L50 80 L40 55 L15 45 L40 35 Z" fill="#00F5FF" stroke="#000" stroke-width="2"/>
    </svg>

    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 15%; left: 8%; animation-delay: -1s;">
        🎨
    </div>

    <div class="sticker" style="bottom: 20%; right: 10%; animation-delay: -3s;">
        ✨
    </div>

    <!-- Login Card -->
    <div class="login-card fade-in">
        <div class="text-center mb-8">
            <h2 class="welcome-title">Welcome Back!</h2>
            <p class="welcome-subtitle">Sign in to your ArtConnect account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}"
                       class="graffiti-input @error('email') error @enderror"
                       placeholder="your@email.com"
                       required 
                       autofocus>
                @error('email')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       name="password" 
                       id="password"
                       class="graffiti-input @error('password') error @enderror"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember">
                    <span class="checkbox-label">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-graffiti">
                🚀 Sign In
            </button>
        </form>

        <!-- Sign Up Link -->
        <p class="signup-text">
            Don't have an account? 
            <a href="{{ route('register') }}" class="signup-link">Sign up here!</a>
        </p>

        <!-- Demo Accounts -->
        <div class="demo-section">
            <p class="demo-title">🎭 Demo Accounts for Testing:</p>
            <div class="demo-account">
                <span class="demo-role">👑 Admin:</span>
                <span class="demo-credentials">admin@artconnect.com / password</span>
            </div>
            <div class="demo-account">
                <span class="demo-role">👤 User:</span>
                <span class="demo-credentials">maria@artconnect.com / password</span>
            </div>
        </div>
    </div>
</div>
@endsection