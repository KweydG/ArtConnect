@extends('layouts.app')

@section('title', 'Edit Profile')

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
        background: var(--graffiti-cyan);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Main Card */
    .edit-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 40px;
        position: relative;
        margin-bottom: 32px;
    }

    .edit-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-cyan), var(--graffiti-yellow), var(--graffiti-pink));
        border-radius: 16px;
        z-index: -1;
        opacity: 0.3;
    }

    /* Avatar Section */
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 24px;
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 16px;
        margin-bottom: 32px;
    }

    .avatar-frame {
        position: relative;
    }

    .avatar-frame img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #000;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        object-fit: cover;
    }

    .avatar-frame::after {
        content: '📸';
        position: absolute;
        bottom: -5px;
        right: -5px;
        width: 40px;
        height: 40px;
        background: var(--graffiti-yellow);
        border: 3px solid #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
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
        border-color: var(--graffiti-cyan);
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
        min-height: 120px;
    }

    .graffiti-textarea:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* File Input */
    .file-input-wrapper {
        position: relative;
    }

    .graffiti-file-input {
        padding: 12px 20px;
        border: 3px dashed #000;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
    }

    .graffiti-file-input:hover {
        background: var(--graffiti-yellow);
        transform: translateY(-2px);
    }

    input[type="file"] {
        display: none;
    }

    .file-label {
        padding: 12px 24px;
        border: 3px dashed #000;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: var(--dark-bg);
    }

    .file-label:hover {
        background: var(--graffiti-yellow);
        transform: translateY(-2px);
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

    .btn-save {
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .btn-cancel {
        background: white;
        color: var(--dark-bg);
    }

    .btn-delete {
        background: var(--graffiti-pink);
        color: white;
    }

    /* Danger Zone */
    .danger-card {
        background: white;
        border: 4px solid var(--graffiti-pink);
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(255, 0, 110, 0.2);
        padding: 40px;
        position: relative;
    }

    .danger-card::before {
        content: '⚠️';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 40px;
        opacity: 0.3;
    }

    .danger-title {
        font-family: 'Bangers', cursive;
        font-size: 32px;
        color: var(--graffiti-pink);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .danger-description {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 22px;
        color: #666;
        margin-bottom: 24px;
    }

    /* Form Group Spacing */
    .form-group {
        margin-bottom: 28px;
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 36px;
        }

        .edit-card {
            padding: 24px;
        }

        .avatar-section {
            flex-direction: column;
            text-align: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .danger-card {
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
    .delay-2 { animation-delay: 0.2s; }
</style>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 20px; right: 20px; transform: rotate(-15deg);">
        ✏️
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-12 fade-in">Edit Profile</h1>

    <!-- Main Form -->
    <div class="edit-card fade-in delay-1">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Avatar Section -->
            <div class="avatar-section">
                <div class="avatar-frame">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" id="avatar-preview">
                </div>
                <div class="flex-1">
                    <label class="form-label">Change Avatar</label>
                    <label for="avatar" class="file-label">
                        📸 Choose New Photo
                    </label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" onchange="previewAvatar(event)">
                    @error('avatar')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                    <p class="handwritten text-base text-gray-600 mt-2">JPG, PNG or GIF. Max 2MB</p>
                </div>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label required">Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $user->name) }}"
                       class="graffiti-input @error('name') error @enderror" 
                       required>
                @error('name')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label required">Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email', $user->email) }}"
                       class="graffiti-input @error('email') error @enderror" 
                       required>
                @error('email')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div class="form-group">
                <label for="bio" class="form-label">Bio</label>
                <textarea name="bio" 
                          id="bio" 
                          class="graffiti-textarea @error('bio') error @enderror"
                          placeholder="Tell us about yourself and your art...">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Website & Location -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" 
                           name="website" 
                           id="website" 
                           value="{{ old('website', $user->website) }}"
                           placeholder="https://yourwebsite.com"
                           class="graffiti-input @error('website') error @enderror">
                    @error('website')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location', $user->location) }}"
                           placeholder="City, Country"
                           class="graffiti-input @error('location') error @enderror">
                    @error('location')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t-4 border-dashed border-gray-200">
                <a href="{{ route('artists.show', $user) }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-save">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="danger-card fade-in delay-2">
        <h2 class="danger-title">Danger Zone</h2>
        <p class="danger-description">Once you delete your account, there is no going back. Please be certain! 💀</p>

        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('⚠️ Are you ABSOLUTELY sure you want to delete your account? All your artworks and data will be permanently deleted! This action CANNOT be undone!')">
            @csrf
            @method('DELETE')

            <div class="form-group" style="max-width: 400px;">
                <label for="password" class="form-label required">Confirm Password</label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="graffiti-input @error('password') error @enderror" 
                       placeholder="Enter your password"
                       required>
                @error('password')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-graffiti btn-delete">
                🗑️ Delete Account Forever
            </button>
        </form>
    </div>
</div>

<script>
function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection