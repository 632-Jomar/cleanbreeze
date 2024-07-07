@php
    $message = $message ?? null;
@endphp

<div style="margin:0;padding:0" bgcolor="#FFFFFF">
    <table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
        <tbody>
            <tr height="32" style="height:32px">
                <td></td>
            </tr>
            <tr align="center">
                <td>
                    <div>
                        <div></div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
                        <tbody>
                            <tr>
                                <td width="8" style="width:8px"></td>
                                <td>
                                    <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center" class="m_-5081056816123927382mdv2rw">
                                        <img src="{{ embedImage('assets/logos/cleanbreeze.png', $message) }}" width="200" aria-hidden="true" style="margin-bottom:16px" alt="Google" class="CToWUd" data-bit="iit">
                                        
                                        <div style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                            <div style="font-size:21px">Your Cleanbreeze account has been created by an administrator</div>
                                            <table align="center" style="margin-top:8px">
                                                <tbody>
                                                    <tr style="line-height:normal">
                                                        <td>
                                                            <a style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
                                                                {{ $verificationToken->email }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            To start using your account, please verify your email address and set your password by clicking the link below:

                                            <div style="padding: 25px 0;text-align:center">
                                                <a href="{{ $verificationToken->verification_link }}" style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#4184f3;border-radius:5px;min-width:90px" target="_blank">
                                                    Verify Account
                                                </a>
                                            </div>

                                            Thank you for joining us! We look forward to having you on board.
                                        </div>
                                    </div>

                                    <div style="text-align:left">
                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div>This is an auto-generated email, please do not reply!</div>
                                        </div>
                                    </div>
                                </td>
                                <td width="8" style="width:8px"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr height="32" style="height:32px">
                <td></td>
            </tr>
        </tbody>
    </table>
</div>