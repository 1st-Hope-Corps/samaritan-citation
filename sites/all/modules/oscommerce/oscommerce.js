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
	}
})(jQuery);

$(document).ready(
	function(){
		$("#sProductType1").click(
			function(){
				$("#oscommerce_download_field").hide();
				$("#bSaveFromNing").unbind("click");
			}
		);
		
		$("#sProductType2").click(
			function(){
				$("#oscommerce_download_field").show();
				$("#bSaveFromNing").unbind("click");
				$("#bSaveFromNing").click(
					function(){
						if ($("#sProductToDownload").val() == "") alert("Please specify the Downloadable Product/Item to upload.");
					}
				);
			}
		);
	}
);

function _oscommerce_upload_stat(){
	$("#oscommerce_file_progress").load(oscommerce_sBasePath+"sites/all/modules/oscommerce/upload_server.php");
}

// Checks the specified fieldnames before form submit
function CheckForm(oForm, aReqField, aFieldDesc){
	var sAlertMsg = "Please complete the following fields:\n\n";
	var iMsgLen = sAlertMsg.length;
	
	for (var i = 0; i < aReqField.length; i++){
		var oElements = oForm.elements[aReqField[i]];
		
		if (oElements){
			switch(oElements.type){
				case "select-one":
					if (oElements.selectedIndex == -1 || oElements.options[oElements.selectedIndex].text == "" || 
							oElements.options[oElements.selectedIndex].value == ""){
						sAlertMsg += " - " + aFieldDesc[i] + "\n";
					}
					
					break;
				case "select-multiple":
					if (oElements.selectedIndex == -1) sAlertMsg += " - " + aFieldDesc[i] + "\n";
					
					break;
				case "text":
				case "textarea":
					sTextVal = Trim(oElements.value);
					
					if (oElements.value == null || oElements.text == "" || sTextVal == "" ||
							sTextVal == "Last Name" || sTextVal == "Given Name" || sTextVal == "Middle Name"){
						sAlertMsg += " - " + aFieldDesc[i] + "\n";
					}
					
					break;
				default:
					sDefaultVal = oElements.value;
					
					if (oElements.value == "" || oElements.value == null || Trim(sDefaultVal) == ""){
						sAlertMsg += " - " + aFieldDesc[i] + "\n";
					}
			}
		}
	}
	
	if (sAlertMsg.length == iMsgLen){
		return true;
	}else{
		alert(sAlertMsg);
		return false;
	}
}

// Trims the specified text
function Trim(sInputString){ 
	 return sInputString.replace(/^\s*|\s*$/g,""); 
}

// Allow the specified keys only
// 1 = integer
// 2 = float (.)
// 3 = date (-)
function RestrictKeys(sInputVal, iMode){
	var sOutput = "";
	var iInputLen = sInputVal.length;
	
	if (iInputLen == 0) return "";
	
	for (var iCounter=0; iCounter < iInputLen; iCounter++){
		var iChar = sInputVal.charCodeAt(iCounter);
		
		if (iChar >= 48 && iChar <= 57) sOutput += sInputVal.charAt(iCounter);
		if (iMode == 2 && iChar == 46) sOutput += sInputVal.charAt(iCounter);
		if (iMode == 3 && iChar == 45) sOutput += sInputVal.charAt(iCounter);
	}
	
	return sOutput;
}

function SubCheckForm(oInputForm){
	var aReqField = Array("sProductImage","sProductName","sManufacturer","sDescription","mPrice","iQuantity");
	var aFieldDesc = Array("Product Image","Product Name","Manufacturer","Product Description","Price","Quantity");
	
	var sType = $('input:radio[name=sProductType]:checked').val();
	
	if (sType == "download"){
		aReqField[6] = "sProductToDownload";
		aFieldDesc[6] = "Downloadable Product/Item to upload";
	}
	
	var bValid = CheckForm(oInputForm, aReqField, aFieldDesc);
	
	if (bValid){
		$("#oscommerce_file_progress_notice").show().center();
		
		if (sType == "download"){
			$("#oscommerce_file_progress_container").hide();
		}else if (sType == "hard"){
			setInterval(_oscommerce_upload_stat, 1000);
		}
	}
	
	return bValid;
}