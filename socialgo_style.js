$(document).ready(
	function(){
		var logoCnt = document.getElementById('header').innerHTML;
		var headerMnu = document.getElementById('navigation-wrapper').innerHTML;
		document.getElementById('header').innerHTML = '<div class="header_logo">'+logoCnt+'</div><div class="header_img"></div><div class="header_mnu">'+headerMnu+'</div>';
		var container_txt = document.getElementById('body-container').innerHTML;
		document.getElementById('body-container').innerHTML = '<div class="border-left"><div class="border-right"><div class="border-top"><div class="border-bot"><div class="corner-top-left"><div class="corner-top-right"><div class="corner-bot-left"><div class="corner-bot-right"><div class="inner"><div class="inner_pdg">'+container_txt+'<div class="clr"></div></div></div></div></div></div></div></div></div></div></div>';
		//var sidebar = document.getElementById('sidebar').innerHTML;
		//document.getElementById('sidebar').innerHTML = '<div class="sidebar_top"></div><div class="sidebar_mid">'+sidebar+'</div><div class="sidebar_bot"></div>';
		
		if (document.getElementById('zone-a')){
			var sidebar_inner = document.getElementById('zone-a').innerHTML;
			document.getElementById('zone-a').innerHTML = sidebar_inner+'<div class="sidebar_lst"></div>';
		}

		if (document.getElementById('profile-mp3')){
			var pro_mp3 = document.getElementById('profile-mp3').innerHTML;
			document.getElementById('profile-mp3').innerHTML = '<div class="pro_mp3">'+pro_mp3+'</div>';
		}
	}
);