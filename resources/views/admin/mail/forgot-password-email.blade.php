<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body style="background:#fff; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:25px;">
    <table border="0" cellspacing="0" cellpadding="0"
    style="background:#eaeaea; max-width:800px; width:100%; padding:0px 15px;" align="center">    
        <tr>
            <td style="background:#fff;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align: justify; padding: 5%">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td> Dear {{ $user->username }} <br /><br /> We have received a request to reset
                                        the password for the account associated with this email
                                        address. If you made this request, please follow the instructions
                                        below. <br />
                                        <br />
                                        Click the link below to reset your password using our secure server:
                                        <br />
                                        <a href="{{ $user->url }}">Reset Password</a>
                                        <br />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>