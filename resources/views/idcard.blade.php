<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ID Card</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    html, body {
        height: 100%;
        background: transparent !important; /* Body transparent রাখার জন্য */
    }

    .id-card-container {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent !important;
    }

    .id-card {
        width: 300px;
        height: 500px;
        border: 3px solid #4CAF50;
        padding: 20px;
        text-align: center;
        background: transparent !important;
        position: relative;
        box-sizing: border-box;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .id-card .photo {
        width: 120px;
        height: 140px;
        object-fit: cover;
        border: 3px solid #4CAF50;
        border-radius: 10px;
        margin: 0 auto 10px auto;
        display: block;
    }

    .id-card h3 {
        font-size: 22px;
        margin: 8px 0 5px;
        font-weight: 700;
        color: #333;
    }

    .id-card p {
        font-size: 14px;
        margin: 3px 0;
        color: #555;
    }

    .id-card .header-text {
        font-weight: 600;
        color: #4CAF50;
    }

    .id-card .title {
        font-size: 16px;
        font-weight: 700;
        margin-top: 10px;
        color: #4CAF50;
        letter-spacing: 1px;
    }

    .id-card .logo {
        width: 80px;
        margin: 15px auto;
        display: block;
    }

    .id-card .info-row {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        padding: 0 5px;
    }

    .id-card .info-row p {
        margin: 0;
        font-size: 13px;
        color: #333;
    }

    .id-card .footer {
        font-size: 11px;
        color: #fff;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center;
        background-color: #4cbd50;
        padding: 5px 0;
    }
</style>
</head>
<body>
<div class="id-card-container">
    <div class="id-card">
        <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $idcardData['user']->fi()]) }}" class="photo" alt="User Photo">
        <h3>{{ $idcardData['user']->name }}</h3>
        <p><span class="header-text">Blood Group:</span> {{ $idcardData['user']->blood_group }}</p>
        <p><span class="header-text">Mobile:</span> {{ $idcardData['user']->mobile }}</p>
        <p class="title">Health Card</p>
        <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}" class="logo" alt="Logo">

        <div class="info-row d-flex justify-content-around">
            <p><b>Authority:</b> Signature</p>
            <p><b>Reg. Date:</b> {{ \Carbon\Carbon::parse($idcardData['user']->reg_date)->format('d/m/Y') }}</p>
        </div>

        <div class="footer">
            <p>Address: {{ $idcardData['user']->present_address }}</p>
            <p>{{$ws->website_title}}</p>
        </div>
    </div>
</div>
</body>
</html>
