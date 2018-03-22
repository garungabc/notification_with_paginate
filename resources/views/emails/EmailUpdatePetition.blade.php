<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thông báo kiến nghị được cập nhật</title>
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
        .content {
            text-align: justify;
        }
        .link-homepage {
            font-size: 25px;
        }
    </style>
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
                                        <h1 class="text-center link-homepage" ><a href="{{ $site_url }}">HOPECOM.ORG</a></h1>
										<p class="text-center title-mail fz-16">Thông báo về việc một kiến nghị đã được cập nhật</p>
										<p class="fz-16">Xin chào <strong>{{ $name_signer }}</strong>,</p>
										<p class="fz-16"><strong>{{ $name_author }}</strong> vừa chia sẻ một thông tin cập nhật của kiến nghị <strong>"{{ $post_title }}"</strong>, với nội dung:</p>
										<p class="content fz-16">
											"{{ $content }}"
										</p>
										<p class="fz-14">Bạn có thể xem chi tiết link ở đây: <a href="{{ $link }}">xem chi tiết</a></p>
										<p class="note-2 border-t-b">
											<i class="fz-12">Để từ chối nhận tin cập nhật về kiến nghị này xin vui lòng email đến <a href="mailto:hopecom.vn@gmail.com">hopecom.vn@gmail.com</a> hoặc <a href="mailto:hopecom.vn@gmail.com">info@hopecom.org</a></i>
										</p>
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
                                            <p><a href="{{ $site_url }}/gioi-thieu/?tab=privacy_policy">Chính sách bảo mật</a> | <a href="{{ $site_url }}/gioi-thieu/?tab=terms_use">Điều khoản sử dụng</a></p>
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
