$(document).ready(
	function (){
		ApplyOffset("home_Carousel", 230, "-");
		// ApplyOffset("under_construction", 160, "+");
		
		// $("#home_Content1stHopeCorps").jScrollPane({showArrows:true, scrollbarWidth: 17});
		$("#home_ContentLivelihood").jScrollPane({showArrows:true, scrollbarWidth: 17});
		$("#home_ContentPeace").jScrollPane({showArrows:true, scrollbarWidth: 17});
		
		$(".jScrollPaneContainer #home_ContentLivelihood").parent().hide();
		$(".jScrollPaneContainer #home_ContentPeace").parent().hide();
		
		$("#home_login").click(
			function(){
				$("#home_loginNotice").toggle();
			}
		); 
		
		$("#home_register").click(
			function(){
				$("#home_MembershipNotice").toggle();
			}
		);
		
		$("#notlogeddinredirect").click(
			function(){
				$("#home_notLoggedinmessage").toggle();
			}
		);
		
		$("#logeddinredirect").click(
			function(){
				//window.location = "http://www.hopecybrary.org/hopenet.php";
				window.location = "/hud-v2.php";
			}
		);
	}
);

function ToggleMe(){
	$("#more_txt").toggle();
	$("#learn_more").toggle();
	$("#hide_more").toggle();
}

function GetWindowWidth(){
	if (parseInt(navigator.appVersion) > 3) {
		if (navigator.appName == "Netscape") {
			iWinW = window.innerWidth;
			//iWinH = window.innerHeight;
		}
		
		if (navigator.appName.indexOf("Microsoft") != -1) {
			iWinW = document.body.offsetWidth;
			//iWinH = document.body.offsetHeight;
		}
	}
	
	return iWinW;
}

// Computes and applies the offset depending on the dimensions of the browser window
function ApplyOffset(sId, iInputOffset, sOffsetOperand){
	iOffset = GetWindowWidth()/2;
	iOffset = (sOffsetOperand == "+") ? iOffset+iInputOffset:iOffset-iInputOffset;
	
	$("#"+sId).css("left", iOffset+"px");
}

window.onresize = function(){
	ApplyOffset("home_Carousel", 230, "-");
	// ApplyOffset("under_construction", 160, "+");
}