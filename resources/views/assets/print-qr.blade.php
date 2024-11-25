<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR Code - {{ $locationAsset->ident_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .qr-container {
            text-align: center;
            border: 1px dashed #000;
            padding: 20px;
            width: 250px;
        }
        .qr-code {
            margin-bottom: 10px;
        }
        .ident-code {
            font-size: 14px;
            font-weight: bold;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <div class="qr-code">
            {!! QrCode::size(200)->generate(route('assets.show', $locationAsset->id)) !!}
        </div>
        <div class="ident-code">{{ $locationAsset->ident_code }}</div>
    </div>
    <button onclick="window.print()" class="no-print" style="position: fixed; top: 20px; right: 20px; padding: 10px;">Print QR Code</button>
</body>
</html>