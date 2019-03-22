<div id="content" style="color: white">
    <div class="frame" style="
         width: 440px;
         margin: 0 auto;
    ">
        <div class="header" style="
            height: 50px;
            line-height: 50px;
            background: #3BA3D8;
            text-align: center;
        ">
            <h3>Quizzes - {{ $info['company_name'] }} </h3>
        </div>
        <div class="bg" style="
            background:#dfe2e8;
            min-height: 250px;
            margin: 0;
            float: left;
            width: 440px;
        ">
            <div class="show" style="
            max-width: 400px;
            margin-left: 20px;
        ">
                <div>
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Xin chào: {{ $info['name'] }} - {{ $info['email'] }}</p>
                    <span> Cảm ơn bạn đã tham gia ứng tuyển vào công ty<br/></span>
                    <span>Dưới đây là link làm bài test của chúng tôi</span><br/>
                    <span><a href="{{ $info['url'] }}"> {{ $info['url'] }}</a></span><br/>
                    <span>Nếu bạn cần thêm thông tin gì có thể liên lạc với chúng tôi theo thông tin bên dưới: </span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Điện thoại: {{ $info['tel'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-decoration: none;text-shadow: white 0.1em 0.1em 0.2em">Email công ty: {{ $info['email_company'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Địa chỉ: {{ $info['address'] }}</span><br/>
                </div>
            </div>
        </div>

        <div class="footer" style="background:#bec1c7; margin: 0; float: left; width: 420px; height: 40px; line-height: 40px; padding-left: 20px">
            © Copyright 2019 {{ $info['company_name'] }}
        </div>
    </div>

</div>
