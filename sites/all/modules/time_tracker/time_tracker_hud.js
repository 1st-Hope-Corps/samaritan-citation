var iDisplayTimerUUID = 0;

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
	$("#time_tracker_TimeSpent").html(sTimerSpentHTML);
	
	if (parseInt(sTotalHours, 10) == 0 && parseInt(aDateAvailable[1], 10) == 0 && parseInt(aDateAvailable[2], 10) == 0){
		clearInterval(iDisplayTimerUUID);
		location = hud_sBasePath+'time/buy';
	}
}

function time_tracker_Update(){
	$.post(
		time_tracker_sBasePath+"time_tracker/update",
		{sec: time_tracker_iSpent},
		function(sReply){},
		"text"
	)
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
		
		iDisplayTimerUUID = setInterval("time_tracker_DisplayTimer()", 1000);
		setInterval("time_tracker_Update()", 60000);
		
		
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

$(window).unload(
	function(){
		time_tracker_Update();
	}
);
