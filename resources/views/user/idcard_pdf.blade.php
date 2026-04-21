<div class="card print-card" style="width: 350px; height: auto; margin: auto; border: 1px solid #ccc; border-radius: 10px;
            font-family: Arial, sans-serif; position: relative; overflow: hidden;">

    <!-- Card content -->
    <div class="card-body" style="padding: 20px; text-align: center; background-color: #BBDFBB;">
        <!-- Profile Image -->
        <img 
            src="{{ route('imagecache', ['template' => 'pfimd', 'filename' => $user->fi()]) ?? 'https://img.freepik.com/free-vector/smiling-young-man-illustration_1308-174669.jpg' }}" 
            alt="Profile Photo" 
            style="width: 140px; height: 140px; object-fit: cover; border-radius: 8px; border: 2px solid #59BA47; margin-bottom: 10px; display: block; margin-left: auto; margin-right: auto;">

        <div style="font-weight: bold; font-size: 16px; margin: 5px 0;">{{ Auth::user()->name ?? 'Guest User' }}</div>
        <div style="font-size: 14px; margin: 3px 0;">Blood Group: {{ Auth::user()->blood_group ?? 'A+' }}</div>
        <div style="font-size: 14px; margin: 3px 0 10px 0;">Mobile: {{ Auth::user()->mobile ?? '+880123456789' }}</div>

        <div style="font-size: 25px; font-weight: bold; color: #788377ff; margin: 10px 0;">Health Card</div>

        <div style="margin: 10px 0; text-align: center;">
            <img src="https://93.phenexsoft.com/uslive/original/logo-alt1756994190.png" alt="site logo" style="width: 40%; margin: 0 auto;">
        </div>

        <!-- Signature and Date inside card -->
        <div style="margin-top: 20px; padding: 0 10px;">
            <div style="display: inline-block; width: 49%; text-align: left; vertical-align: bottom;">
                <img src="{{ asset('img/sign.png') }}" alt="signature image" style="width: 100px; height: auto; display: block; margin-bottom: 2px;">
                <div style="font-size: 12px;">Signature</div>
            </div>
            <div style="display: inline-block; width: 49%; text-align: right; vertical-align: bottom;">
                <span style="font-size:16px">{{ Auth::user()->registration_date ?? date('d/m/Y') }}</span><br>
                Date of Registration
            </div>
        </div>
    </div>

    <!-- Footer color only -->
    <!-- Card Footer -->
    <div style="background-color: #59BA47; color: #053800; padding: 8px 10px; font-size: 12px; text-align: center; line-height: 1.3; border-top: 1px solid #53A33B; border-radius: 0 0 10px 10px;">
        <div style="overflow-wrap: break-word;">
            Address: H-302 High School Road, Muradpur, East Jurain, Dhaka - 1204, Phone: 01973-005566
        </div>
        <div>{{ 'www.93shasthoseba.com' }}</div>
    </div>
</div>
