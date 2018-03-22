<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title') @show</title>
    <style type="text/css">
        body, table {
            font-family: HelveticaNeue;
        }
        p {
            font-size: 14px;
        }
        .text-center {
            text-align: center;
        }
        .note-1, .note-2 {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .note-2{
            font-size: 11px;
        }
        .border-t-b {
            border-top: 1px dashed #ddd;
        }
        .fz-16, .fz-16 p {
            font-size: 16px;
        }
        .fz-14, .fz-14 p {
            font-size: 14px;
        }
        .fz-12, .fz-12 p {
            font-size: 12px;
        }
    </style>
    @yield('style')
</head>

<body >
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Email Body -->
                    <tr class="email-body">
                        <td width="100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="email-footer">
                        <td width="100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div class="note-2 border-t-b fz-12">
                                            <p>Trung tâm hỗ trợ cộng đồng HopeCom,</p>
                                            <p>Tầng 6 tòa nhà SanNam, số 78 phố Duy Tân, P. Dịch Vọng Hậu, Q. Cầu Giấy,Hà Nội.</p>
                                            <p>Điện thoại: (+84) 162 647 1758/(+84) 24 38389090</p>
                                            <p>Fax: (+84) 24 32242650</p>
                                            <p>Email: <a href="mailto:hopecom.vn@gmail.com">hopecom.vn@gmail.com</a> ; <a href="mailto:info@gmail.com">info@hopecom.org</a></p>
                                            <p><a href="#">Chính sách bảo mật</a> | <a href="#">Điều khoản sử dụng</a></p>
                                        </div>
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
