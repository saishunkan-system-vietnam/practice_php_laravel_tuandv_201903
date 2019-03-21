/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	2019/03/05
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE
 * ****************************************************************************
 */
var _obj = {
          'member_id'       : {'type': 'text'}
        , 'username'        : {'type': 'text'}
        , 'password'        : {'type': 'text'}
        , 'email'           : {'type': 'text'}
        , 'birthday'        : {'type': 'text'}
        , 'address1'        : {'type': 'text'}
        , 'address2'        : {'type': 'text'}
        , 'gender'          : {'type': 'text'}
        , 'shool'           : {'type': 'text'}
        , 'education_year'  : {'type': 'text'}
        , 'interview_start' : {'type': 'text'}
        , 'interview_end'   : {'type': 'text'}
        , 'experience_year' : {'type': 'text'}
        , 'role'            : {'type': 'text'}
    };

$(document).ready(function() {
    try {
        initialize();
        $(document).on('click','#add_new', function(e) {
            e.preventDefault();
            $("#member_show").fadeOut();
            $("#member_add").fadeIn();
            $("#member_add").css("width","1000px");
        });

        $(document).on('click','#show', function(e) {
            e.preventDefault();
            $("#member_add").fadeOut();
            $("#member_show").fadeIn();
        });

        $(document).on('click','.member_id', function(e) {
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
        });

        $(document).on('click','#btnUpdate', function(e) {
            var data = getData(_obj);
            data['gender'] = $('#gender').val();
            data['education_year'] = $('#education_year').val();
            data['role'] = $('#role').val();

            $.ajax({
                url: '/admin/member/process_update',
                type: 'GET',
                dataType: 'json',
                data: data
            }).done(function(res) {
                location.href= "member";
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
        $("#member_add").hide();
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