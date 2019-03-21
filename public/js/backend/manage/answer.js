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
        //$("#question_id_hidden").trigger("change");

        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#answer_add").fadeOut();
            $("#answer_show").fadeIn();
        });

        $("input[type=checkbox]").on("click", function(){
            var check = $(this).prop("checked");
            if(check) {
                //alert("Checkbox is checked.");
                $(this).val(1);
            } else {
                //alert("Checkbox is unchecked.");
            }
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
        $(".element").hide();
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

