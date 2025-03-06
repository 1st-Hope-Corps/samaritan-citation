(function($){
	$.fn.center = function (bAbsolute){
		return this.each(
			function (){
				var oMainFunc = jQuery(this);

				oMainFunc
					.css(
						{
							position:	(bAbsolute) ? "absolute" : "fixed", 
							left:		"50%",
							top:		"50%",
							zIndex:		"9000"
						}
					)
					.css(
						{
							marginLeft:	"-" + (oMainFunc.outerWidth() / 2) + "px", 
							marginTop:	"-" + (oMainFunc.outerHeight() / 2) + "px"
						}
					);

				if (bAbsolute){
					oMainFunc.css(
						{
							marginTop:	parseInt(oMainFunc.css("marginTop"), 10) + jQuery(window).scrollTop(), 
							marginLeft:	parseInt(oMainFunc.css("marginLeft"), 10) + jQuery(window).scrollLeft()
						}
					);
				}
			}
		);
	};
	
	jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

})(jQuery);


$(document).ready(
	function(){
		$( "#slider-range-min" ).slider({
		range: "min",
		value: 3400,
		min: 400,
		max: 50000,
		step: 500,
		slide: function( event, ui ) {
			$( "#amounttext" ).text( "Php " + ui.value );
			$( "#amount" ).val( ui.value );
		  }
		});
		$( "#amounttext" ).text( 'Php' + $( "#slider-range-min" ).slider( "value" ));
		$( "#amount" ).val($( "#slider-range-min" ).slider( "value" ));
		
		$( "#slider-range-min-days" ).slider({
			range: "min",
			value: 1,
			min: 1,
			max: 20,
			slide: function( event, ui ) {
				$( "#daytext" ).text( ui.value );
				$( "#day" ).val( ui.value );
			}
		});
		$( "#daytext" ).text( $( "#slider-range-min-days" ).slider( "value" ));
		$( "#day" ).val($( "#slider-range-min-days" ).slider( "value" ));
		$( "#slider-range-min-month" ).slider({
			range: "min",
			value: 1,
			min: 1,
			max: 13,
			slide: function( event, ui ) {
				switch($( "#slider-range-min-month" ).slider( "value" )){
				case 1: $( "#monthtext" ).text("Oct 11"); $( "#month" ).val("oct 11"); break;
				case 2: $( "#monthtext" ).text("Nov 11"); $( "#month" ).val("nov 11"); break;
				case 3: $( "#monthtext" ).text("Dec 11"); $( "#month" ).val("dec 11"); break;
				case 4: $( "#monthtext" ).text("Jan 12"); $( "#month" ).val("jan 12"); break;
				case 5: $( "#monthtext" ).text("Feb 12"); $( "#month" ).val("feb 12"); break;
				case 6: $( "#monthtext" ).text("Mar 12"); $( "#month" ).val("mar 12"); break;
				case 7: $( "#monthtext" ).text("Apr 12"); $( "#month" ).val("apr 12"); break;
				case 8: $( "#monthtext" ).text("Jun 12"); $( "#month" ).val("jun 12"); break;
				case 9: $( "#monthtext" ).text("Jul 12"); $( "#month" ).val("jul 12"); break;
				case 10: $( "#monthtext" ).text("Aug 12"); $( "#month" ).val("aug 12"); break;
				case 11: $( "#monthtext" ).text("Sep 12"); $( "#month" ).val("sep 12"); break;
				case 12: $( "#monthtext" ).text("Nov 12"); $( "#month" ).val("nov 12"); break;
				case 13: $( "#monthtext" ).text("Dec 12"); $( "#month" ).val("dec 12"); break;
				default:
				$( "#monthtext" ).text("Oct 11"); $( "#month" ).val("Jan");
				}
			}
		});
		switch($( "#slider-range-min-month" ).slider( "value" )){
		case 1: $( "#monthtext" ).text("Oct 11"); $( "#month" ).val("oct 11"); break;
		case 2: $( "#monthtext" ).text("Nov 11"); $( "#month" ).val("nov 11"); break;
		case 3: $( "#monthtext" ).text("Dec 11"); $( "#month" ).val("dec 11"); break;
		case 4: $( "#monthtext" ).text("Jan 12"); $( "#month" ).val("jan 12"); break;
		case 5: $( "#monthtext" ).text("Feb 12"); $( "#month" ).val("feb 12"); break;
		case 6: $( "#monthtext" ).text("Mar 12"); $( "#month" ).val("mar 12"); break;
		case 7: $( "#monthtext" ).text("Apr 12"); $( "#month" ).val("apr 12"); break;
		case 8: $( "#monthtext" ).text("Jun 12"); $( "#month" ).val("jun 12"); break;
		case 9: $( "#monthtext" ).text("Jul 12"); $( "#month" ).val("jul 12"); break;
		case 10: $( "#monthtext" ).text("Aug 12"); $( "#month" ).val("aug 12"); break;
		case 11: $( "#monthtext" ).text("Sep 12"); $( "#month" ).val("sep 12"); break;
		case 12: $( "#monthtext" ).text("Nov 12"); $( "#month" ).val("nov 12"); break;
		case 13: $( "#monthtext" ).text("Dec 12"); $( "#month" ).val("dec 12"); break;
		default:
		$( "#monthtext" ).text("Oct 11"); $( "#month" ).val("Jan");
		}
		
		$("#create-trip").click(
		function(){
			$("#trip_Dialog").dialog({
							modal: true,
							autoOpen: true,
							resizable: false,
							width: 530,
							buttons: {
								"Create Trip": function(){
								//$(this).dialog("close");
									$.post(
									"/trip/addnew",
									{ 
									day: $( "#day" ).val(),
									leavefrom: $( "#leavefrom" ).val(),
									month: $( "#month" ).val(),
									amount: $( "#amount" ).val(),
									tripname: $( "#tripname" ).val()
									},
									function(oReply){
										if(oReply.STATUS == true){
										$("#createTripFom").hide();
										$("#budgetcount").html(oReply.BUDGET);
										$("#tripnametext").html(oReply.TRIPTEXT);
										$("#TripDisplay").show(); 
										
										jQuery.cookie('tripid', oReply.ID, { domain: 'travelplanner.ph', path: '/' });
				
										$("#trip_Dialog").dialog("close");
										} else{
										alert("There was an error in the database. Please create a trip again.");
										}
									},
									"json"
									);
								},
								"Cancel": function(){
								$(this).dialog("close");
								}
							}
					});
			}
		);

		$("#showcal").click(
		function(){
			$("#showcal_Dialog").dialog({
							modal: true,
							autoOpen: true,
							resizable: false,
							width: 890,
							height: 720,
							buttons: {
								"Close": function(){
								$(this).dialog("close");
								}
							}
					});
			}
		);		
	}
);

function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}