var sPostContent_Temp = 'Write Something...';
var sCommentContent_Temp = 'Write a comment...';

$(document).ready(
	function(){
        
		if ($('#wall_Main_sPostMedia').length == 1){
			document.getElementById('wall_Main_sPostMedia').addEventListener('change', handler_FileSelect, false);
		}
//                if ($('#wall_Main_sPostMedia_kindness').length == 1){
//			document.getElementById('wall_Main_sPostMedia_kindness').addEventListener('change', handler_FileSelect_kindness, false);
//		}
                
		$('#wall_Main_sPostMedia_kindness').live('change',handler_FileSelect_kindness);
                
		$('#wall_Main_sPostContent_kindness').live('click',function(){
					handler_Main_OnFocus_kindness();
				}
			)
			.focus(
				function(){
					handler_Main_OnFocus_kindness();
				}
			)
			.blur(
				function(){
					var sContent = $('#wall_Main_sPostContent_kindness').val();
					
					if (sContent == ''){
						$('#wall_Main_sPostContent_kindness')
							.val(sPostContent_Temp)
							.css({'color':'#bdc7d8', 'height':'45'});
					}
				}
			)
			.keyup(
				function(e){
					while ($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
						$(this).height($(this).height()+1);
					};
				}
			);
                
               // $('#wall_Main_sPostContent').click(function(){
                    	$('#wall_Main_sPostContent').live('click',function(){
					handler_Main_OnFocus();
				}
			)
			.focus(
				function(){
					handler_Main_OnFocus();
				}
			)
			.blur(
				function(){
					var sContent = $('#wall_Main_sPostContent').val();
					
					if (sContent == ''){
						$('#wall_Main_sPostContent')
							.val(sPostContent_Temp)
							.css({'color':'#bdc7d8', 'height':'45'});
					}
				}
			)
			.keyup(
				function(e){
					while ($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
						$(this).height($(this).height()+1);
					};
				}
			);
		
		//$('#wall_Main_btnPost_kindness').click(function(){
                        $('#wall_Main_btnPost_kindness').live("click",function(){
                      
				var sPostContent = $('#wall_Main_sPostContent_kindness').val();
				
				if (sPostContent == sPostContent_Temp || jQuery.trim(sPostContent) == ''){
					alert('Write something first.');
					$('#wall_Main_sPostContent_kindness').focus();
				}else{
                               var options = { 
        success : function(data){
    $('#kindness_report_posts').html(data);

    setTimeout(function(){
if ($(".jScrollPaneContainer div.kindness_posts_tab").parent().length == 0){
             
				$("div.kindness_posts_tab").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			$(".jScrollPaneContainer").show();
    //your code to be executed after 1 seconds
    },2000);
            
  }
  };
  
			$("#form_Main_kindness").ajaxForm(options).submit();
//			        $.ajax({
//           type: "POST",
//           url: hud_sBasePath+"user/profile/wall/process/kindness_report/posts",
//           data: $("#form_Main_kindness").serialize(), // serializes the form's elements.
//           success: function(data)
//           {
//              
//              $('#kindness_report_posts').html(data);
//           }
//         });
		
					//$('#form_Main_kindness').submit();
				}
			}
		);
        		//$('#wall_Main_btnPost').click(function(){
                            	$('#wall_Main_btnPost').live('click',function(){
				var sPostContent = $('#wall_Main_sPostContent').val();
				
				if (sPostContent == sPostContent_Temp || jQuery.trim(sPostContent) == ''){
					alert('Write something first.');
					$('#wall_Main_sPostContent').focus();
				}else{
					$('#form_Main').submit();
				}
			}
		);
		
              // 	$('.kindness_post_delete_button').click(function(){
                 $('.kindness_post_delete_button').live('click',function(){
			if (confirm('Are you sure you want to Delete Post?')) {
                    $('#form_delete_kindness').submit();
                        } else {
                    return false;
                        }	
		}
		); 
        $('.kindness_post_delete_button_kindness_report').live('click',function(e){
          e.preventDefault();
			if (confirm('Are you sure you want to Delete Post?')) {
                $.ajax({
           type: "POST",
           url: hud_sBasePath+"user/profile/wall/process",
           data: $("#form_delete_kindness").serialize(), // serializes the form's elements.
           success: function(data)
           {
              
             $('#kindness_report_posts').html(data);
                 setTimeout(function(){
if ($(".jScrollPaneContainer div.kindness_posts_tab").parent().length == 0){
             
				$("div.kindness_posts_tab").jScrollPane({showArrows:true, scrollbarWidth: 17});
			}
			$(".jScrollPaneContainer").show();
    //your code to be executed after 1 seconds
    },2000);
           }
         });
		
                        } else {
                    return false;
                        }	
		}
		);
        
        
         	//$('#wall_Main_btn_Post_delete_kindness_status').click(function(){
//                     $('#wall_Main_btn_Post_delete_kindness_status').live('click',function(){
//			if (confirm('Are you sure you want to Delete Post?')) {
//                    $('#form_delete_kindness_status').submit();
//                        } else {
//                    return false;
//                        }	
//		}
//		); 
        
        	//$('#wall_Main_btn_Post_delete').click(function(){
//                     $('#wall_Main_btn_Post_delete').live('click',function(){
//                    
//			if (confirm('Are you sure you want to Delete Post?')) {
//                    $('#form_delete').submit();
//                        } else {
//                    return false;
//                        }	
//		}
//		);
        //$('#wall_Main_sPostContent_kindness').live('click',function(){
                 $('#wall_Main_sPostContent_kindness').live('click',function(){
			$('#wall_Main_File_Container_kindness').show();
	$('#wall_Main_Preview_Container_kindness').show();
		}
		);
        
		$('button[id^=wall_Comment_btnPost_kindness_]').each(
			function(){
				var iPostId = this.id.replace('wall_Comment_btnPost_kindness_', '');
				
				$(this).click(
					function(){
						var sCommentContent = $('#post_a_comment_kindness_'+iPostId).val();
						
						if (sCommentContent == sCommentContent_Temp || jQuery.trim(sCommentContent) == ''){
							alert('Write something first.');
							$('#post_a_comment_kindness_'+iPostId).focus();
						}else{
							$('#form_Comment_kindness_'+iPostId).submit();
						}
                                                
					}
				);
			}
		);
        
        $('button[id^=wall_Comment_btnPost_]').each(
			function(){
				var iPostId = this.id.replace('wall_Comment_btnPost_', '');
				
				$(this).click(
					function(){
						var sCommentContent = $('#post_a_comment_'+iPostId).val();
						
						if (sCommentContent == sCommentContent_Temp || jQuery.trim(sCommentContent) == ''){
							alert('Write something first.');
							$('#wall_Comment_sPostContent_'+iPostId).focus();
						}else{
							$('#form_Comment_'+iPostId).submit();
						}
                                                
					}
				);
			}
		);
		
		$('textarea[id^=wall_Comment_sPostContent_]').each(
			function(){
				var iPostId = this.id.replace('wall_Comment_sPostContent_', '');
				
				$(this)
					.click(
						function(){
							handler_Comment_OnFocus(iPostId);
						}
					)
					.focus(
						function(){
							handler_Comment_OnFocus(iPostId);
						}
					)
					.blur(
						function(){
							var sContent = $('#wall_Comment_sPostContent_'+iPostId).val();
							
							if (sContent == ''){
								$('#wall_Comment_sPostContent_'+iPostId)
									.val(sCommentContent_Temp)
									.css({'color':'#bdc7d8', 'height':'45'});
							}
						}
					)
					.keyup(
						function(e){
							while ($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
								$(this).height($(this).height()+1);
							};
						}
					);
			}
		);
        
        


  $("#wall_Main_sPostContent").val('');
    $("#wall_Main_sPostContent").keypress(function(e) {
        var textLength = $("#wall_Main_sPostContent").val().length;
       var div = document.getElementById('wall_Main_sPostContent');
var style = getComputedStyle(div);
var textheight = parseInt(style.getPropertyValue("height"));

   
       if(e.keyCode == 13)
       {
        $("#wall_Main_sPostContent").css('height', 10+textheight);
        
    }else
    {
              if (textLength % 70 == 0) {
            var height = textLength/50;
            $("#wall_Main_sPostContent").css('height', 10+textheight);
        } 
    }
    });
    
    
    $("#wall_Main_sPostContent_kindness").val('');
    $("#wall_Main_sPostContent_kindness").keypress(function(e) {
        var textLength = $("#wall_Main_sPostContent_kindness").val().length;
       var div = document.getElementById('wall_Main_sPostContent_kindness');
var style = getComputedStyle(div);
var textheight = parseInt(style.getPropertyValue("height"));

   
       if(e.keyCode == 13)
       {
        $("#wall_Main_sPostContent_kindness").css('height', 10+textheight);
        
    }else
    {
              if (textLength % 70 == 0) {
            var height = textLength/50;
            $("#wall_Main_sPostContent_kindness").css('height', 10+textheight);
        } 
    }
    });
	}
);

function handler_Main_OnFocus_kindness(){
	var sContent = $('#wall_Main_sPostContent_kindness').val();
	
	if (sContent == sPostContent_Temp){
		$('#wall_Main_sPostContent_kindness')
			.val('')
			.css('color', '#000000');
	}
	
	//$('#wall_Main_sPostContent').css('height', '45');
	$('#wall_Main_File_Container_kindness').show();
	$('#wall_Main_Preview_Container_kindness').show();
}

function handler_Main_OnFocus(){
	var sContent = $('#wall_Main_sPostContent').val();
	
	if (sContent == sPostContent_Temp){
		$('#wall_Main_sPostContent')
			.val('')
			.css('color', '#000000');
	}
	
	//$('#wall_Main_sPostContent').css('height', '45');
	$('#wall_Main_File_Container').show();
	$('#wall_Main_Preview_Container').show();
}

function handler_Comment_OnFocus(iPostId){
	var sContent = $('#wall_Comment_sPostContent_'+iPostId).val();
	
	if (sContent == sCommentContent_Temp){
		$('#wall_Comment_sPostContent_'+iPostId)
			.val('')
			.css('color', '#000000');
	}
}


function handler_FileSelect(oEvent) {
	var files = oEvent.target.files; // FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {
		// Only process image files.
		if (!f.type.match('image.*')) continue;
		
		var reader = new FileReader();
		
		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
				// Render thumbnail.
				var span = document.createElement('span');
				span.innerHTML = ['<img class="wall_Main_sPostMedia_Preview_Thumb" src="', e.target.result,
							'" title="', escape(theFile.name), '"/>'].join('');
				document.getElementById('wall_Main_sPostMedia_Preview').insertBefore(span, null);
			};
		})(f);
		
		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
	}
}

function handler_FileSelect_kindness(oEvent) {
   
	var files = oEvent.target.files; // FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {
		// Only process image files.
		if (!f.type.match('image.*')) continue;
		
		var reader = new FileReader();
		
		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
				// Render thumbnail.
				var span = document.createElement('span');
				span.innerHTML = ['<img class="wall_Main_sPostMedia_Preview_Thumb" src="', e.target.result,
							'" title="', escape(theFile.name), '"/>'].join('');
				document.getElementById('wall_Main_sPostMedia_Preview_kindness').insertBefore(span, null);
			};
		})(f);
		
		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
	}
}