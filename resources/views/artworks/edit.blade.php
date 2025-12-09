@extends('layouts.app')

@section('title', 'Edit Artwork')

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
        padding: 48px 40px;
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
        background: linear-gradient(135deg, var(--graffiti-cyan), var(--graffiti-green), var(--graffiti-yellow));
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
        border-color: var(--graffiti-green);
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

    /* Current Image Display */
    .current-image-container {
        background: var(--paper-bg);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
    }

    .current-image-container::before {
        content: '🖼️';
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 24px;
        opacity: 0.5;
    }

    .current-image {
        max-width: 300px;
        width: 100%;
        height: auto;
        border: 4px solid #000;
        border-radius: 12px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
        display: block;
    }

    /* File Input Styled */
    .file-input-wrapper {
        position: relative;
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

    input[type="file"] {
        display: none;
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
        background: var(--graffiti-yellow);
        border: 3px solid #000;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 32px;
        box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .info-badge::before {
        content: '✏️';
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

    /* Preview for new image */
    .preview-image {
        max-width: 300px;
        margin-top: 16px;
        border: 4px solid #000;
        border-radius: 12px;
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 36px;
        }

        .edit-card {
            padding: 24px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .current-image {
            max-width: 100%;
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
        ✏️
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-12 fade-in text-center">Edit Artwork</h1>

    <!-- Info Badge -->
    <div class="info-badge fade-in">
        <p class="info-text">Update your artwork details and make it shine! ✨</p>
    </div>

    <!-- Main Form -->
    <div class="edit-card fade-in delay-1">
        <form method="POST" action="{{ route('artworks.update', $artwork) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label required">Title</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $artwork->title) }}"
                       class="graffiti-input @error('title') error @enderror"
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
                          class="graffiti-textarea @error('description') error @enderror">{{ old('description', $artwork->description) }}</textarea>
                @error('description')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💭 Update your story or add more details</p>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category_id" class="form-label required">Category</label>
                <select name="category_id" 
                        id="category_id" 
                        class="graffiti-select @error('category_id') error @enderror" 
                        required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image -->
            <div class="form-group">
                <label class="form-label">Current Image</label>
                <div class="current-image-container">
                    <img src="{{ $artwork->image_url }}" 
                         alt="{{ $artwork->title }}" 
                         class="current-image"
                         id="currentImage">
                    <p class="handwritten text-lg text-gray-600 mt-3">This is your current artwork image</p>
                </div>

                <label for="image" class="form-label">Replace Image (Optional)</label>
                <label for="image" class="file-label">
                    📸 Choose New Image
                </label>
                <input id="image" 
                       name="image" 
                       type="file" 
                       accept="image/*">
                @error('image')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💡 Leave empty to keep current image</p>
            </div>

            <!-- Medium & Tags -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="medium" class="form-label">Medium</label>
                    <input type="text" 
                           name="medium" 
                           id="medium" 
                           value="{{ old('medium', $artwork->medium) }}"
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
                           value="{{ old('tags', is_array($artwork->tags) ? implode(', ', $artwork->tags) : '') }}"
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
                <a href="{{ route('artworks.show', $artwork) }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-save">
                    💾 Update Artwork
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview new image selection
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const container = document.querySelector('.current-image-container');
                
                // Check if preview already exists
                let preview = document.getElementById('newImagePreview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'newImagePreview';
                    preview.className = 'preview-image';
                    
                    const label = document.createElement('p');
                    label.className = 'handwritten text-lg text-gray-700 mt-3';
                    label.innerHTML = '✅ New image selected! This will replace the current one';
                    label.id = 'newImageLabel';
                    
                    container.appendChild(preview);
                    container.appendChild(label);
                }
                
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection