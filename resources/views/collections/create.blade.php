@extends('layouts.app')

@section('title', 'Create Collection')

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
        background: var(--paper-bg);
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

    /* Page Title */
    .page-title {
        font-family: 'Bangers', cursive;
        font-size: 48px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--dark-bg);
        margin-bottom: 32px;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--graffiti-purple);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Main Card */
    .create-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 48px 40px;
        position: relative;
        margin-bottom: 32px;
    }

    .create-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink), var(--graffiti-yellow));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    /* Form Labels */
    .form-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 16px;
        color: var(--dark-bg);
        margin-bottom: 8px;
        display: block;
    }

    .form-label.required::after {
        content: ' *';
        color: var(--graffiti-pink);
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
        border-color: var(--graffiti-purple);
    }

    .graffiti-input.error {
        border-color: var(--graffiti-pink);
    }

    .graffiti-input::placeholder {
        color: #999;
        font-weight: 500;
    }

    /* Textarea */
    .graffiti-textarea {
        width: 100%;
        padding: 14px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 16px;
        background: white;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        resize: vertical;
        min-height: 100px;
    }

    .graffiti-textarea:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-cyan);
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
    .checkbox-container {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .checkbox-container:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
    }

    .checkbox-container input[type="checkbox"] {
        appearance: none;
        width: 28px;
        height: 28px;
        border: 3px solid #000;
        border-radius: 6px;
        background: white;
        cursor: pointer;
        position: relative;
        transition: all 0.3s;
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
    }

    .checkbox-container input[type="checkbox"]:checked {
        background: var(--graffiti-purple);
    }

    .checkbox-container input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    .checkbox-container input[type="checkbox"]:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
    }

    .checkbox-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 16px;
        color: var(--dark-bg);
        margin-left: 16px;
    }

    /* Buttons */
    .btn-graffiti {
        font-family: 'Permanent Marker', cursive;
        padding: 14px 32px;
        border: 3px solid #000;
        border-radius: 50px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-graffiti:hover {
        transform: translate(-2px, -2px);
        box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.3);
    }

    .btn-graffiti:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    .btn-create {
        background: var(--graffiti-purple);
        color: white;
    }

    .btn-cancel {
        background: white;
        color: var(--dark-bg);
    }

    /* Form Group Spacing */
    .form-group {
        margin-bottom: 28px;
    }

    /* Stickers/Decorations */
    .sticker {
        position: absolute;
        background: white;
        border: 3px solid #000;
        border-radius: 50%;
        padding: 12px;
        font-size: 28px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
        animation: bob 3s ease-in-out infinite;
    }

    @keyframes bob {
        0%, 100% { transform: rotate(12deg) translateY(0); }
        50% { transform: rotate(8deg) translateY(-10px); }
    }

    /* Decorative Corner */
    .corner-doodle {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        opacity: 0.6;
    }

    /* Info Badge */
    .info-badge {
        background: var(--graffiti-cyan);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 32px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .info-badge::before {
        content: '💡';
        position: absolute;
        top: 16px;
        left: 20px;
        font-size: 24px;
    }

    .info-text {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 20px;
        color: var(--dark-bg);
        margin-left: 40px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 36px;
        }

        .create-card {
            padding: 24px;
        }
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-1 { animation-delay: 0.1s; }
</style>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 20px; right: 40px; transform: rotate(-15deg);">
        📁
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-12 fade-in">Create Collection</h1>

    <!-- Info Badge -->
    <div class="info-badge fade-in">
        <p class="info-text">Collections help you organize your favorite artworks in one place!</p>
    </div>

    <!-- Main Form -->
    <div class="create-card fade-in delay-1">
        <!-- Corner Decoration -->
        <svg class="corner-doodle" viewBox="0 0 100 100" fill="none">
            <path d="M10 90 Q 50 50, 90 10" stroke="#8338EC" stroke-width="4"/>
            <circle cx="90" cy="10" r="8" fill="#FFBE0B" stroke="#000" stroke-width="2"/>
            <circle cx="10" cy="90" r="8" fill="#00F5FF" stroke="#000" stroke-width="2"/>
        </svg>

        <form method="POST" action="{{ route('collections.store') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label required">Collection Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="graffiti-input @error('name') error @enderror"
                       placeholder="e.g., My Favorite Street Art"
                       required>
                @error('name')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" 
                          id="description" 
                          class="graffiti-textarea @error('description') error @enderror"
                          placeholder="Tell us what makes this collection special...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💭 Optional, but helps others discover your collection</p>
            </div>

            <!-- Public Checkbox -->
            <div class="form-group">
                <label class="checkbox-container">
                    <input type="checkbox" 
                           name="is_public" 
                           id="is_public" 
                           value="1"
                           {{ old('is_public', true) ? 'checked' : '' }}>
                    <span class="checkbox-label">🌍 Make this collection public</span>
                </label>
                <p class="handwritten text-base text-gray-600 mt-2 ml-2">Public collections can be discovered and viewed by everyone!</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t-4 border-dashed border-gray-200">
                <a href="{{ route('collections.index') }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-create">
                    ✨ Create Collection
                </button>
            </div>
        </form>
    </div>

    <!-- Additional Tips -->
    <div class="mt-8 fade-in delay-1">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 24px;">
            <h3 class="doodle-text text-xl mb-4" style="color: var(--dark-bg);">💡 Quick Tips:</h3>
            <ul class="space-y-2">
                <li class="handwritten text-lg text-gray-700">✓ Give your collection a descriptive name</li>
                <li class="handwritten text-lg text-gray-700">✓ Add artworks later from any artwork page</li>
                <li class="handwritten text-lg text-gray-700">✓ You can edit or delete collections anytime</li>
                <li class="handwritten text-lg text-gray-700">✓ Private collections are only visible to you</li>
            </ul>
        </div>
    </div>
</div>
@endsection