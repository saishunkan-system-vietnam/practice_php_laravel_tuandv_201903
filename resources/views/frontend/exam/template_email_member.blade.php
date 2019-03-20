
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
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">Kết quả bài test ứng viên</p>
                    <p style="color: blue; font-weight: bold; text-decoration: underline; text-shadow: white 0.1em 0.1em 0.2em; font-size: 18px"><a href="{{ $info['url'] }}"> {{ $info['url'] }}</a></p>
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">{{ $info['tel'] }}</p>
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">{{ $info['email'] }}</p>
                    <p style="color: brown; font-weight: bold; text-shadow: white 0.1em 0.1em 0.2em">{{ $info['address'] }}</p>
                </div>
            </div>
        </div>

        <div class="footer" style="background:#bec1c7; margin: 0; float: left; width: 420px; height: 40px; line-height: 40px; padding-left: 20px">
            © Copyright 2019 {{ $info['company_name'] }}
        </div>


    </div>


</div>
