
/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	2019/03/18
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */
$(document).ready(function() {
    try {
        var time = $("#language_time").val();
        function startTimer(duration, display, time) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                    $("#ReturnEmail").trigger("click");
                    $("#time").parents("div").find("h2").empty();
                    var html = "<h2>Thời gian làm bài kết thúc</h2>";
                    $("#time").after(html);
                    $("#time").remove();
                }
            }, 1000);
        }

        var fiveMinutes = time * 1,
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display, time);



        $(document).on('click','input[type=radio]', function(e) {
             $(this).parents('.exam').find('input[answer_member=1]').attr("answer_member","0");
            if($(this).is(':checked')) {
                $(this).parents('.rad').find('.answer_id:first').attr("answer_member","1");
            }
        });

        $(document).on('click','#btnSubmit', function(e) {
            var token = $("#token").val();
            var obj = {};
            obj = getData();
            var language_id     = $("#language_key").val();
            var assign_id       = $("#assign_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                url: '/home/exercise/'+token,
                type: 'POST',
                dataType: 'json',
                data: {
                    row: obj,
                    language_id : language_id,
                    assign_id : assign_id
                }
            }).done(function(res) {
                //location.href= "member";
                var results = res.result;
                var row_member_ans = res.row_member_ans;
                var count_result = results.length-1;
                var count_ans = row_member_ans.length-1;

                var arr = [];
                // show answer correct
                for(var i = 0; i < count_result; i++) {
                    if(results[i].ans_correct == 1) {
                        //console.log(results[i].answer_id +'- '+ results[i].ans_correct);
                        var ans_id = results[i].answer_id;
                        $('div[ans_id="'+ans_id+'"]').addClass('correct');
                    }

                    if(i == count_result-1 ) {
                        // show answer ticked
                        for (var j = 0; j < count_ans; j++) {
                            $(".rad").each(function (j) {
                                if (row_member_ans[j].answer_member == 1) {
                                    if($(this).hasClass("correct")) {

                                    } else {
                                        $(this).addClass('wrong');
                                    }
                                }
                            });
                        }
                    }
                }

                var msg = "Số câu trả lời đúng: "+"<b>"+res.score+"</b>\nKết quả bài làm đã được gửi vào địa chỉ email: <b>"+res.email+"</b>";
                $.MessageBox({
                    //input    : true,
                    message  : msg
                }).done(function(){
                    $("#btnSubmit").remove();
                    $("#time").closest("div").remove();
                    $("input[type=radio]").attr("disabled",true);
                });
                // res.score
                $("#ReturnEmail").trigger("click");
            });
        });
    } catch (e) {
        alert('ready' + e.message);
    }
});

/**
 * initialize
 *
 * @author		:	tuantv - 2019/03/18 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initialize() {
    try{


    } catch(e){
        alert('initialize: ' + e.message);
    }
}
function getData() {
    var obj ={};
    $(".rad").each(function(i){
        var data = {};
        var question_id     = $(this).parents(".exam").find(".question_id").val();
        var answer_id       = $(this).find(".answer_id:first").val();
        var answer_member   = $(this).find(".answer_id:first").attr("answer_member");
        data.question_id    = question_id;
        data.answer_id      = answer_id;
        data.answer_member  = answer_member;
        obj[i] = data;
        i++;
    });
    return obj;
}