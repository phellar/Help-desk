<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket Created</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            width: 90%;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #2563eb;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 25px;
            color: #333;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            background-color: #f1f1f1;
            padding: 15px;
            font-size: 13px;
            color: #555;
        }
        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Ticket Created Successfully</h2>
        </div>

        <div class="content">
            <p>Hi {{ Auth::user()->name ?? 'User' }},</p>
            
            <p>Thank you for contacting our support team. A support ticket has been opened for your request, 
            Our team will review it and get back to you as soon as possible through email. 
            The details of your ticket are shown below</p>

            <p><strong>Ticket Details:</strong></p>
            <ul>
                <li><strong>Subject:</strong> {{ $ticket->subject ?? 'N/A' }}</li>
                <li><strong>Priority:</strong> {{ $ticket->priority ?? 'N/A' }}</li>
                <li><strong>Status:</strong> {{ $ticket->status ?? 'N/A' }}</li>
            </ul>

            <p>You can check your ticket status by logging into your account.</p>

            <a href="{{ url('/tickets') }}" class="btn">View My Ticket</a>

            <p>Thank you for contacting support!</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ env('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
