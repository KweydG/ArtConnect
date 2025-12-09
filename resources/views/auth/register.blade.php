@extends('layouts.app')

@section('title', 'Register')

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
        background: linear-gradient(135deg, #ffeaa7 0%, var(--paper-bg) 100%);
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

    /* Container */
    .register-container {
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

    /* Main Register Card */
    .register-card {
        background: white;
        border: 4px solid #000;
        border-radius: 20px;
        box-shadow: 12px 12px 0px rgba(0, 0, 0, 0.15);
        padding: 48px 40px;
        position: relative;
        max-width: 520px;
        width: 100%;
        z-index: 10;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-green), var(--graffiti-cyan), var(--graffiti-purple));
        border-radius: 20px;
        z-index: -1;
        opacity: 0.5;
    }

    /* Join Title */
    .join-title {
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

    .join-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%) skew(-12deg);
        width: 70%;
        height: 6px;
        background: var(--graffiti-green);
        border: 2px solid #000;
    }

    .join-subtitle {
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
        border-color: var(--graffiti-green);
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
        background: var(--graffiti-green);
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

    /* Sign In Link */
    .signin-text {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 20px;
        color: #666;
        text-align: center;
        margin-top: 24px;
    }

    .signin-link {
        color: var(--graffiti-purple);
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
        border-bottom: 2px solid var(--graffiti-purple);
    }

    .signin-link:hover {
        color: var(--graffiti-pink);
        border-bottom-color: var(--graffiti-pink);
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

    /* Benefits Badge */
    .benefits-badge {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px;
        margin-top: 24px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .benefits-title {
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: var(--dark-bg);
        margin-bottom: 12px;
        text-align: center;
    }

    .benefit-item {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 16px;
        color: #666;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .register-card {
            padding: 32px 24px;
        }

        .join-title {
            font-size: 36px;
        }

        .join-subtitle {
            font-size: 20px;
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
<div class="register-container">
    <!-- Background Spray Paint Effects -->
    <div class="spray-circle" style="background: var(--graffiti-green); width: 400px; height: 400px; top: -100px; right: -100px;"></div>
    <div class="spray-circle" style="background: var(--graffiti-purple); width: 350px; height: 350px; top: 50%; left: -80px; animation-delay: -2s;"></div>
    <div class="spray-circle" style="background: var(--graffiti-yellow); width: 300px; height: 300px; bottom: -50px; right: 30%; animation-delay: -4s;"></div>

    <!-- SVG Doodles -->
    <svg class="doodle-bg" style="top: 12%; right: 5%; width: 150px; height: 150px;" viewBox="0 0 100 100" fill="none">
        <circle cx="50" cy="50" r="30" stroke="#000" stroke-width="3"/>
        <circle cx="50" cy="50" r="15" fill="#06FFA5" stroke="#000" stroke-width="2"/>
    </svg>

    <svg class="doodle-bg" style="bottom: 18%; left: 8%; width: 140px; height: 140px;" viewBox="0 0 100 100" fill="none">
        <path d="M30 70 Q 50 30, 70 70" stroke="#000" stroke-width="3" fill="none"/>
        <circle cx="30" cy="70" r="8" fill="#8338EC" stroke="#000" stroke-width="2"/>
        <circle cx="70" cy="70" r="8" fill="#FFBE0B" stroke="#000" stroke-width="2"/>
    </svg>

    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 10%; left: 5%; animation-delay: -1s;">
        🎭
    </div>

    <div class="sticker" style="bottom: 15%; right: 8%; animation-delay: -3s;">
        🖌️
    </div>

    <!-- Register Card -->
    <div class="register-card fade-in">
        <div class="text-center mb-8">
            <h2 class="join-title">Join ArtConnect</h2>
            <p class="join-subtitle">Create your free account and start sharing your art!</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="graffiti-input @error('name') error @enderror"
                       placeholder="Your awesome name"
                       required 
                       autofocus>
                @error('name')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}"
                       class="graffiti-input @error('email') error @enderror"
                       placeholder="your@email.com"
                       required>
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

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation"
                       class="graffiti-input"
                       placeholder="••••••••"
                       required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-graffiti">
                🎨 Create My Account
            </button>
        </form>

        <!-- Sign In Link -->
        <p class="signin-text">
            Already have an account? 
            <a href="{{ route('login') }}" class="signin-link">Sign in here!</a>
        </p>

        <!-- Benefits Section -->
        <div class="benefits-badge">
            <p class="benefits-title">✨ What you'll get:</p>
            <div class="benefit-item">
                ✓ Share unlimited artworks
            </div>
            <div class="benefit-item">
                ✓ Connect with artists worldwide
            </div>
            <div class="benefit-item">
                ✓ Learn from tutorials
            </div>
            <div class="benefit-item">
                ✓ Build your portfolio
            </div>
        </div>
    </div>
</div>
@endsection