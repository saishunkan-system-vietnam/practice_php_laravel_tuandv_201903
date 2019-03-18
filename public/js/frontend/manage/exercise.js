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
                    row: obj
                }
            }).done(function(res) {
                //location.href= "member";
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