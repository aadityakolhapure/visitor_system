<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .photo { width: 200px; height: auto; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Visitor Details</h1>
        </div>
        <div class="details">
            <img src="{{ public_path('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="photo">
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Email:</strong> {{ $visitor->email }}</p>
            <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
            <p><strong>Unique ID:</strong> {{ $visitor->unique_id }}</p>
        </div>
    </div>
</body>
</html>