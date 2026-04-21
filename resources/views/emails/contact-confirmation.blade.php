<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Submission</title>
</head>
<body style="background-color: #eef2f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 40px 0; text-align: center;">

    <!-- Card -->
    <table align="center" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 14px rgba(0,0,0,0.1); overflow: hidden;">
        <tr>
            <td style="padding: 30px 30px 20px 30px; text-align: center;">
                <!-- Logo inside card -->
                <img src="https://northbengaldairy.com/uslive/original/logo-alt1759581145.jpg" alt="North Bengal Dairy Logo" style="max-width: 180px; margin-bottom: 10px;">

                <hr style="border: 0; height: 2px; background: #0d6efd; width: 60px; margin: 15px auto; border-radius: 5px;">

                <h2 style="color: #0d6efd; margin: 10px 0 0;">📩 New Contact Submission</h2>
            </td>
        </tr>

        <tr>
            <td style="padding: 0 30px 30px 30px;">
                <p style="font-size: 15px; color: #333;">Hello Admin,</p>
                <p style="font-size: 14px; color: #555;">
                    You’ve received a new message from your website contact form.
                </p>

                <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; margin-top: 20px;">
                    <tr>
                        <td width="30%" style="background-color: #f8f9fa; color: #333; font-weight: 600;">Name:</td>
                        <td style="color: #555;">{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <td width="30%" style="background-color: #f8f9fa; color: #333; font-weight: 600;">Email:</td>
                        <td style="color: #555;">{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <td width="30%" style="background-color: #f8f9fa; color: #333; font-weight: 600; vertical-align: top;">Message:</td>
                        <td style="color: #555; line-height: 1.6;">{{ $contact->message }}</td>
                    </tr>
                </table>

                <div style="margin-top: 30px; text-align: center;">
                    <a href="mailto:{{ $contact->email }}" style="background-color: #0d6efd; color: #fff; text-decoration: none; padding: 10px 25px; border-radius: 6px; font-weight: 600;">Reply Now</a>
                </div>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div style="margin-top: 25px;">
        <a href="https://www.facebook.com/northbengaldairyfirm" style="margin: 0 8px; text-decoration: none;">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="28" height="28" style="vertical-align: middle;">
        </a>
        <a href="https://www.youtube.com/@northbengaldairyfarmdhaka6622" style="margin: 0 8px; text-decoration: none;">
            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" width="28" height="28" style="vertical-align: middle;">
        </a>

        <p style="font-size: 13px; color: #777; margin-top: 10px;">
            © 2025 <a href="https://northbengaldairy.com/" style="color: #0d6efd; text-decoration: none;">northbengaldairy.com</a>
        </p>
    </div>

</body>
</html>
