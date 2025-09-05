<!DOCTYPE html>
<html>

<head>
    <title>Your Unique Code</title>
</head>

<body>
    <div>
        @php
            $footer_content = App\Models\AppControll::where('id', '1')->select('email_footer_content')->first();
        @endphp

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Dear {{ ucfirst($name) }},</p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
            We received a request to reset the password for your account. To proceed, please use the OTP provided below.
        </p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
            Your OTP is: <strong>{{ $code }}</strong>
        </p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
            Please enter it promptly to verify your account and complete the
            password reset process.
        </p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
            If you did not request this password reset, please ignore this email or contact our support team immediately
            for assistance.
        </p>

        <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Thank you for using City Tour Guide!</p>

        @if (!$footer_content->email_footer_content == null)
            <p style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">Best regards,</p>
            <div style="color: #222; font: small / 1.5 Arial, Helvetica, sans-serif;">
                {!! $footer_content->email_footer_content !!}
            </div>
        @endif

    </div>

</body>

</html>
