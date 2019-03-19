/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	tuantv - 2019/03/13 - create
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */

var _obj = {
    'assign_id'       : {'type': 'text'},
    'member_id'       : {'type': 'text'},
    'language_id'     : {'type': 'text'},
};

$(document).ready(function() {
    try {
        initialize();
        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#assign_add").fadeOut();
            $("#assign_show").fadeIn();
        });

        $(document).on('click','#add_exam', function(e) {
            e.preventDefault();
            var exam_temp = $("#exam_temp .exam").clone();
            $("#manage_exam").append(exam_temp);

            //set input hidden language_id
            var index = $(".exam").length -2;
            //var key = $('.exam:not(:disabled)').last().attr('key');
            var html = '<input type="hidden" class="language_id" name="arr['+index+'][language_id]" value=""/>';
            $("#manage_exam .exam:last select").after(html);
        });

        $(document).on('click','.delRow', function(e) {
            var assign_id = $(this).attr("assign_id");
            var count = $(".exam").length;
            var pos = $(this);
            //only delete when exist 1 row .exam:enable and 1 row .exam:disable (use to clone)
            if(count > 2 ) {
                $.MessageBox({
                    buttonDone  : "Yes",
                    buttonFail  : "No",
                    message     : "Do you want to delete?"
                }).done(function(){
                    if(assign_id != "") {
                        delRow(assign_id,pos);
                    }else {
                        pos.parents(".exam").remove();
                    }
                }).fail(function(){
                    //$.MessageBox("Error !");
                });

            }
        });

        $(document).on('change','.language_id', function(e) {
            var value = $(this).val();
            $(this).parents(".form-inline").find(".language_id").val(value);
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
        $("#assign_add").hide();
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
 * delRow
 *
 * @author : tuantv - 2019/03/14 - create
 * @author :
 * @return : null
 * @access : public
 * @see :
 */
function delRow(id,pos) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: '/admin/assign/del_row',
        type: 'POST',
        dataType: 'json',
        data: {
            assign_id: id
        }
    }).done(function(res) {
       // debugger;
        $.MessageBox({
            //input    : true,
            message  : "Delete success"
        }).done(function(){
            pos.parents(".exam").remove();
        });
    });
}