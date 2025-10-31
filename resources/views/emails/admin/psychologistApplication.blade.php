<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Psikolog Baru - Consult by Reed Code</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            padding: 20px;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(6, 182, 212, 0.15);
        }
        .header {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .header .subtitle {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 32px 24px;
            background: #ffffff;
        }
        .info-item {
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .label {
            display: block;
            font-weight: 600;
            color: #06b6d4;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .info-item p {
            color: #374151;
            font-size: 15px;
            line-height: 1.7;
            word-wrap: break-word;
        }
        .cover-letter {
            background: #f0fdfa;
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid #06b6d4;
            margin-top: 8px;
            white-space: pre-wrap;
        }
        .footer {
            background: #f9fafb;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .footer .brand {
            color: #06b6d4;
            font-weight: 600;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .header, .content, .footer {
                padding: 24px 16px;
            }
            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>🔔 Lamaran Psikolog Baru</h1>
            <p class="subtitle">Consult by Reed Code</p>
        </div>
        <div class="content">
            <div class="info-item">
                <span class="label">👤 Nama Lengkap</span>
                <p>{{ $details['name'] }}</p>
            </div>
            <div class="info-item">
                <span class="label">📧 Email</span>
                <p>{{ $details['email'] }}</p>
            </div>
            <div class="info-item">
                <span class="label">📝 Surat Lamaran</span>
                <div class="cover-letter">{{ $details['cover_letter'] }}</div>
            </div>
            <div class="info-item">
                <span class="label">📄 CV/Resume</span>
                <p>CV/Resume terlampir dalam email ini sebagai attachment.</p>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis dari sistem</p>
            <p class="brand">Consult by Reed Code</p>
        </div>
    </div>
</body>
</html> 