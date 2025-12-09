@extends('layouts.admin')

@section('title', 'Add Category')

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
        background: var(--graffiti-green);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Main Card */
    .form-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-green), var(--graffiti-cyan), var(--graffiti-yellow));
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
        border-color: var(--graffiti-green);
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

    /* File Input */
    .file-input-wrapper {
        position: relative;
    }

    .file-label {
        padding: 14px 24px;
        border: 3px dashed #000;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
        font-family: 'Permanent Marker', cursive;
        font-size: 14px;
        color: var(--dark-bg);
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .file-label:hover {
        background: var(--graffiti-yellow);
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
    }

    input[type="file"] {
        display: none;
    }

    .file-name {
        font-family: 'Caveat', cursive;
        font-weight: 700;
        font-size: 18px;
        color: var(--dark-bg);
        margin-top: 8px;
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
        background: var(--graffiti-green);
        color: var(--dark-bg);
    }

    .btn-cancel {
        background: white;
        color: var(--dark-bg);
    }

    /* Form Group Spacing */
    .form-group {
        margin-bottom: 28px;
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

    /* Sticker */
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

        .form-card {
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
<div class="max-w-3xl relative">
    <!-- Decorative Sticker -->
    <div class="sticker" style="top: 20px; right: -10px; animation-delay: -1s;">
        📂
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-8 fade-in">Add Category</h1>

    <!-- Info Badge -->
    <div class="info-badge fade-in">
        <p class="info-text">Create a new category to organize artworks!</p>
    </div>

    <!-- Main Form -->
    <div class="form-card fade-in delay-1">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label required">Category Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="graffiti-input"
                       placeholder="e.g., Digital Art, Oil Painting..."
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
                          class="graffiti-textarea"
                          placeholder="Describe this category...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💭 Optional, but helps users understand the category</p>
            </div>

            <!-- Image -->
            <div class="form-group">
                <label for="image" class="form-label">Category Image</label>
                <div class="file-input-wrapper">
                    <label for="image" class="file-label">
                        📷 Choose Image
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*">
                    <p class="file-name" id="fileName">No file chosen</p>
                </div>
                @error('image')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">🖼️ Optional icon/image for the category</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t-4 border-dashed border-gray-200">
                <a href="{{ route('admin.categories.index') }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-create">
                    ✨ Create Category
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 fade-in delay-1">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 24px;">
            <h3 class="doodle-text text-xl mb-4" style="color: var(--dark-bg);">💡 Category Tips:</h3>
            <ul class="space-y-2">
                <li class="handwritten text-lg text-gray-700">✓ Use clear, descriptive names</li>
                <li class="handwritten text-lg text-gray-700">✓ Keep descriptions concise and helpful</li>
                <li class="handwritten text-lg text-gray-700">✓ Add an icon to make it more recognizable</li>
                <li class="handwritten text-lg text-gray-700">✓ Categories help users discover art by style</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Show selected file name
    document.getElementById('image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'No file chosen';
        document.getElementById('fileName').textContent = fileName;
    });
</script>
@endpush
@endsection