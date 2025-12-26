<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #0B1320;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #0B1320;
        }
        .field-value {
            background-color: white;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ddd;
            margin-top: 5px;
        }
        .footer {
            background-color: #0B1320;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Feast.id - New Contact Form Message</h1>
    </div>

    <div class="content">
        <p>You have received a new message from the contact form on your website. Here are the details:</p>

        <div class="field">
            <div class="field-label">Name:</div>
            <div class="field-value">{{ $contactData['name'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $contactData['email'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Phone:</div>
            <div class="field-value">{{ $contactData['phone'] ?? 'Not provided' }}</div>
        </div>

        <div class="field">
            <div class="field-label">Subject:</div>
            <div class="field-value">{{ $contactData['subject'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="field-value">{{ $contactData['message'] }}</div>
        </div>

        <p>Please respond to this inquiry as soon as possible.</p>
    </div>

    <div class="footer">
        <p>This email was sent from the Feast.id contact form.</p>
        <p>&copy; 2025 Feast.id. All rights reserved.</p>
    </div>
</body>
</html>
