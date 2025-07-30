<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo messaggio di contatto</title>
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
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .contact-info {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #3b82f6;
        }
        .field {
            margin-bottom: 10px;
        }
        .field-label {
            font-weight: bold;
            color: #374151;
        }
        .field-value {
            color: #6b7280;
        }
        .message {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border: 1px solid #e5e7eb;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nuovo messaggio di contatto</h1>
        <p>Ricevuto il {{ $contact->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="content">
        <div class="contact-info">
            <div class="field">
                <span class="field-label">Nome:</span>
                <span class="field-value">{{ $contact->first_name }} {{ $contact->last_name }}</span>
            </div>
            <div class="field">
                <span class="field-label">Email:</span>
                <span class="field-value">{{ $contact->email }}</span>
            </div>
            <div class="field">
                <span class="field-label">Oggetto:</span>
                <span class="field-value">{{ $contact->subject }}</span>
            </div>
        </div>

        <div class="message">
            <div class="field">
                <span class="field-label">Messaggio:</span>
            </div>
            <div class="field-value">
                {{ $contact->message }}
            </div>
        </div>

        <div class="footer">
            <p>Questo messaggio è stato inviato dal form di contatto di FishTideLog.</p>
            <p>Per rispondere, utilizza l'email: {{ $contact->email }}</p>
        </div>
    </div>
</body>
</html> 