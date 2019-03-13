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
