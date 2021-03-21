
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {{ Html::style('css/admin/developer.css') }}
</head>

<body style="margin:0px; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom:30px;" align="center">
                          <a href="{{ basename(Request::url()) }}" target="_blank">
                            {!! Html::image('img/logo.png',null,['width'=>'120px','class'=>"login_logo"]) !!}
                          </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>

                        <tr>
                            {!! $details['body'] !!}
                        </tr>
                        <tr>
                          <td style="padding:10px 0 30px 0;">
                            <b>{{__('Regards')}},</b><br>{{Helper::setting()->name}}
                          </td>
                        </tr>
                         
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <p>
                    {{Helper::setting()->copy_right}} <br>
                </p>
            </div>
        </div>
    </div>
</html>