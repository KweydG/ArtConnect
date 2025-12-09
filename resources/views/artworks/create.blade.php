@extends('layouts.app')

@section('title', 'Upload Artwork')

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
        background: var(--graffiti-pink);
        transform: skew(-12deg);
        border: 2px solid #000;
    }

    /* Main Card */
    .upload-card {
        background: white;
        border: 4px solid #000;
        border-radius: 16px;
        box-shadow: 10px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 48px 40px;
        position: relative;
        margin-bottom: 32px;
    }

    .upload-card::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        background: linear-gradient(135deg, var(--graffiti-pink), var(--graffiti-cyan), var(--graffiti-yellow));
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
        border-color: var(--graffiti-pink);
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
        border-color: var(--graffiti-cyan);
    }

    /* Select Dropdown */
    .graffiti-select {
        width: 100%;
        padding: 14px 20px;
        border: 3px solid #000;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23000'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 40px;
    }

    .graffiti-select:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-purple);
    }

    /* File Upload Area */
    .upload-area {
        border: 4px dashed #000;
        border-radius: 16px;
        padding: 48px 32px;
        text-align: center;
        background: var(--paper-bg);
        transition: all 0.3s;
        cursor: pointer;
        position: relative;
    }

    .upload-area:hover {
        background: var(--graffiti-yellow);
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.1);
    }

    .upload-area::before {
        content: '📷';
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 32px;
        opacity: 0.3;
    }

    .upload-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border: 3px solid #000;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .upload-icon svg {
        width: 40px;
        height: 40px;
        stroke: var(--graffiti-pink);
        stroke-width: 2.5;
    }

    .upload-label {
        font-family: 'Permanent Marker', cursive;
        font-size: 18px;
        color: var(--graffiti-pink);
        cursor: pointer;
    }

    .upload-label:hover {
        color: var(--graffiti-purple);
    }

    /* Preview Image */
    .preview-image {
        max-height: 300px;
        margin: 24px auto 0;
        border: 4px solid #000;
        border-radius: 12px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
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

    .btn-upload {
        background: var(--graffiti-pink);
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

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
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

    /* Stickers */
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

        .upload-card {
            padding: 24px;
        }

        .form-grid {
            grid-template-columns: 1fr;
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
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
    <!-- Decorative Stickers -->
    <div class="sticker" style="top: 20px; right: 5%; transform: rotate(-15deg);">
        🎨
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-12 fade-in text-center">Upload Your Artwork</h1>

    <!-- Info Badge -->
    <div class="info-badge fade-in">
        <p class="info-text">Share your creativity with the world! Upload your masterpiece below 🚀</p>
    </div>

    <!-- Main Form -->
    <div class="upload-card fade-in delay-1">
        <form method="POST" action="{{ route('artworks.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label required">Title</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}"
                       class="graffiti-input @error('title') error @enderror"
                       placeholder="Give your artwork a name..."
                       required>
                @error('title')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" 
                          id="description" 
                          class="graffiti-textarea @error('description') error @enderror"
                          placeholder="Tell us about your artwork, your inspiration, technique...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💭 Share your story behind the art</p>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category_id" class="form-label required">Category</label>
                <select name="category_id" 
                        id="category_id"
                        class="graffiti-select @error('category_id') error @enderror" 
                        required>
                    <option value="">📂 Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image" class="form-label required">Artwork Image</label>
                <div class="upload-area" onclick="document.getElementById('image').click()">
                    <div class="upload-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="handwritten text-2xl text-gray-700 mb-2">
                        <span class="upload-label">Click to upload</span> or drag and drop
                    </p>
                    <p class="handwritten text-lg text-gray-600">PNG, JPG, GIF, WEBP up to 5MB</p>
                    <input id="image" 
                           name="image" 
                           type="file" 
                           class="hidden" 
                           accept="image/*" 
                           required>
                </div>
                @error('image')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Medium & Tags -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="medium" class="form-label">Medium</label>
                    <input type="text" 
                           name="medium" 
                           id="medium" 
                           value="{{ old('medium') }}"
                           placeholder="e.g., Oil on Canvas, Digital"
                           class="graffiti-input @error('medium') error @enderror">
                    @error('medium')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" 
                           name="tags" 
                           id="tags" 
                           value="{{ old('tags') }}"
                           placeholder="abstract, colorful, modern"
                           class="graffiti-input @error('tags') error @enderror">
                    <p class="handwritten text-sm text-gray-600 mt-1">🏷️ Separate with commas</p>
                    @error('tags')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t-4 border-dashed border-gray-200">
                <a href="{{ route('home') }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-upload">
                    🚀 Upload Artwork
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 fade-in delay-1">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 24px;">
            <h3 class="doodle-text text-xl mb-4" style="color: var(--dark-bg);">✨ Upload Tips:</h3>
            <ul class="space-y-2">
                <li class="handwritten text-lg text-gray-700">📸 Use high-quality images for best results</li>
                <li class="handwritten text-lg text-gray-700">📝 Add detailed descriptions to help others discover your work</li>
                <li class="handwritten text-lg text-gray-700">🏷️ Use relevant tags to increase visibility</li>
                <li class="handwritten text-lg text-gray-700">🎨 Choose the most appropriate category for your art</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview image before upload
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const uploadArea = document.querySelector('.upload-area');
                
                // Check if preview already exists
                let preview = uploadArea.querySelector('.preview-image');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.className = 'preview-image';
                    uploadArea.appendChild(preview);
                }
                
                preview.src = e.target.result;
                
                // Update upload area text
                const handwrittenText = uploadArea.querySelector('.handwritten');
                if (handwrittenText) {
                    handwrittenText.innerHTML = '✅ Image selected! Click to change';
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection