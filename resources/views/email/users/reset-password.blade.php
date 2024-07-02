@php
    $message = $message ?? null;
@endphp

<center>
    <div style="width: 60%">
        <img width="100%" src="{{ embedImage('assets/logos/logophil.png', $message) }}" style="margin-bottom: 30px; background: -webkit-linear-gradient(left, #6EC1E4, #6EC1E4); width: 350px">

        <p>
            To reset your password just click the link below, and do not share to anyone. <br><br>


            <a href="{{ $passwordReset->reset_link }}"> {{ config('app.name') }} | Reset Password</a>
        </p>

        <hr>

        <span style="font-size: .82em; color: #777777">
            This message was sent to <a href="#">{{ $passwordReset->email }}</a>. If you have questions or complaints, please contact the system administrator.
            <br>

            We promise not to share your information, click to view our Privacy Policy.
            <br><br>

            GEOGREEN GLOBAL LTD <br>
            POWERED BY +632 APPS, INC.
        </span>
    </div>
</center>