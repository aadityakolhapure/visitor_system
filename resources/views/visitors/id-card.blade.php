<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <title>Visitor ID Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .id-card {
            width: 3.125in; /* Adjusted to make it vertical */
            height: 4.375in;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .header {
            background-color: #003366;
            color: white;
            padding: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-bottom: 10px;
        }
        .photo {
            width: 200px;
            height: 200px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            object-fit: cover;
            align-items: center;
        }
        .details {
            font-size: 12px;
            color: #333;
            text-align: center;
            flex-grow: 1; /* Ensures details take up remaining space */
        }
        .details p {
            margin: 5px 0;
        }
        .unique-id {
            font-size: 14px;
            font-weight: bold;
            color: #003366;
        }
        .footer {
            background-color: #003366;
            color: white;
            padding: 5px;
            text-align: center;
            font-size: 8px;
            width: 100%;
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="id-card flex items-center">
        <div class="header">VISITOR ID CARD</div>
        <div class="flex justify-center items-center">
            <img src="{{ public_path('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="photo">
        </div>
        <div class="details flex">
            <p class="unique-id" style="font-size: 20px; font:bold">ID: {{ $visitor->unique_id }}</p>
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
            <p><strong>Whom to meet:</strong> {{ $visitor->phone }}</p>
            <p><strong>Purpose:</strong> {{ Str::limit($visitor->purpose, 30) }}</p>
            <p><strong>Check-in:</strong> {{ $visitor->check_in->format('Y-m-d H:i') }}</p>
            
        </div>
        <div class="footer">
            This ID card is valid only for the date of issue. Please return this card upon check-out.
        </div>
    </div>
</body>
</html>
