/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	2019/03/08
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */
var _obj = {
      'language_id'       : {'type': 'text'}
    , 'language_nm'      : {'type': 'text'}

};

$(document).ready(function() {
    try {
        initialize();
        $(document).on('click','#add_new', function(e) {
            e.preventDefault();
            $("#language_show").fadeOut();
            $("#language_add").fadeIn();
            $("#language_add").css("width","1000px");
        });

        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#language_add").fadeOut();
            $("#language_show").fadeIn();
        });

        $(document).on('click','#btnUpdate', function(e) {
            var data = getData(_obj);
            $.ajax({
                url: '/admin/language/process_update',
                type: 'GET',
                dataType: 'json',
                data: data
            }).done(function(res) {
                location.href= "language";
            });
        });

        $('.language_id').click(function() {
            var id = $(this).attr("language_id");
            $.ajax({
                url: '/admin/language/update',
                type: 'GET',
                dataType: 'json',
                data: {
                    language_id: id
                }
            }).done(function (res) {
                /* console.log(1);
                 debugger;*/
                $("#wrap").empty();
                $("#wrap").append(res.viewUpdate);
            });
        });
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
        $(".element").hide();
        $("#language_add").hide();
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