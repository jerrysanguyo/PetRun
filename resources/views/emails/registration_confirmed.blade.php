<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Confirmed</title>
</head>

<body
    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7fa; padding: 20px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
        <tr>
            <td style="background-color: #28a745; color: #ffffff; text-align: center; padding: 20px 30px;">
                <h1 style="margin: 0; font-size: 22px;">🐾 Registration Confirmed</h1>
                <p style="margin: 5px 0 0; font-size: 14px;">Paw Run 2025 – Run Fur Love: Be Healthy With Your Pets!</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 16px; color: #333333;">Hello
                    <strong>{{ $participant->full_name ?? $participant->name }}</strong>,</p>

                <p style="font-size: 16px; color: #333333;">
                    🐾 Thank you for registering for <strong>Paw Run 2025</strong> with the theme <em>"Run Fur Love: Be
                        Healthy With Your Pets!"</em>
                    organized by the <strong>Office of the City Veterinarian – City of Taguig</strong>.
                </p>
                <p style="font-size: 15px; color: #555555;">
                    Your participation has been successfully confirmed. Please keep your QR code safe and present it at
                    the event entrance.
                </p>

                @if(!empty($qrPath))
                <div style="text-align:center; margin: 24px 0;">
                    <div
                        style="display:inline-block; padding: 16px; border: 1px dashed #d0d7de; border-radius: 8px; background:#f8fbff;">
                        <img src="{{ $message->embed($qrPath) }}" alt="Your QR Code"
                            style="display:block; width:220px; height:220px; object-fit:contain; margin:0 auto;">
                        <div style="font-size:12px; color:#6c757d; margin-top:8px;">Scan at the entrance</div>
                    </div>
                </div>
                @endif

                <div
                    style="margin: 25px 0; background-color: #f0f8ff; padding: 15px 20px; border-left: 4px solid #28a745; border-radius: 5px;">
                    <p style="margin: 0; font-size: 14px; color: #28a745;">
                        📍 Location: TLC Park, Laguna Lake Highway/C6 Road, Lower Bicutan, Taguig<br>
                        📅 Date: August 3, 2025 (Sunday)<br>
                        ⏰ Time: 5:00 AM
                    </p>
                </div>

                <p style="font-size: 14px; color: #555555;">
                    We’re excited to celebrate wellness, fitness, and the special bond between you and your pets!
                </p>

                <p style="font-size: 14px; color: #555555; margin-top: 30px;">
                    Best regards,<br>
                    <strong>Office of the City Veterinarian – City of Taguig (Paw Run 2025 Team)</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f2f5; text-align: center; padding: 15px; font-size: 12px; color: #888888;">
                &copy; {{ date('Y') }} City of Taguig. All rights reserved.
            </td>
        </tr>
    </table>
</body>

</html>