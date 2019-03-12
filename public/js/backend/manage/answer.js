/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	tuantv - 2019/03/12 - create
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */

var _obj = {
    'answer_id'       : {'type': 'text'},
    'answer_nm'       : {'type': 'text'}
};

$(document).ready(function() {
    try {
        initialize();

        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#answer_add").fadeOut();
            $("#answer_show").fadeIn();
        });

        $(document).on('change','#question_id', function(e) {
            var question_id = $(this).val();
            refer_question(question_id);
        });

        $(document).on('click','#btnUpdate', function(e) {
            var data = getData(_obj);
            data['language_id'] = $('#language_id').val();
            $.ajax({
                url: '/admin/question/process_update',
                type: 'GET',
                dataType: 'json',
                data: data
            }).done(function(res) {
                location.href= "../";
            });
        });

    } catch (e) {
        alert('ready' + e.message);
    }
});

/**
 * initialize
 *
 * @author		:	tuantv - 2019/03/12 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initialize() {
    try{
        $("#question_add").hide();
        $(".datepicker").datepicker();
        $('#myTable').DataTable();

    } catch(e){
        alert('initialize: ' + e.message);
    }
}

/**
 * getData
 *
 * @author : tuantv - 2019/03/12 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function getData(obj) {
    try {
        var data = {};
        $.each(obj, function (key, element) {
            data[key] = $.trim($('#' + key).val());
        });
        return data;
    } catch (e) {
        alert('getData: ' + e.message);
    }
}

/**
 * refer : change when choose combobox Question
 *
 * @author : tuantv - 2019/03/12 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function refer_question(question_id) {
    $.ajax({
        url: '/admin/answer/refer_question',
        type: 'GET',
        dataType: 'json',
        data: {
            question_key : question_id
        }
    }).done(function(res) {
       /* console.log(res.refer_data);
        debugger;*/
        if(res.refer_data[0]) {
            for(var i=1;i<=4;i++) {
                $("#ans_"+i).val(res.refer_data[i-1].answer_nm);
                if(res.refer_data[i-1].ans_correct == 1) {
                    $("#ans_correct"+i).attr("checked",true);
                }
            }
           /* $("#answer_nm").val(res.refer_data.answer_nm);
            $("#ans_correct").val(res.refer_data.ans_correct);*/
        }else {
            /*$("#answer_nm").val("");
            $("#ans_correct").val("");*/
            for(var i=1;i<=4;i++) {
                $("#ans_"+i).val("");
            }
        }
    });
}
