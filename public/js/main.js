/**
 * ****************************************************************************
 *
 *
 * 作成日		    :	2019/03/04
 * 作成者		    :	tuantv
 *
 * @package		    :	MODULE MAIN
 * @copyright	    :	Copyright (c)
 * @version		:	1.0.0
 * ****************************************************************************
 */

$(document).ready(function() {
    try {
        initialize();
        initEvents();
    } catch (e) {
        alert('ready' + e.message);
    }
});

/**
 * initialize
 *
 * @author		:	tuantv - 2018/08/16 - create
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
/*
 * INIT EVENTS
 * @author		:	tuantv - 2019/03/04 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initEvents() {
    try {

        $(document).on('click', 'li.page-prev a.page-link:not(.pagging-disable)', function(e) {

        });

        $(document).on('click', '#btn-delete', function(e) {
            try{

            }catch(e){

            }
        });
    }
    catch(e) {
        console.log(e.stack);
    }
}
