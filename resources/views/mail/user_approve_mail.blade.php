<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
      <p style="font-size:1.1em">Dear {{ $mailData['name'] }},</p>
      <p>  Congratulation… Now You are a Registered  User of DATA BANK Community.  Your DATA BANK Account ID : {{ $mailData['username'] }} & Password : {{ $mailData['show_pass']  }}. </p>
      <p style="font-size:1.1em">Wish you have a Great Journey with DATA BANK…</p>
      <p style="font-size:0.9em;">Thanking from, <br />{{ config('app.name') }}</p>
      <p style="font-size:0.9em;">Website: <a style="color: #70AB43" href="{{ config('app.url') }}" target="_bank">{{ config('app.url') }}</a></p>
      <hr style="border:none;border-top:1px solid #eee" />

    </div>
  </div>



