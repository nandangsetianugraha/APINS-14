/*! Bootstrap 5 integration for DataTables' SearchPanes
 * © SpryMedia Ltd - datatables.net/license
 */

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net-bs5', 'datatables.net-searchpanes'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				// CommonJS environments without a window global must pass a
				// root. This will give an error otherwise
				root = window;
			}

			if ( ! $ ) {
				$ = typeof window !== 'undefined' ? // jQuery's factory checks for a global window
					require('jquery') :
					require('jquery')( root );
			}

			if ( ! $.fn.dataTable ) {
				require('datatables.net-bs5')(root, $);
			}

			if ( ! $.fn.dataTable ) {
				require('datatables.net-searchpanes')(root, $);
			}


			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
    'use strict';
    var DataTable = $.fn.dataTable;


    $.extend(true, DataTable.SearchPane.classes, {
        buttonGroup: 'btn-group',
        disabledButton: 'disabled',
        narrow: 'col',
        pane: {
            container: 'table'
        },
				searchCont: 'dtsp-searchCont input-group',
        paneButton: 'btn btn-icon btn-flat-primary',
        pill: 'badge rounded-pill bg-primary',
        search: 'form-control search',
        table: 'table table-sm table-borderless',
        topRow: 'dtsp-topRow'
    });
    $.extend(true, DataTable.SearchPanes.classes, {
        clearAll: 'dtsp-clearAll btn btn-flat-primary',
        collapseAll: 'dtsp-collapseAll btn btn-flat-primary',
        container: 'dtsp-searchPanes',
        disabledButton: 'disabled',
        panes: 'dtsp-panes dtsp-panesContainer',
        showAll: 'dtsp-showAll btn btn-flat-primary',
        title: 'dtsp-title',
        titleRow: 'dtsp-titleRow'
    });


    return DataTable;
}));
