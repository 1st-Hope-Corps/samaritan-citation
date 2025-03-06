function time_tracker_DisplayTimer(){
	time_tracker_iSpent++;
	time_tracker_iAvailable--;
	
	var oDateSpent = new Date(1970,0,1);
	var oDateAvailable = new Date(1970,0,1);
	
	oDateSpent.setSeconds(time_tracker_iSpent);
	oDateAvailable.setSeconds(time_tracker_iAvailable);
	
	var aDateSpent = oDateSpent.toTimeString().substr(0,8).split(":");
	var aDateAvailable = oDateAvailable.toTimeString().substr(0,8).split(":");
	
	var iTimeHours = parseInt(time_tracker_iAvailable/60/60, 10);
	var sTotalHours = (iTimeHours >= 24) ? iTimeHours:aDateAvailable[0];
	
	var sTimerAvailableHTML = sTotalHours+' hour(s) - '+aDateAvailable[1]+' min(s) - '+aDateAvailable[2]+' sec(s)';
	var sTimerSpentHTML = aDateSpent[0]+' hour(s) - '+aDateSpent[1]+' min(s) - '+aDateSpent[2]+' sec(s)';
	
	
	$("#time_tracker_TimeAvailable").html(sTimerAvailableHTML);
	$("#TimerBlockAvailable").show();
	
	$("#time_tracker_TimeSpent").html(sTimerSpentHTML);
}

function time_tracker_Update(){
	$.post(
		time_tracker_sBasePath+"time_tracker/update",
		{sec: time_tracker_iSpent},
		function(sReply){},
		"text"
	);
}

function time_tracker_Get(){
	$.post(
		time_tracker_sBasePath+"time_tracker/time",
		{x: 1},
		function(sReply){
			time_tracker_iSpent = parseInt(sReply);
		},
		"text"
	);
}

$(document).ready(
	function(){
		time_tracker_Get();
		
		setInterval("time_tracker_DisplayTimer()", 1000);
		setInterval("time_tracker_Update()", 60000);
		
		var sPreMoreLess = "time_tracker_";
		
		$("sup[id^="+sPreMoreLess+"]").each(
			function(){
				$("sup#"+this.id).hover(
					function(){
						$(this).css("cursor", "pointer");
					},
					function(){
						$(this).css("cursor", "default");
					}
				);
				
				var sWhich = this.id.replace(sPreMoreLess, "");
				
				$("sup#"+this.id).click(
					function(){
						if (sWhich == "More"){
							$("#TimerBlockSpent").show();
						}else{
							$("#TimerBlockSpent").hide();
						}
					}
				);
			}
		);
		
		$("a").each(
			function(){
				$(this).click(
					function(){
						time_tracker_Update();
					}
				);
			}
		);
	}
);

$(window).scroll(
	function(){
		$("#TimerBlockAvailable").animate(
			{top: $(window).scrollTop() + "px"},
			{
				queue: false,
				duration: 1
			}
		);
		
		$("#TimerBlockSpent").animate(
			{top: ($(window).scrollTop() + 60) + "px"},
			{
				queue: false,
				duration: 1
			}
		);
	}
);

$(window).unload(
	function(){
		time_tracker_Update();
	}
);