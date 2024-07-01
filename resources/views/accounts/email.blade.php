@php
    $message = $message ?? null;
@endphp

<center>
    <div style="width: 60%">
        <img width="100%" src="{{ embedImage('assets/logos/logophil.png', $message) }}" style="margin-bottom: 30px; background: -webkit-linear-gradient(left, #6EC1E4, #6EC1E4); width: 350px">

        <p align="left">
            Good day! {{ config('app.name') }} has create your login credentials:

            <table style="margin: 20px 0">
                <tr>
                    <td>Email:</td>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <td style="padding-right: 15px">Password:</td>
                    <td>{{ $password ?? null }}</td>
                </tr>
            </table>

            Thank you so much. <br><br>

            just login here: <a href="{{ route('login') }}"> {{ config('app.name') }} | Login</a>
        </p>

        <hr>

        <span style="font-size: .82em; color: #777777">
            This message was sent to <a href="#">{{ $user->email }}</a>. If you have questions or complaints, please contact the system administrator.
            <br>

            We promise not to share your information, click to view our Privacy Policy.
            <br><br>

            GEOGREEN GLOBAL LTD <br>
            POWERED BY +632 APPS, INC.
        </span>
    </div>
</center>