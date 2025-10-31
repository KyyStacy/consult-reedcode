<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Lamaran - Consult by Reed Code</title>
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
        .header .icon {
            font-size: 48px;
            margin-bottom: 16px;
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
        .thank-you {
            font-size: 20px;
            color: #06b6d4;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0f7fa;
        }
        .content p {
            color: #374151;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 16px;
        }
        .details-box {
            background: #f0fdfa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #06b6d4;
            margin: 24px 0;
        }
        .details-box h3 {
            color: #06b6d4;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .details-list {
            list-style: none;
        }
        .details-list li {
            padding: 10px 0;
            border-bottom: 1px solid #ccfbf1;
            color: #374151;
            font-size: 14px;
        }
        .details-list li:last-child {
            border-bottom: none;
        }
        .details-list .detail-label {
            font-weight: 600;
            color: #0891b2;
            display: inline-block;
            min-width: 120px;
        }
        .signature {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }
        .signature p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 4px;
        }
        .signature .team-name {
            color: #06b6d4;
            font-weight: 600;
            font-size: 15px;
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
            .header .icon {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <div class="icon">✅</div>
            <h1>Konfirmasi Lamaran</h1>
            <p class="subtitle">Consult by Reed Code</p>
        </div>
        <div class="content">
            <p class="thank-you">Terima kasih, {{ $details['name'] }}! 🙏</p>
            
            <p>Lamaran Anda sebagai Psikolog di <strong>Consult by Reed Code</strong> telah kami terima dengan baik.</p>
            
            <p>Kami akan segera meninjau lamaran Anda dengan teliti. Tim kami akan menghubungi Anda melalui email ini jika Anda terpilih untuk tahap selanjutnya dalam proses seleksi.</p>
            
            <div class="details-box">
                <h3>📋 Detail Lamaran Anda</h3>
                <ul class="details-list">
                    <li>
                        <span class="detail-label">Nama:</span>
                        {{ $details['name'] }}
                    </li>
                    <li>
                        <span class="detail-label">Email:</span>
                        {{ $details['email'] }}
                    </li>
                    <li>
                        <span class="detail-label">Tanggal Pengajuan:</span>
                        {{ now()->format('d F Y') }}
                    </li>
                </ul>
            </div>
            
            <p>Terima kasih atas minat dan kepercayaan Anda untuk bergabung dengan tim kami. Kami berharap dapat bekerja sama dengan Anda.</p>
            
            <div class="signature">
                <p>Salam hangat,</p>
                <p class="team-name">Tim Consult by Reed Code</p>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis dari sistem</p>
            <p class="brand">Consult by Reed Code</p>
        </div>
    </div>
</body>
</html> 