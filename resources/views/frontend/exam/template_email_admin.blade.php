
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
            background:url('https://i1199.photobucket.com/albums/aa463/vantuanvn/bg_tuan.png') center;
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
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Kết quả làm bài test của ứng viên</p>
                    <span style="font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em; font-size: 18px">Link: <a style="color: blue;" href="{{ $info['url'] }}"> {{ $info['url'] }}</a></span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Tên ứng viên: {{ $info['name'] }}</span><br/>
                    <span style="color: blue; font-weight: bold; text-decoration: none; text-shadow: white 0.1em 0.1em 0.2em;">Email: {{ $info['email'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Chuyên đề: {{ $info['language_name'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Điện thoại: {{ $info['tel'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-decoration: none;text-shadow: white 0.1em 0.1em 0.2em">Email công ty: {{ $info['email'] }}</span><br/>
                    <span style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Địa chỉ: {{ $info['address'] }}</span><br/>
                </div>
            </div>
        </div>

        <div class="footer" style="background:#bec1c7; margin: 0; float: left; width: 420px; height: 40px; line-height: 40px; padding-left: 20px">
            © Copyright 2019 {{ $info['company_name'] }}
        </div>


    </div>


</div>
