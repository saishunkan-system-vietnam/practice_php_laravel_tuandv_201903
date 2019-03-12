/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	2019/03/11s
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */
// quản lý câu hỏi
var _obj = {
      'question_id'       : {'type': 'text'},
      'question_nm'       : {'type': 'text'}
};

$(document).ready(function() {
    try {
        initialize();
        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#question_add").fadeOut();
            $("#question_show").fadeIn();
        });

      /*  $(document).on('click','.member_id', function(e) {
            e.preventDefault();
            var id = $(this).attr("member_id");
            $.ajax({
                url: '/admin/member/update',
                type: 'GET',
                dataType: 'json',
                data: {
                    member_id: id
                }
            }).done(function(res) {
                $("#wrap").empty();
                $("#wrap").append(res.viewUpdate);
                $(".datepicker").datepicker();
            });
        });*/

        /**
         * edit question by id
         * @author		:	tuantv - 2019/03/11 - create
         * @author		:
         */
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

        /**
         * edit question by id
         * @author		:	tuantv - 2019/03/11 - create
         * @author		:
         */

        /*$(document).on('click','.add_answer', function(e) {
            var data = {};
            data.question_id = $(this).attr("question_id");
            /!*console.log(data);
            debugger;*!/
            $.ajax({
                url: '/admin/answer/create',
                type: 'GET',
                dataType: 'json',
                data: data
            }).done(function(res) {
                location.href= "../";
            });
        });
*/



    } catch (e) {
        alert('ready' + e.message);
    }
});

/**
 * initialize
 *
 * @author		:	tuantv - 2019/03/05 - create
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
 * @author : tuantv - 2019/03/07 - create
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