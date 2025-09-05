<!DOCTYPE html>
<html>

<head>
    <title>Your Unique Code</title>

    <style>
        body {
            font-size: 10px;
            font: small / 1.5 Arial, Helvetica, sans-serif;
            color: #222;
        }
    </style>
</head>

<body>
    <div>
        @php
            $footer_content = App\Models\AppControll::where('id', '1')->select('email_footer_content')->first();
        @endphp

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Dear {{ ucfirst($name) }},</p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Thank you for signing up with City Tour
            Guide!</p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
            To complete your registration, please verify your email address by
            entering the following One-Time Password (OTP) in the verification page:
        </p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Your OTP:
            <strong>{{ $code }}</strong></p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Please enter it soon to verify your
            account.</p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">If you did not request this email, please
            disregard this message or contact our support team.</p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Thank you for choosing City Tour Guide!
        </p>

        @if (!$footer_content->email_footer_content == null)
            <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Best regards,</p>
            <div style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
                {!! $footer_content->email_footer_content !!}
            </div>
        @endif

    </div>
</body>

</html>
