<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table align="center" width="600" style="border: 1px solid #ddd; background-color: #ffffff; margin: 20px auto; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        <tr>
            <td style="text-align: center; padding: 20px;">
                <!-- College Logo -->
                {{-- <img src="{{ asset('images/login_logo.png') }}" alt="College Logo" style="width: 100px; height: auto; margin-bottom: 10px;"> --}}
                <h1 style="font-size: 24px; margin: 0; color: #333;">Dnyanshree Institute of Engineering and Technology</h1>
                <p style="font-size: 14px; color: #666; margin: 0;">Building Futures, Shaping Dreams</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h2 style="font-size: 20px; color: #333; margin-top: 0;">New Visitor Arrival Notification</h2>
                <p style="color: #555;">Hello,</p>
                <p style="color: #555;">A visitor has arrived to meet you. Here are the details:</p>
                <table width="100%" style="font-size: 14px; color: #333; margin: 10px 0; border-spacing: 0;">
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;">Visitor Name:</td>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;"><strong>{{ $visitor->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;">Purpose:</td>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;"><strong>{{ $visitor->purpose }}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;">Phone:</td>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;"><strong>{{ $visitor->phone }}</strong></td>
                    </tr>
                    @if($visitor->member_count > 0)
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;">Additional Members:</td>
                        <td style="padding: 5px; border-bottom: 1px solid #ddd;">
                            <strong>{{ $visitor->member_count }}</strong>
                            @if($visitor->member1) <br>- {{ $visitor->member1 }} @endif
                            @if($visitor->member2) <br>- {{ $visitor->member2 }} @endif
                            @if($visitor->member3) <br>- {{ $visitor->member3 }} @endif
                        </td>
                    </tr>
                    @endif
                </table>
                <p style="color: #555;">Please proceed to the reception area to greet the visitor.</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f8f8f8; border-top: 1px solid #ddd;">
                <p style="font-size: 12px; color: #999; margin: 0;">&copy; {{ date('Y') }} Dnyanshree Institute of Engineering and Technology. All Rights Reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
