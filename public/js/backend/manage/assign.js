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

function checkSubmit(){
    $("#manage_exam select").removeClass("dupplicate");
    var arr = [];
    $("#manage_exam select").each(function(i){
        var _this = $(this);
        _this.attr("index",i);
        var language_id = _this.val();
        arr.push(language_id);
        i++;
    });
    // find position duplicate in array
    var count = arr.length;
    for(var i = 0 ;i < count; i++) {
        for(var j = i+1; j < count; j++) {
            if(arr[i] == arr[j]) {
                $("#manage_exam select[index="+i+"]").addClass("dupplicate");
                $("#manage_exam select[index="+j+"]").addClass("dupplicate");
                console.log("bienI = :"+ i + " ");
                console.log("bienJ = :"+ j + " ");
            }
        }
    }
    var checkError = $("#manage_exam .dupplicate").length;
    if(checkError == 0){
        $('#btnSubmit').submit();
    }
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
            e.preventDefault();
            var assign_id = $(this).attr("assign_id");
            var pos = $(this);
            //only delete when exist 1 row .exam:enable and 1 row .exam:disable (use to clone)
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
        });

        var language_init = $("#language_id").val();
        $(document).on('change','.language_id', function(e) {
            var language_id = $(this).val();
            $(this).parents(".form-inline").find(".language_id").val(language_id);
            if(language_init == language_id){
                $(this).parents(".form-inline").find(".language_id").next().next().attr("disabled",false);
            } else {
                $(this).parents(".form-inline").find(".language_id").next().next().attr("disabled",true);
            }

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
        url: '/admin/assign/del',
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
            pos.parents("tr").remove();
        });
    });
}