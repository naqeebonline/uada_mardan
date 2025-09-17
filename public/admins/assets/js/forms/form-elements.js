// Form Elements JavaScripts

(function ($) {
	'use strict';
    
	$('#selectize-dropdown').selectize({
		create: false,
		dropdownParent: 'body'
	});
        
        $('#selectize-dropdown').selectize({
		create: false,
		dropdownParent: 'body'
	});

	$('#selectize-tags-1').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('#selectize-tags-2').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('.selectize-group').selectize({
	    
	});
	
	$('#selectize-group').selectize({
	    
	});

	$('.datepicker-1').datepicker({
	    format: 'yyyy-mm-dd'
        });
	$('.datepicker-2').datepicker();

	$('#date-range-picker').daterangepicker();

	$("#summernote-usage").summernote({
	    height: 200,
	});

})(jQuery);
