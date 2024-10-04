<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Visitor ID Card</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            width: 3.125in;
            /* Adjusted to make it vertical */
            height: 4.375in;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* padding: 10px; */
        }

        .header {
            background-color: #003366;
            color: white;
            /* padding: 5px; */
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-bottom: 10px;
        }

        .photo {
            width: 100px;
            height: 100px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-left: 50px;
            object-fit: cover;
            align-items: center;
        }

        .details {
            font-size: 12px;
            color: #333;
            text-align: center;
            flex-grow: 1;
            /* Ensures details take up remaining space */
        }

        .details p {
            margin: 5px 0;
        }

        .unique-id {
            font-size: 14px;
            font-weight: bold;
            color: #003366;
        }

        #id-image {
            margin-left: 50px;
        }

        .members {
            font-size: 8px;
            margin-top: 5px;
            padding: 0 5px;
        }
        .members table {
            width: 100%;
            border-collapse: collapse;
        }
        .members th, .members td {
            border: 1px solid #ccc;
            padding: 2px;
            text-align: left;
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
        <div class="header">
            <img src="{{ asset('images/ldeskapp-logo-svg.png') }}" alt="Dnyanshree Institute" style="max-height: 50px;">
        </div>
        <div class="flex justify-center items-center ml-20" id="id-image">
            <img src="{{ public_path('storage/' . $visitor->photo) }}" alt="{{ $visitor->name }}" class="photo">
        </div>
        <div class="details flex">
            <p class="unique-id" style="font-size: 20px; font:bold">ID: {{ $visitor->unique_id }}</p>
            <p><strong>Name:</strong> {{ $visitor->name }}</p>
            <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
            <p><strong>Member Count:</strong> {{ $visitor->member_count }}</p>
            <p><strong>Whom to meet:</strong> {{ $visitor->meetUser ? $visitor->meetUser->name : 'N/A' }}</p>
            <p><strong>Purpose:</strong> {{ Str::limit($visitor->purpose, 30) }}</p>
            <p><strong>Check-in:</strong> {{ $visitor->check_in->format('Y-m-d H:i') }}</p>

        </div>
        @if ($visitor->member_count > 0)
            <div class="members">
                <table>
                    <tr>
                        <th>Member</th>
                        <th>Name</th>
                    </tr>
                    @if ($visitor->member1)
                        <tr>
                            <td>1</td>
                            <td>{{ Str::limit($visitor->member1, 15) }}</td>
                        </tr>
                    @endif
                    @if ($visitor->member2)
                        <tr>
                            <td>2</td>
                            <td>{{ Str::limit($visitor->member2, 15) }}</td>
                        </tr>
                    @endif
                    @if ($visitor->member3)
                        <tr>
                            <td>3</td>
                            <td>{{ Str::limit($visitor->member3, 15) }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        @endif


        <div class="footer">
            This ID card is valid only for the date of issue. Please return this card upon check-out.
        </div>
    </div>
</body>

</html>
