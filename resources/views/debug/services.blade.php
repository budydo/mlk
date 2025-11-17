<!DOCTYPE html>
<html>
<head>
    <title>Debug Services</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .service { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; }
        .image-preview { max-width: 300px; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Debug: Semua Services yang Dipublikasikan</h1>
    
    @forelse($services as $service)
        <div class="service">
            <h3>{{ $service->title }}</h3>
            <p><strong>ID:</strong> {{ $service->id }}</p>
            <p><strong>Slug:</strong> {{ $service->slug }}</p>
            <p><strong>Image Path:</strong> {{ $service->image_path }}</p>
            
            @if($service->image_path)
                <p><strong>Generated URL:</strong> {{ imageUrl($service->image_path) }}</p>
                <img src="{{ imageUrl($service->image_path) }}" alt="{{ $service->title }}" class="image-preview" onerror="this.alt='IMAGE NOT FOUND'">
            @else
                <p><em>No image path</em></p>
            @endif
            
            <p><strong>Is Published:</strong> {{ $service->is_published ? 'Yes' : 'No' }}</p>
        </div>
    @empty
        <p>No services found.</p>
    @endforelse
</body>
</html>
