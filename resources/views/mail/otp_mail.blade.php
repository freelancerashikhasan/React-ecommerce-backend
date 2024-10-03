<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
      <div style="border-bottom:1px solid #eee">
        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">{{ config('app.name') }} OTP Verification</a>
      </div>
      <p style="font-size:1.1em">Hi, {{ $mailData['username'] }}</p>
      <p>Thank you for choosing our service! To verify your account, please use the following One-Time Password (OTP):</p>
      <h2 style="background: #00466a; margin: 0 auto; width: max-content; padding: 0 10px; color: #fff; border-radius: 4px; letter-spacing: 10px; padding-right: 0px;">{{ $mailData['otp'] }}</h2>
      <p style="font-size:1.1em">Thank you for your attention to this matter.</p>
      <p style="font-size:0.9em;">Best Regards,<br />{{ config('app.name') }}</p>
      <p style="font-size:0.9em;">Website: <a style="color: #70AB43" href="{{ config('app.url') }}" target="_bank">{{ config('app.url') }}</a></p>
      <hr style="border:none;border-top:1px solid #eee" />

    </div>
  </div>
