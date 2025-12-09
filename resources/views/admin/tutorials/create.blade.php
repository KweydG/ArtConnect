@extends('layouts.admin')

@section('title', 'Add Tutorial')

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
        background: var(--graffiti-purple);
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
        background: linear-gradient(135deg, var(--graffiti-purple), var(--graffiti-pink), var(--graffiti-cyan));
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
    }

    .graffiti-textarea:focus {
        outline: none;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
        border-color: var(--graffiti-cyan);
    }

    .graffiti-textarea.small {
        min-height: 80px;
    }

    .graffiti-textarea.large {
        min-height: 250px;
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
        border-color: var(--graffiti-orange);
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
        content: '📚';
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
<div class="max-w-4xl relative">
    <!-- Decorative Sticker -->
    <div class="sticker" style="top: 20px; right: -10px; animation-delay: -1s;">
        📖
    </div>

    <!-- Page Title -->
    <h1 class="page-title mb-8 fade-in">Add Tutorial</h1>

    <!-- Info Badge -->
    <div class="info-badge fade-in">
        <p class="info-text">Create a new tutorial to help artists learn!</p>
    </div>

    <!-- Main Form -->
    <div class="form-card fade-in delay-1">
        <form method="POST" action="{{ route('admin.tutorials.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label required">Tutorial Title</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}"
                       class="graffiti-input"
                       placeholder="e.g., How to Paint Realistic Portraits"
                       required>
                @error('title')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label required">Short Description</label>
                <textarea name="description" 
                          id="description" 
                          class="graffiti-textarea small"
                          placeholder="Brief overview of what students will learn..."
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">💭 This appears in the tutorial listing</p>
            </div>

            <!-- Content -->
            <div class="form-group">
                <label for="content" class="form-label required">Full Tutorial Content</label>
                <textarea name="content" 
                          id="content" 
                          class="graffiti-textarea large"
                          placeholder="Write the complete tutorial content here..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="error-message">⚠️ {{ $message }}</p>
                @enderror
                <p class="handwritten text-base text-gray-600 mt-2">✍️ Step-by-step instructions, tips, and techniques</p>
            </div>

            <!-- Category & Difficulty -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="category_id" class="form-label required">Category</label>
                    <select name="category_id" 
                            id="category_id" 
                            class="graffiti-select" 
                            required>
                        <option value="">📂 Select Category</option>
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

                <div class="form-group">
                    <label for="difficulty" class="form-label required">Difficulty Level</label>
                    <select name="difficulty" 
                            id="difficulty" 
                            class="graffiti-select" 
                            required>
                        <option value="beginner" {{ old('difficulty') == 'beginner' ? 'selected' : '' }}>🟢 Beginner</option>
                        <option value="intermediate" {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>🟡 Intermediate</option>
                        <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>🔴 Advanced</option>
                    </select>
                    @error('difficulty')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Duration & Cover Image -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="duration" class="form-label required">Duration (minutes)</label>
                    <input type="number" 
                           name="duration" 
                           id="duration" 
                           value="{{ old('duration', 15) }}"
                           min="1" 
                           max="180" 
                           class="graffiti-input"
                           placeholder="e.g., 30"
                           required>
                    @error('duration')
                        <p class="error-message">⚠️ {{ $message }}</p>
                    @enderror
                    <p class="handwritten text-sm text-gray-600 mt-1">⏱️ Estimated time to complete</p>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Cover Image</label>
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
                    <p class="handwritten text-sm text-gray-600 mt-1">🖼️ Optional thumbnail image</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-end gap-4 pt-6 border-t-4 border-dashed border-gray-200">
                <a href="{{ route('admin.tutorials.index') }}" class="btn-graffiti btn-cancel">
                    ← Cancel
                </a>
                <button type="submit" class="btn-graffiti btn-create">
                    📚 Create Tutorial
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 fade-in delay-1">
        <div style="background: white; border: 3px dashed #000; border-radius: 16px; padding: 24px;">
            <h3 class="doodle-text text-xl mb-4" style="color: var(--dark-bg);">💡 Tutorial Tips:</h3>
            <ul class="space-y-2">
                <li class="handwritten text-lg text-gray-700">✓ Break down complex techniques into simple steps</li>
                <li class="handwritten text-lg text-gray-700">✓ Use clear, descriptive language that beginners can understand</li>
                <li class="handwritten text-lg text-gray-700">✓ Include tips for common mistakes to avoid</li>
                <li class="handwritten text-lg text-gray-700">✓ Add a compelling cover image to attract learners</li>
                <li class="handwritten text-lg text-gray-700">✓ Set realistic duration estimates</li>
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