//ITD_EFILING_COMMON

function hideDiv(){
var a =$('#doDisplay').val();
	if(a!="dodisplay")
		$('#hindi').hide();
}



function backToHomePage() {

	var varRandNum="";
	if( document.forms[0].elements['requestId']==undefined){
		varRandNum = document.forms[0].elements['ID'].value;
	}else{
		varRandNum = document.forms[0].elements['requestId'].value;
	}

	document.forms[0].action= "/e-Filing/MyAccount/MyAccountHome.html?ID="+varRandNum;
	document.forms[0].onsubmit ="";
	document.forms[0].submit();
}

function backToTempUserHomePage() {

	var varRandNum = document.forms[0].elements['requestId'].value;
	document.forms[0].action= "/e-Filing/MyAccount/backToTempUserHomePage.html?ID="+varRandNum;
	document.forms[0].onsubmit ="";
	document.forms[0].submit();
}

function backToHomePageGuest() {

	document.forms[0].action= "/home/";
	document.forms[0].onsubmit ="";
	document.forms[0].submit();
}

function backToGrievHomePage() {

	var varRandNum = "";
	if (document.forms[0].elements['requestId'] == undefined) {
		varRandNum = document.forms[0].elements['ID'].value;
	} else {
		varRandNum = document.forms[0].elements['requestId'].value;
	}
	document.forms[0].action = "/e-Filing/MyServices/SubmitGrievanceHomeLink.html?ID=" + varRandNum;
	document.forms[0].onsubmit = "";
	document.forms[0].submit();
}


function displayDscType(paramValue) {
	if (paramValue == 1) {
		document.getElementById("registerDscPfx").style.display = "";
		document.getElementById("registerDscUsb").style.display = "none";
	} else {
		document.getElementById("registerDscPfx").style.display = "none";
		document.getElementById("registerDscUsb").style.display = "";
	}
}

function resetFields(){

	var elements = document.forms[0].elements;
	var type = '';
	for(e in elements){
		type = elements[e].type;
		if( type == 'text' ||  type == 'textarea'){
			if(elements[e].readOnly==false){
				elements[e].value = '';
			}
 		}else if(type == 'select-one'){
			elements[e].value = '-1';
		}
	}
	return false;
}

function displayDscSignUpload() {

	document.getElementById("signWithDscUsb").style.display = "none";

	document.getElementById("signWithDscPfx").style.display = "none";

	if (document.getElementById("optionTypeOfDsc1").checked) {

		document.getElementById("signWithDscPfx").style.display = "";

	}
	if (document.getElementById("optionTypeOfDsc2").checked) {

		document.getElementById("signWithDscUsb").style.display = "";
	}
}

function lowerToUpper(elem){

	elem.value=elem.value.toUpperCase();
}

function changeImg() {

	 var imgElement =  document.getElementById("captchaImg") ;

	 imgElement.src = "/e-Filing/CreateCaptcha.do?"+Math.random();

	 document.getElementById("captchaImg").focus;

}

function playAudioCaptcha() {

	var audioCaptcha =  document.getElementById("audioCaptcha") ;

	audioCaptcha.src = "/e-Filing/CreateAudioCaptcha.do?"+Math.random();

	audioCaptcha.play();

}

function disableFormSubmit(form) {

	if (document.all || document.getElementById) {

		for (var i = 0; i < form.length; i++) {
			var formElement = form.elements[i];
			if (formElement.type == "submit") {
				// alert (formElement);
				//formElement.disabled = true;
				formElement.onclick = function(){return false};
			}

		}



		$("#loading").dialog("open");

		var method = form.method;

		if (method == "get") {
			$("#loading").dialog("close");
		}

	}
}


function disableFormSubmitOnline(form) {

	if (document.all || document.getElementById) {

		for (var i = 0; i < form.length; i++) {
			var formElement = form.elements[i];
			if (formElement.type == "submit") {
				// alert (formElement);
				formElement.onclick = function(){return false};
			}

		}
	}
}

function setSearchLength(){
	if (document.getElementById('searchAccOptionId').value === '1') {
		document.getElementById('inputID').setAttribute("maxlength", "100");
	} else if (document.getElementById('searchAccOptionId').value === '2') {
		document.getElementById('inputID').setAttribute("maxlength", "10");
	}
}

function prepareSearch(opt){
	document.getElementById('searchAccOptionId').value=opt;
	setSearchLength();
}

function onlySearch(e,dropDownvalue){
	if(dropDownvalue=='1'){
		return true;
	}
	else if(dropDownvalue==='2'){

	return onlyNumbers(e);
	}
}



function checkBrowser(){

	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion);
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	// In Opera, the true version is after "Opera" or after "Version"
	/* if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	 browserName = "Opera";
	 fullVersion = nAgt.substring(verOffset+6);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1)
	   fullVersion = nAgt.substring(verOffset+8);
	} */
	// In MSIE, the true version is after "MSIE" in userAgent
	if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 browserName = "Microsoft Internet Explorer";
	 fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome"
	/* else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 browserName = "Chrome";
	 fullVersion = nAgt.substring(verOffset+7);
	} */
	// In Safari, the true version is after "Safari" or after "Version"
	/* else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 browserName = "Safari";
	 fullVersion = nAgt.substring(verOffset+7);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1)
	   fullVersion = nAgt.substring(verOffset+8);
	} */
	// In Firefox, the true version is after "Firefox"
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 browserName = "Firefox";
	 fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
			  (verOffset=nAgt.lastIndexOf('/')) ){
	 browserName = nAgt.substring(nameOffset,verOffset);
	 fullVersion = nAgt.substring(verOffset+1);
	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	  browserName = navigator.appName;
	 }
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=fullVersion.indexOf(";"))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	if ((ix=fullVersion.indexOf(" "))!=-1)
	   fullVersion=fullVersion.substring(0,ix);

	majorVersion = parseInt(''+fullVersion,10);
	if (isNaN(majorVersion)) {
	 fullVersion  = ''+parseFloat(navigator.appVersion);
	 majorVersion = parseInt(navigator.appVersion,10);
	}


	if((browserName.toUpperCase().indexOf("FIREFOX", 0)!=-1 && majorVersion < 7) ||
		(browserName.toUpperCase().indexOf("MICROSOFT", 0)!=-1 && majorVersion < 7)){
		alert('Your browser was detected to be outdated and incompatible with the website.'+
				'\nPlease use latest browsers viz. \n IE7 or later , Chrome , firefox v7 or later');
		backToHomePage();
	}
}


function displayDscUpload(paramValue) {

	try {
		document.getElementById("registerDscUsb").style.display = "none";
		document.getElementById("registerDscPfx").style.display = "none";
		if (paramValue == 1) {
			document.getElementById("registerDscPfx").style.display = "";
			document.getElementById("fileUsb").value="";

		} else if (paramValue == 2){
			document.getElementById("registerDscUsb").style.display = "";
			document.getElementById("filePfx").value="";
		}
	} catch (e) {

	}

	nrfdDtls();

	}

//FONT_MAGNIFIER

measureUnit = "px"

	// Minimum size allowed for SIZE attribute (like in <FONT SIZE="1"> )
	minSize = 1;

	// Minimum size allowed for STYLE attribute (like in <FONT STYLE="font-size: 10px"> )
	minStyleSize = 10;

	// Maximum size allowed for SIZE attribute
	maxSize = 6;

	// Maximum size allowed for STYLE attribute
	maxStyleSize = 14;


	// Start size for tags with no SIZE attribute defined
	startSize = 1;

	// Start size for tags with no font-size STYLE or CLASS attribute defined
	startStyleSize = 10;

	// Increasing and decreasing step
	stepSize = 1;

	// Increasing step for STYLE definition (measure previously declared will be used)
	stepStyleSize = 2;

	function searchTags(childTree, level) {
	  var retArray = new Array();
	  var tmpArray = new Array();
	  var j = 0;
	  var childName = "";
	  for (var i=0; i<childTree.length; i++) {
	    childName = childTree[i].nodeName;
	    if (childTree[i].hasChildNodes()) {
	      if ((childTree[i].childNodes.length == 1) && (childTree[i].childNodes[0].nodeName == "#text"))
	        retArray[j++] = childTree[i];
	      else {
	        tmpArray = searchTags(childTree[i].childNodes, level+1);
	        for (var k=0;k<tmpArray.length; k++)
	          retArray[j++] = tmpArray[k];
	        retArray[j++] = childTree[i];
	      }
	    }
	    else
	      retArray[j++] = childTree[i];
	  }
	  return(retArray);
	}



	function changeFontSize(stepSize, stepStyleSize) {


		try {
	  if (document.body) {
	    var myObj = searchTags(document.body.childNodes, 0);

	    var myStepStyleSize = stepStyleSize/10  ;


	    for ( i=0; i < myObj.length; i++ ) {
	      myObjName = myObj[i].nodeName;

	      // Only some tags will be parsed
	      if (myObjName != "#text" && myObjName != "HTML" &&
	          myObjName != "HEAD" && myObjName != "TITLE" &&
	          myObjName != "STYLE" && myObjName != "SCRIPT" &&
	          myObjName != "BR" && myObjName != "TBODY" &&
	          myObjName != "#comment" && myObjName != "FORM") {

	        // Skip INPUT fields, if required
	        if (myObjName == "INPUT") continue;

			styleSize = parseInt(window.getComputedStyle(myObj[i], null).fontSize);

	        // Internet Explorer uses a different DOM implementation

	        if (isNaN(styleSize) && myObj[i].currentStyle)
	          styleSize = parseInt(myObj[i].currentStyle.fontSize);



	        // For debug purpose only. Note: can be very annoying

			//alert ('styleSize :- ' + styleSize);

			if (isNaN(styleSize)) {

				styleSize = startStyleSize;

			}



	        if ( ((styleSize > minStyleSize) && (styleSize < maxStyleSize)) ||
	             ((styleSize == minStyleSize) && (stepStyleSize > 0)) ||
	             ((styleSize == maxStyleSize) && (stepStyleSize < 0)) ) {
	          newStyleSize = styleSize + ( myStepStyleSize * styleSize) ;
	          myObj[i].style.fontSize = newStyleSize+measureUnit;
	        }


	      } // End if condition ("only some tags")
	    } // End main for cycle



	  } // End if condition ("document.body exists")
	  }
	  catch (e) {
		//alert (' Uma :- ' + e);
	  }

	} // End function declaration


	function resetFonSize() {

	  if (document.body) {
	    var myObj = searchTags(document.body.childNodes, 0);


	    for ( i=0; i < myObj.length; i++ ) {
	      myObjName = myObj[i].nodeName;



	      // Only some tags will be parsed
	      if (myObjName != "#text" && myObjName != "HTML" &&
	          myObjName != "HEAD" && myObjName != "TITLE" &&
	          myObjName != "STYLE" && myObjName != "SCRIPT" &&
	          myObjName != "BR" && myObjName != "TBODY" &&
	          myObjName != "#comment" && myObjName != "FORM") {

			 // Skip INPUT fields, if required
	        if (myObjName == "INPUT") continue;

			  myObj[i].style.fontSize = "";


	      } // End if condition ("only some tags")
	    } // End main for cycle



	  } // End if condition ("document.body exists")
	} // End function declaration



	function gotoPage(url){
		window.location = url;
	}
	

	function setBaseUrl(url){
			baseUrl = url;
	}


	function loadStaticPageMme(id,url) {
		$("#"+id).load(url);
	}

	function getStaticPageFromHomePage(staticContentsUrl){
		document.getElementById("staticContentsUrl").innerHTML = '';
		loadStaticPageMme("staticContentsUrl","/eFiling/Portal/"+staticContentsUrl+"?"+Math.random());

		document.getElementById("staticContentsUrl").className = 'leftColumn';

		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());

	}


	function downloadThisForm(formName,formType){

		if(formName=='ITR-7-new')
		{
			formName='ITR-7';
		}

		if(formName=='ITR-5-new')
		{
			formName='ITR-5';
		}

		var asstYear = "2013";

		if (document.getElementById('asstYear') != null) {
			asstYear =  document.getElementById('asstYear').value;
		}

		if(formType == 'excelZip' 	|| formType == 'excel' && (asstYear == '2017'))
		{
				/*alert('ITR utilities are developed using MS-Office Excel technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating system like Windows 7 / 8 with .Net Framework 3.5 and MS office 2007/2010/2013\n\nThe downloaded ZIP folder of the requisite ITR should be Extracted/Unzipped before opening the Excel utility. Please enable Macros in the excel sheet before entering data.');*/
				window.open("/eFiling/Portal/DownloadUtil/"+asstYear+'/'+formName.replace("-" , "")+'_'+ asstYear+'.zip?'+Math.random(),'_blank');

		}
		else if(formType == 'pdf') {
			window.open("/eFiling/Portal/DownloadUtil/"+asstYear+'/Form-'+formName+'-'+asstYear+'.pdf?'+Math.random(),'_blank');
		}else if(formType == 'jfx'){
			if(formName=='CA'){
				window.open("/eFiling/Portal/DownloadUtil/"+asstYear+'/FORMS_'+asstYear+'.zip?'+Math.random(),'_blank');
			}else{
				window.open("/eFiling/Portal/DownloadUtil/FORM_UTILITY/"+formName+'_'+asstYear+'.zip?'+Math.random(),'_blank');
			}
		}else if(formType == 'jfxITR' && (asstYear == '2015' || asstYear == '2014') ){
			alert('ITR utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 or above is installed.\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');
			window.open("/eFiling/Portal/DownloadUtil/ITR_UTILITY/"+asstYear+'/'+formName+'_'+asstYear+'.zip?'+Math.random(),'_blank');
		}
		else if(formType == 'jfxITR' && !(asstYear == '2015' || asstYear == '2014')){
			/*alert('ITR utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS X 10.10, Where Java Runtime Environment Version 7 update 6 to Version 8 Update 51 is installed.\n\n JRE Version 8 Update 51 is available for download at the below link\n http://www.oracle.com/technetwork/java/javase/downloads/java-archive-javase8-2177648.html#jre-8u51-oth-JPR\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');*/
			window.open("/eFiling/Portal/DownloadUtil/ITR_UTILITY/"+asstYear+'/'+formName+'_'+asstYear+'.zip?'+Math.random(),'_blank');
		}

	}

function downloadThisFormBB(formName,formType){


		var	asstYear =  document.getElementById('asstYearBB').value;

		if(formType == 'jfxITR' && (asstYear == '2015' || asstYear == '2014') ){
			/*alert('ITR utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 or above is installed.\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');*/
			window.open("/eFiling/Portal/DownloadUtil/ITR_UTILITY/"+asstYear+'/'+formName+'_'+asstYear+'.zip?'+Math.random(),'_blank');
		}
		else if(formType == 'jfxITR' && !(asstYear == '2015' || asstYear == '2014')){
			/*alert('ITR utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 to Version 8 Update 51 is installed.\n\n JRE Version 8 Update 51 is available for download at the below link\n http://www.oracle.com/technetwork/java/javase/downloads/java-archive-javase8-2177648.html#jre-8u51-oth-JPR\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');*/
			window.open("/eFiling/Portal/DownloadUtil/ITR_UTILITY/"+asstYear+'/'+formName+'_'+asstYear+'.zip?'+Math.random(),'_blank');
		}

	}

	function downloadThisFormDTAA(formName,formType){


		if(formType == 'excelZip' 	|| formType == 'excel')
		{
				window.open("/eFiling/Portal/DownloadUtil/2015/DTAA/"+formName.replace("-" , "")+'_'+ "2015"+'.zip?'+Math.random(),'_blank');

		}
		else if(formType == 'jfxITR'){
			alert('ITR utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 or above is installed.\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');
			window.open("/eFiling/Portal/DownloadUtil/ITR_UTILITY/2015/DTAA/"+formName+'_'+"2015"+'.zip?'+Math.random(),'_blank');
		}


	}


	function downloadFormsAlert(){
			alert('FORM utilities are developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 or above is installed.\n\nThe downloaded ZIP folder of the requisite Form should be Extracted/Unzipped before opening the JAVA utility.');
	}


	function downloadFormsAlertFor61A(){
		alert('This FORM utility is developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 8 update 1.11 or above is installed.\n\nThe downloaded ZIP folder of the requisite Form should be Extracted/Unzipped before opening the JAVA utility.');
}



	function changeNote() {
	var asYear = document.getElementById('asstYear').value;
	if (asYear == '2014') {
		document.getElementById('1516').style.display = "block";
		document.getElementById('itr52014').style.display = "block";
		document.getElementById('other').style.display = "none";
		$('.coljava').show();
		document.getElementById('itr2Aversion1').style.display = "none";
		document.getElementById('itr2Aversion2').style.display = "none";
		document.getElementById('itr2Ains').style.display = "none";
		document.getElementById('itr4Sversion1').style.display = "none";
		document.getElementById('itr4Sversion2').style.display = "none";
		document.getElementById('itr4Sins').style.display = "none";
	} else {
		document.getElementById('1516').style.display = "none";
		document.getElementById('other').style.display = "block";
		document.getElementById('itr52014').style.display ="none";
	}
	if(asYear == '2012' || asYear == '2011'||asYear == '2010'||asYear == '2009'||asYear == '2008'||asYear == '2007'){
		document.getElementById('itr52014').style.display = "block";
		$('.coljava').hide();
	
	}
	else{
		
		document.getElementById('javaHeader').style.display = "";
		$('.coljava').show();
	}
	
	
	if (asYear == '2015') {
		document.getElementById('itr52015').style.display = "block";
		document.getElementById('itr52014').style.display = "none";
		document.getElementById('itr52016').style.display = "none";
		document.getElementById('itr52017').style.display = "none";
		document.getElementById('itr72015').style.display = "block";
		document.getElementById('itr72014').style.display = "none";
		document.getElementById('itr72016').style.display = "none";
		document.getElementById('itr72017').style.display = "none";
		$('.coljava').show();
		document.getElementById('itr2Aversion1').style.display = "none";
		document.getElementById('itr2Aversion2').style.display = "none";
		document.getElementById('itr2Ains').style.display = "none";
		document.getElementById('itr4Sversion1').style.display = "none";
		document.getElementById('itr4Sversion2').style.display = "none";
		document.getElementById('itr4Sins').style.display = "none";
	} else {
		
		document.getElementById('itr52015').style.display = "none";
		document.getElementById('itr72014').style.display = "block";
		document.getElementById('itr72015').style.display = "none";
		document.getElementById('itr72016').style.display = "none";
		document.getElementById('itr72017').style.display = "none";
	}

	if (asYear == '2016') {
		document.getElementById('itr4s2016').style.display = "block";
		document.getElementById('itr4s2015').style.display = "none";
		document.getElementById('itr72016').style.display = "block";
		document.getElementById('itr52016').style.display = "block";
		document.getElementById('itr72015').style.display = "none";
		document.getElementById('itr52014').style.display = "none";
		document.getElementById('itr72017').style.display = "none";
		document.getElementById('itr72014').style.display = "none";
		$('.coljava').show();
		document.getElementById('itr2Aversion1').style.display = "none";
		document.getElementById('itr2Aversion2').style.display = "none";
		document.getElementById('itr2Ains').style.display = "none";
		document.getElementById('itr4Sversion1').style.display = "none";
		document.getElementById('itr4Sversion2').style.display = "none";
		document.getElementById('itr4Sins').style.display = "none";
	
		
	} else {
		document.getElementById('itr4s2015').style.display = "block";
		document.getElementById('itr4s2016').style.display = "none";
		document.getElementById('itr72016').style.display = "none";
		document.getElementById('itr72017').style.display = "none";
		document.getElementById('itr52016').style.display = "none";
	}
	if (asYear == '2017') {
		document.getElementById('itr4sugam2017').style.display = "block";
		document.getElementById('itr4sugamhide2017').style.display = "none";
		document.getElementById('itr12017').style.display = "block";
		document.getElementById('itr1hid').style.display = "none";
		document.getElementById('itr22017').style.display = "block";
		document.getElementById('itr2hid').style.display = "none";
		document.getElementById('itr42017').style.display = "block";
		document.getElementById('itr4hid').style.display = "none";
		document.getElementById('itr52017').style.display = "block";
		document.getElementById('itr52014').style.display = "none";
		document.getElementById('itr52016').style.display = "none";
		document.getElementById('itr52015').style.display = "none";
		document.getElementById('itr72017').style.display = "block";
		document.getElementById('itr72016').style.display = "none";
		document.getElementById('itr72015').style.display = "none";
		document.getElementById('itr72014').style.display = "none";
		document.getElementById('itr32017').style.display = "block";
		document.getElementById('itr3hid').style.display = "none";
		document.getElementById("itr1IsId").style.display="";
		document.getElementById("itr2IsId").style.display="";
		document.getElementById("itr3IsId").style.display="";
		document.getElementById("itr4IsId").style.display="";
		document.getElementById("itr5IsId").style.display="";
		document.getElementById("itr6IsId").style.display="";		
		document.getElementById("itr7IsId").style.display="";
		$('.coljava').show();
		/*--end--*/

		} else {
		document.getElementById('itr4sugam2017').style.display = "none";
		document.getElementById('itr4sugamhide2017').style.display = "block";
		
		document.getElementById('itr12017').style.display = "none";
		document.getElementById('itr1hid').style.display = "block";
		document.getElementById('itr22017').style.display = "none";
		document.getElementById('itr2hid').style.display = "block";
		document.getElementById('itr42017').style.display = "none";
		document.getElementById('itr52017').style.display = "none";
		document.getElementById('itr4hid').style.display = "block";
		document.getElementById('itr32017').style.display = "none";
		document.getElementById('itr3hid').style.display = "block";
		document.getElementById('itr72017').style.display = "none";

	}
	if(asYear == '2013'){
	document.getElementById('itr52014').style.display = "block";
	document.getElementById('itr2Aversion1').style.display = "none";
	document.getElementById('itr2Aversion2').style.display = "none";
	document.getElementById('itr2Ains').style.display = "none";
	document.getElementById('itr4Sversion1').style.display = "none";
	document.getElementById('itr4Sversion2').style.display = "none";
	document.getElementById('itr4Sins').style.display = "none";
			$('.coljava').show();
	
	
	}

}


	function getStaticPage(staticContentsUrl){
		loadStaticPageMme("staticContentsUrl","/eFiling/Portal/"+staticContentsUrl+"?"+Math.random());
	}

	function getNewSubmitForm(){

		var submitForm = document.createElement("FORM");
		document.body.appendChild(submitForm);
		submitForm.method = "POST";

		return submitForm;

	}

	function disableForms(){

		var asYear=document.getElementById("asstYear").value;
		$('#itrtbl a, #DTAAtable a').each(function(){
			var id = $(this).attr('id');
			 id = id+asYear.toString();
			 var size=getFileSize(id);
			$(this).attr('data-size',size);
		});

		try{
		document.getElementById("itr1").style.display="";
		document.getElementById("itr2").style.display="";
		document.getElementById("itr2A").style.display="none";
		document.getElementById("itr3").style.display="";
		document.getElementById("itr4").style.display="";
		document.getElementById("itr4sDisplay").style.display="";
		document.getElementById("itr5").style.display="";
		document.getElementById("itr6").style.display="";
		document.getElementById("itr7").style.display="";
		document.getElementById("DTAAtable").style.display="none";
		document.getElementById("xslHeader").innerHTML="Excel Utility";
		showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
		showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'none');

		if(asYear=='2017'){
			document.getElementById("itr1").style.display="";
			document.getElementById("itr2").style.display="";
			document.getElementById("itr3").style.display="";
			document.getElementById("itr4").style.display="";
			document.getElementById("itr5").style.display="";
			document.getElementById("itr6").style.display="";
			document.getElementById("itr7").style.display="";
			document.getElementById("itr1JavaId").style.display="";
			document.getElementById("itr2JavaId").style.display="";
			document.getElementById("itr3JavaId").style.display="";
			document.getElementById("itr4JavaId").style.display="";
			document.getElementById("itr5JavaId").style.display="";
			document.getElementById("itr6JavaId").style.display="";
			document.getElementById("itr7JavaId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7xslId").style.display="";
			document.getElementById("itr4sDisplay").style.display="none";
			/* for checking*/
			document.getElementById("headHideExcel").style.display="";
			document.getElementById("headHideJava").style.display="";
			document.getElementById("headHideIns").style.display="";
			document.getElementById("version1excel").style.display="";
			document.getElementById("version1java").style.display="";
			document.getElementById("version2excel").style.display="";
			document.getElementById("version2java").style.display="";
			document.getElementById("version3excel").style.display="";
			document.getElementById("version3java").style.display="";
			document.getElementById("version4excel").style.display="";
			document.getElementById("version4java").style.display="";
			document.getElementById("version5excel").style.display="";
			document.getElementById("version5java").style.display="";
			document.getElementById("version6excel").style.display="";
			document.getElementById("version6java").style.display="";
			document.getElementById("version7excel").style.display="";
			document.getElementById("version7java").style.display="";
			$('.col1').show();
			
			
			/*-- end --*/
			document.getElementById("javaHeader").innerHTML="Java Utility";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'');
			document.getElementById("DTAAtable").style.display="none";
			
			
		}


		else if(asYear=='2016'){
			document.getElementById("itr2").style.display="";
			document.getElementById("itr2A").style.display="";
			document.getElementById("itr3").style.display="";
			document.getElementById("itr4").style.display="";
			document.getElementById("itr5").style.display="";
			document.getElementById("itr6").style.display="";
			document.getElementById("itr7").style.display="";
			document.getElementById("itr4sJavaId").style.display="";
			document.getElementById("itr1JavaId").style.display="";
			document.getElementById("itr2JavaId").style.display="";
			document.getElementById("itr2AJavaId").style.display="";
			document.getElementById("itr3JavaId").style.display="";
			document.getElementById("itr4JavaId").style.display="";
			document.getElementById("itr5JavaId").style.display="";
			document.getElementById("itr6JavaId").style.display="";
			document.getElementById("itr7JavaId").style.display="";
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr2AxslId").style.display="";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7xslId").style.display="";
			document.getElementById("javaHeader").innerHTML="<img alt=\"Java Utility\" src=\"/itax/images/java.gif\"/> Java Utility";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'');
			document.getElementById("DTAAtable").style.display="none";
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
			/*-- end --*/
		}

		else if(asYear=='2015'){
			document.getElementById("itr2").style.display="";
			document.getElementById("itr2A").style.display="";
			document.getElementById("itr3").style.display="";
			document.getElementById("itr4").style.display="";
			document.getElementById("itr5").style.display="";
			document.getElementById("itr6").style.display="";
			document.getElementById("itr7").style.display="";
			document.getElementById("itr4sJavaId").style.display="";
			document.getElementById("itr1JavaId").style.display="";
			document.getElementById("itr2JavaId").style.display="";
			document.getElementById("itr2AJavaId").style.display="";
			document.getElementById("itr3JavaId").style.display="";
			document.getElementById("itr4JavaId").style.display="";
			document.getElementById("itr5JavaId").style.display="";
			document.getElementById("itr6JavaId").style.display="";
			document.getElementById("itr7JavaId").style.display="";
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr2AxslId").style.display="";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7xslId").style.display="";
			document.getElementById("javaHeader").innerHTML="<img alt=\"Java Utility\" src=\"/itax/images/java.gif\"/> Java Utility";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'');
			document.getElementById("DTAAtable").style.display="";
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
			
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
			/*-- end --*/
		
		}
		else if(asYear=='2014'){
			document.getElementById("itr2").style.display="";
			document.getElementById("itr2A").style.display="none";
			document.getElementById("itr3").style.display="";
			document.getElementById("itr4").style.display="";
			document.getElementById("itr5").style.display="";
			document.getElementById("itr6").style.display="";
			document.getElementById("itr7").style.display="";
			document.getElementById("itr4sJavaId").style.display="";
			document.getElementById("itr1JavaId").style.display="";
			document.getElementById("itr2JavaId").style.display="";
			document.getElementById("itr2AJavaId").style.display="none";
			document.getElementById("itr3JavaId").style.display="";
			document.getElementById("itr4JavaId").style.display="";
			document.getElementById("itr5JavaId").style.display="";
			document.getElementById("itr6JavaId").style.display="";
			document.getElementById("itr7JavaId").style.display="";
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr2AxslId").style.display="none";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7xslId").style.display="";
			document.getElementById("javaHeader").innerHTML="<img alt=\"Java Utility\" src=\"/itax/images/java.gif\"/> Java Utility";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'');
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
			
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
			/*-- end --*/
		
		}else if(asYear=='2013'){
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr2AxslId").style.display="none";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7xslId").style.display="none";
			document.getElementById("itr4sJavaId").style.display="";
			document.getElementById("itr1JavaId").style.display="";
			document.getElementById("itr2JavaId").style.display="";
			document.getElementById("itr2AJavaId").style.display="none";
			document.getElementById("itr3JavaId").style.display="";
			document.getElementById("itr4JavaId").style.display="";
			document.getElementById("itr5JavaId").style.display="";
			document.getElementById("itr6JavaId").style.display="";
			document.getElementById("itr7JavaId").style.display="";
			document.getElementById("javaHeader").innerHTML="<img alt=\"Java Utility\" src=\"/itax/images/java.gif\"/> Java Utility";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'');
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
			
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
			/*-- end --*/
			

		}else if(asYear=='2012' || asYear=='2011' ){
			document.getElementById("itr4sJavaId").style.display="";
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr4Sversion2").style.display="none";
			document.getElementById("itr4Sins").style.display="none";
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
			
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
			document.getElementById("itr7xslId").style.display="none";
			document.getElementById("itr7JavaId").style.display="none";
			document.getElementById("itr7").style.display="none";
		}
		
		else{
			document.getElementById("itr4sxslId").style.display="";
			document.getElementById("itr1xslId").style.display="";
			document.getElementById("itr2xslId").style.display="";
			document.getElementById("itr2AxslId").style.display="none";
			document.getElementById("itr3xslId").style.display="";
			document.getElementById("itr4xslId").style.display="";
			document.getElementById("itr5xslId").style.display="";
			document.getElementById("itr6xslId").style.display="";
			document.getElementById("itr7").style.display="none";
			document.getElementById("itr4sJavaId").style.display="none";
			document.getElementById("itr1JavaId").style.display="none";
			document.getElementById("itr2JavaId").style.display="none";
			document.getElementById("itr2AJavaId").style.display="none";
			document.getElementById("itr3JavaId").style.display="none";
			document.getElementById("itr4JavaId").style.display="none";
			document.getElementById("itr5JavaId").style.display="none";
			document.getElementById("itr6JavaId").style.display="none";
			document.getElementById("javaHeader").innerHTML="";
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,2,'');
			showHideCol(document.getElementById('xslHeader').parentNode.parentNode.parentNode,3,'none');
			document.getElementById("itr1IsId").style.display="none";
			document.getElementById("itr2IsId").style.display="none";
			document.getElementById("itr3IsId").style.display="none";
			document.getElementById("itr4IsId").style.display="none";
			document.getElementById("itr5IsId").style.display="none";
			document.getElementById("itr6IsId").style.display="none";
			document.getElementById("itr7IsId").style.display="none";
			/*For Checking*/
			document.getElementById("headHideExcel").style.display="none";
			document.getElementById("headHideJava").style.display="none";
			document.getElementById("headHideIns").style.display="none";
		
			document.getElementById("version1excel").style.display="none";
			document.getElementById("version1java").style.display="none";
			document.getElementById("version2excel").style.display="none";
			document.getElementById("version2java").style.display="none";
			document.getElementById("version3excel").style.display="none";
			document.getElementById("version3java").style.display="none";
			document.getElementById("version4excel").style.display="none";
			document.getElementById("version4java").style.display="none";
			document.getElementById("version5excel").style.display="none";
			document.getElementById("version5java").style.display="none";
			document.getElementById("version6excel").style.display="none";
			document.getElementById("version6java").style.display="none";
			document.getElementById("version7excel").style.display="none";
			document.getElementById("version7java").style.display="none";
		
			$('.coljava').hide();
			/*-- end --*/
		}
		showHideItr4s(asYear);
		}catch(err){
		}

	}


	function showHideItr4s(asYear){

		
		if(asYear >='2017'){
			document.getElementById("itr4sDisplay").style.display = "none";
		}else if(asYear >='2011' && asYear < '2017'){
			document.getElementById("itr4sDisplay").style.display = "";
		}else{
			document.getElementById("itr4sDisplay").style.display = "none";
		}
		
	}

	function changeImg() {


			 var imgElement =  document.getElementById("captchaImg") ;
			 imgElement.src = "/e-Filing/CreateCaptcha.do?"+Math.random();
			 document.getElementById("captchaImg").focus;

	}

	function setHeight(){

	        var windowHeight=document.body.clientHeight;
	        var fh = document.getElementById('footer').scrollHeight;
	        var hh = document.getElementById('header').scrollHeight;
	        var bh = document.getElementById('bodyContent').scrollHeight;
			var bodyContentHeight=windowHeight-fh-hh;

	        if(bodyContentHeight >  bh){

	        document.getElementsByTagName('body')[0].style.height = fh + hh + bodyContentHeight + 5;

	        }else{

	        document.getElementsByTagName('body')[0].style.height = fh + hh + bh + 5;
	        }
	}


	function changeToUpperCase(v)
	{
	document.getElementsByName(v)[0].value=document.getElementsByName(v)[0].value.toUpperCase();
	}

	function rightClickDisable(e){
	var status="For security reasons,Right Click is disabled";

		if(e!='undefined'){
		//alert(status);
	    return false;
		}
	}
	function searchInHomePage(){
	var val=document.getElementById('inputID').value;
	if(val.trim().length==0){
	return;
	}
	getStaticPageFromHomePage('AboutUs.html');
	document.getElementById('inputID').value=val;
			getSearchResult(val);

	}

	function searchMe(value){
		if(value=='2'){
		 searchTransactionId();
		} else if (value=='1'){
			var val=document.getElementById('inputID').value;
			getSearchResult(val);
		}
	}

	function createNewFormElement(inputForm, elementName, elementValue){

		var input = document.createElement("input");

		input.setAttribute("type", "hidden");
		input.setAttribute("name", elementName);
		input.setAttribute("value", elementValue);
		inputForm.appendChild(input);
	}

	function searchTransactionId(){
	var val=document.getElementById('inputID').value;
	if(val.trim().length==0){
	return;
	}
	if(val.match('^[0-9]*$')==null){
		getSearchResult(val);
	}
	else{
			var submitForm = getNewSubmitForm();

			var uploadType = document.getElementById("uploadType");

			$("#submitForm").load(submitForm,function(responseTxt, statusTxt, xhr){
			createNewFormElement(submitForm,"searchOpt", "2");
			createNewFormElement(submitForm,"varTransId", document.getElementById('inputID').value);
			});
			submitForm.action= "/e-Filing/Miscellaneous/SearchTransaction.html?varTransId="+val;
			submitForm.submit();
		}
	}
	var searchDiv;
	var searchVal;
	function getSearchResult(searchText){
	searchText=searchText.replace('+',' ');
	if(searchText.trim().length==0){
	return;
	}
	var xmlhttp;

		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari

		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5

		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		var url='/solr/e-Filing/select?q=QUERY&rows=10&fl=url&df=content&wt=xml&indent=true&hl=true&hl.simple.pre=%3Cb%3E&hl.simple.post=%3C%2Fb%3E';
		var search=searchText.split(' ');
		var searchValue='';
		for(var i=0;i<search.length;i++){
			if(search[i].trim().length!=0)
			searchValue=searchValue+'+'+search[i].trim();
		}
		searchValue=searchValue.replace('+','');
		searchVal=searchValue;
		url=url.replace('QUERY',searchValue);

		xmlhttp.open("GET",url,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			var v=xmlhttp.responseXML;
			v=v.getElementsByTagName('lst');
			var ul= document.createElement("ul");
	        for(var i=0;i<v.length;i++){
	            var temp=v[i];
	            var test=temp.getElementsByTagName('str');
	            if(test.length==1){
				ul.appendChild(createLISearch(temp.getAttribute('name'),test[0].childNodes[0].nodeValue));
				}
	           }
			   var div=document.createElement('div');
			   var h1=document.createElement('h1');
			   var text=document.createTextNode('Search Results');
			   h1.appendChild(text);

			   div.appendChild(h1);
			   if(ul.innerHTML.length ==0){
			   ul.innerHTML='No results found.';
			   }
			   div.appendChild(ul);
			   setSearchDiv(div);
			   searchDiv=div.cloneNode(true);
			}
	  }

	}


	function setSearchDiv(div){
		 div=div.cloneNode(true);
		 document.getElementById('staticContentsUrl').innerHTML='';
		 document.getElementById('staticContentsUrl').appendChild(div);
	}

	function createLISearch(urlT ,textT){


				textT=textT+' <b>...</b>';
				var text=document.createTextNode(textT);

				var li= document.createElement("li");
				var div= document.createElement("div");
				var h2= document.createElement("h2");
				var a= document.createElement("a");
				var div2= document.createElement("div");
				var span= document.createElement("span");

				

				div2.setAttribute('class',"searchContent");
				li.setAttribute('class',"liSearch");
				a.setAttribute('href',urlT);
				a.setAttribute('onclick',"return openSrchRsltLink(this)");



				var url=document.createTextNode(urlT);
				li.appendChild(div);
				div.appendChild(h2);
				div.appendChild(div2);
				div2.appendChild(span);
				a.appendChild(text);
				h2.appendChild(a);
				span.appendChild(url);

				a.innerHTML=a.innerHTML.replace(/&lt;/g,"<").replace(/&gt;/g,">");

				return li;
	}

	function openSrchRsltLink(field){
		var flag=false;
		var value=field+'';
		try{
			if(value.indexOf("/Portal")!=-1 && value.indexOf(".html")!=-1){
				getStaticPage(value.substr(eval(value.indexOf('/Portal/')+8),value.length));
			}
			else{
				flag=true;
			}
		}
		catch(e){

		flag=false;
		}
		$("#staticContentsUrl").load(value,function(responseTxt, statusTxt, xhr){
		createSearchBack();
		highLightSearch(document.getElementById("staticContentsUrl"));
		});
		return flag;
	}

	function highLightSearch(doc){

	if(doc.children.length>0){
	    for(var i=0;i<doc.children.length;i++){
	    highLightSearch(doc.children[i]);
		}
	}
	else{
	var arr=searchVal.split('+');
	var text=doc.innerHTML;
		for(var i=0;i<arr.length;i++){
		var temp=new RegExp("\\b"+arr[i]+"\\b",'gi');
		var tempArr=text.match(temp);
		if(tempArr!=null && tempArr.length>0)
			text=text.replace(temp,'<b class="bigb">'+tempArr[0]+'</b>');
		}
		doc.innerHTML=text;
	}

	}



	function createSearchBack(){
				$( ":button" ).addClass( "disp-none" );
				var div=document.createElement('div');
				var button=document.createElement('input');
				div.setAttribute('style','text-align:center;padding-top: 20px;');
				button.setAttribute('type','button');
				button.setAttribute('value','Back To Search Results');
				button.setAttribute('onclick','setSearchDiv(searchDiv);');
				div.appendChild(button);
				document.getElementById('staticContentsUrl').appendChild(div);
	}
	function resetSearch(){

		var searchValue=document.getElementById("inputID").value;

		if(searchValue=='Transaction ID Search'){

		document.getElementById("inputID").value='';
		}

	}

	function downloadNewFile(element){

	var hiperLinkRef=element.href;

		if(hiperLinkRef.indexOf('?')!=-1){

			hiperLinkRef=hiperLinkRef.substring(0,hiperLinkRef.indexOf('?'));

		}
	element.href=hiperLinkRef+'?'+Math.random();
	}

	function getStaticPageHindi(staticContentsUrl){

		loadStaticPageMme("staticContentsUrl","/eFiling/PortalHindi/"+staticContentsUrl+"?"+Math.random());


	}

	function getStaticHindiPage(staticContentsUrl){
		getStaticPageHindi(staticContentsUrl);
	}

	function changeHtml(xmlhttp,staticContentsUrl){
		document.getElementById("staticContentsUrl").innerHTML= xmlhttp.responseText;
	if (staticContentsUrl == 'DownloadsHome.html' || staticContentsUrl == 'DownloadsHomePreYear.html' ) {
	disableForms();
	}
	if (staticContentsUrl == '/help/View_List_Of_ERI.html' || staticContentsUrl == '/help/View_List_Of_Useful_Codes.html' ) {
	ddaccordion.init
	({
	headerclass: "submenuheader", contentclass: "accordmenu", revealtype: "click", mouseoverdelay: 200,
	collapseprev: true,//Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	animatespeed: "medium", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	onopenclose:function(header, index, state, isuseractivated) {
	//custom code to run whenever a header is opened or closed
	if (state=="block" && isuseractivated==true){ //if header is expanded and as the result of the user initiated action
	location.replace(header.getAttribute('href'));}
	}});
	}
	}
	function getStaticHindiPageFromHomePage(staticContentsUrl) {
		document.getElementById("staticContentsUrl").innerHTML = '';
		loadStaticPageMme("staticContentsUrl","/eFiling/Portal/"+staticContentsUrl+"?"+Math.random());

		document.getElementById("staticContentsUrl").className = 'rightColumn';

		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());

	}

		function getStaticHindiPageFromHomePageOnlyHindi(staticContentsUrl) {
		document.getElementById("staticContentsUrl").innerHTML = '';
		loadStaticPageMme("staticContentsUrl","/eFiling/PortalHindi/"+staticContentsUrl+"?"+Math.random());

		document.getElementById("staticContentsUrl").className = 'rightColumn';

		loadStaticPageMme("ltcol","/eFiling/PortalHindi/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/PortalHindi/Header.html?"+Math.random());

	}


	function changeHTMLHindi(xmlhttp,staticContentsUrl){

		loadStaticPageMme("staticContentsUrl","/eFiling/Portal/"+staticContentsUrl+"?"+Math.random());

		document.getElementById("staticContentsUrl").className = 'rightColumn';

		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());

	}

	function changeHTMLEng(xmlhttp,staticContentsUrl){

		loadStaticPageMme("staticContentsUrl","/eFiling/Portal/"+staticContentsUrl+"?"+Math.random());

		document.getElementById("staticContentsUrl").className = 'rightColumn';

		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());

	}

	function showHideCol(table, colIndex, display){
		var rows = table.rows;
		for(var i=0;i<rows.length;i++){
			try{
				rows[i].cells[colIndex].style.display=display;
			}catch(e){}
		}
	}

	function showTableForSchemaHindi(id)
	{
		var style_type=document.getElementById(id).style.display;

		if(style_type=='none')
		{
		document.getElementById('ITRSchema').style.display = "none";
		document.getElementById('FormSchema').style.display = "none";
		document.getElementById('rules').style.display = "none";
		document.getElementById('formBBSchema').style.display = "none";
		document.getElementById(id).style.display = "";
		}
		else
		{
		document.getElementById(id).style.display = "none";
		}

		if(id=='FormSchema')
		{
			if(($('#FormSchema tr:last td:nth-child(2)').html())=='15/07/2015')
			{
				$('#FormSchema tr:last').remove();
			}

		}
	}
	function showTableForSchema(id)
	{
		var style_type=document.getElementById(id).style.display;

		if(style_type=='none' && id=='ITRSchema')
		{
		//document.getElementById('ITRSchema').style.display = "none";
		document.getElementById('FormSchemas').style.display = "none";
		//document.getElementById('FormSchema').style.display = "none";
		//document.getElementById('rules').style.display = "none";
		//document.getElementById('formBBSchema').style.display = "none";
		document.getElementById(id).style.display = "";
		}
		else if(style_type=='none' && id== 'FormSchemas')
		{
		document.getElementById(id).style.display = "";
		document.getElementById('ITRSchema').style.display = "none";
		}
		else
		{
		document.getElementById(id).style.display = "none";
		}

		if(id=='FormSchemas')
		{
			if(($('#FormSchema tr:last td:nth-child(2)').html())=='15/07/2015')
			{
				$('#FormSchema tr:last').remove();
			}

		}
	}
//New functions for downloads page
	function showTableForITRYr(id)
	{
			var style_type=document.getElementById(id).style.display;

			if(style_type=='none')
			{
			
			document.getElementById('dscManagement').style.display = "none";
			document.getElementById(id).style.display = "";
			document.getElementById('otherForms').style.display = "none";
			}
			else
			{
			document.getElementById(id).style.display = "none";
			}

		
	}
		
		function showTableForOtherForms(id)
		{
			var style_type=document.getElementById(id).style.display;

			if(style_type=='none')
			{
			document.getElementById('ITRs').style.display = "none";
			document.getElementById('dscManagement').style.display = "none";
			document.getElementById(id).style.display = "";
			}
			else
			{
			document.getElementById(id).style.display = "none";
			}

		
		}
		
		function showTableForDscUtility(id)
		{
			var style_type=document.getElementById(id).style.display;

			if(style_type=='none')
			{
			document.getElementById('ITRs').style.display = "none";
			document.getElementById('otherForms').style.display = "none";
			/*document.getElementById('rules').style.display = "none";
			document.getElementById('formBBSchema').style.display = "none";*/
			document.getElementById(id).style.display = "";
			}
			else
			{
			document.getElementById(id).style.display = "none";
			}

		
		}

//end



	function showHideDiv(id){
		var style_type=document.getElementById(id).style.display;

		if(style_type=='block')
		{
		document.getElementById(id).style.display = "none";
		}
		else
		{

		document.getElementById(id).style.display = "block";
		}
	}


	function showTextFields(){

		if(document.getElementsByName('panFlag')[0].value == 'Y'){
			document.getElementById('pan').disabled=false;
			document.getElementById('orgName').disabled=false;
			document.getElementById('reason').disabled=true;
			document.getElementById('pan').value='';
			document.getElementById('orgName').value='';
			document.getElementsByName('reason')[0].value='-1';

		}else if(document.getElementsByName('panFlag')[0].value == 'N'){

			document.getElementById('pan').disabled=true;
			document.getElementById('orgName').disabled=true;
			document.getElementById('reason').disabled=false;
			document.getElementById('pan').value='';
			document.getElementById('orgName').value='';
		}else{
			document.getElementById('pan').disabled=true;
			document.getElementById('orgName').disabled=true;
			document.getElementById('reason').disabled=true;
			document.getElementById('pan').value='';
			document.getElementById('orgName').value='';
			document.getElementsByName('reason')[0].value='-1';
		}
	}

	function onloadDisableOptions(){

		if(document.getElementsByName('panFlag')[0].value == 'Y'){
			document.getElementById('pan').disabled=false;
			document.getElementById('orgName').disabled=false;
			document.getElementById('reason').disabled=true;

		}else if(document.getElementsByName('panFlag')[0].value == 'N'){

			document.getElementById('pan').disabled=true;
			document.getElementById('orgName').disabled=true;
			document.getElementById('reason').disabled=false;
		}else{
			document.getElementById('pan').disabled=true;
			document.getElementById('orgName').disabled=true;
			document.getElementById('reason').disabled=true;
		}


	}

	function showHideDivArchive(id){

		var displayValueForm=document.getElementById(id).style.display;


		if(displayValueForm=='none')
		{
		document.getElementById('ITRSchema').style.display = "none";
		document.getElementById('ITRSchema1516').style.display = "none";
		document.getElementById('ITRSchema1617').style.display = "none";
		document.getElementById(id).style.display = "";
		}
		else
		{
		document.getElementById(id).style.display = "none";
		}

	}



	function setStaticContents(staticContentsUrl,id) {

		staticContentsUrl= "/eFiling/Portal/"+staticContentsUrl;
		$("#staticContentsUrl").load(staticContentsUrl,function(responseTxt, statusTxt, xhr){
	        	document.getElementById('rules').style.display = "";
		});
	}
	
	
	function showHideRules(id){
		if(id=='ITRSchema2016'){
			var style_type=document.getElementById(id).style.display;
			if(style_type=='none'){
			document.getElementById('ITRSchema2016').style.display = "";
			document.getElementById('ITRSchema2017').style.display = "none";
			}
			else{
				document.getElementById('ITRSchema2016').style.display = "none";
			}
		}
		else{
			var style_type=document.getElementById(id).style.display;
			if(style_type=='none'){
				document.getElementById('ITRSchema2017').style.display = "";
				document.getElementById('ITRSchema2016').style.display = "none";
			}
			else{
				document.getElementById('ITRSchema2017').style.display = "none";
			}
		}
		
		
	} 

	function ticker()
	{

		$(function () {
		    $('.marquee').marquee({
				duration: 8000,
				pauseOnHover: true

			});

		});

	}

	function openDisclaimer(path){
	
		$("#disclaimer").dialog({
			modal: true,
			width: 450,
			height: 300,
			resizable: false,
			title: 'Disclaimer',
			dialogClass: 'dialog-style',
		    buttons: {
		          "Confirm": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		          Cancel: function() {
		            $( this ).dialog( "close" );
		          }
		        }
		});
		
	}
/*User Manual Disclaimers*/
	
	function openDisclaimerUserManual(path){

		$("#disclaimerUserManual").dialog({
			modal: true,
			width: 950,
			height: 450,
			resizable: false,
			/*title: 'Logon',*/
			dialogClass: 'dialog-style',
		    buttons: {
		          "Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	
	function openDisclaimerUserManualDSC(path){

		$("#disclaimerUserManualDSC").dialog({
			modal: true,
			width: 950,
			height: 420,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualListForm(path){

		$("#disclaimerUserManualListForms").dialog({
			modal: true,
			width: 950,
			height: 420,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualEVC(path){

		$("#disclaimerUserManualEVC").dialog({
			modal: true,
			width: 950,
			height: 270,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualLinkAadhar(path){

		$("#disclaimerUserManualLinkAadhar").dialog({
			modal: true,
			width: 950,
			height: 383,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualUploadedForm(path){

		$("#disclaimerUserManualUploadedForm").dialog({
			modal: true,
			width: 950,
			height: 220,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualWhichITR(path){

		$("#disclaimerUserManualWhichITR").dialog({
			modal: true,
			width: 950,
			height: 400,
			resizable: false,
			title: 'AY 2017-18',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerVariousSections(path){

		$("#disclaimerUserVariouSections").dialog({
			modal: true,
			width: 950,
			height: 400,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualwhichFormOtherThan(path){

		$("#disclaimerUserManualwhichFormOtherThan").dialog({
			modal: true,
			width: 950,
			height: 580,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		         
		        }
		});
	}
	function openDisclaimerUserManualCAOtherForms(path){

		$("#DisclaimerUserManualCAOtherForms").dialog({
			modal: true,
			width: 950,
			height: 300,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		         
		        }
		});
	}
	
	function openDisclaimerUserManualEAPanQuery(path){

		$("#DisclaimerUserManualEAPanQuery").dialog({
			modal: true,
			width: 950,
			height: 200,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		         
		        }
		});
	}
	
	function openDisclaimerUserManualXMLSchema(path){

		$("#DisclaimerUserManualXMLSchema").dialog({
			modal: true,
			width: 720,
			height: 520,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		         
		        }
		});
	}
	
	function openDisclaimerUserManualSampleXML(path){

		$("#DisclaimerUserManualSampleXML").dialog({
			modal: true,
			width: 720,
			height: 410,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		         
		        }
		});
	}
	
	function openDisclaimerAnnexureForm26AB(path){

		$("#AnnexureForm26AB").dialog({
			modal: true,
			width: 950,
			height: 440,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualForm15CC(path){

		$("#disclaimerUserManualForm15CC").dialog({
			modal: true,
			width: 950,
			height: 580,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerIndividual(path){
		$("#disclaimerIndividual").dialog({
			modal: true,
			width: 807,
			height: 500,
			resizable: false,
			title: 'For Individual Users',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },*/
				  Register: function(){
				  window.open('https://incometaxindiaefiling.gov.in/e-Filing/Registration/RegistrationHome.html',"_blank");
				  }
		        }
		});
	}
	
	function openDisclaimerview_the_uploaded_Form_15CB(path){
		$("#disclaimerview_the_uploaded_Form_15CB").dialog({
			modal: true,
			width: 807,
			height:192,
			resizable: false,
			//title: 'e-Pay Tax',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },*/
				 /* Cancel: function(){
				   $( this ).dialog( "close" );
				  }*/
		        }
		});
	}
	
	function openDisclaimerHUF(path){
		$("#disclaimerHUF").dialog({
			modal: true,
			width: 807,
			height: 500,
			resizable: false,
			title: 'For HUF Users',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },*/
				  Register: function(){
				   window.open('https://incometaxindiaefiling.gov.in/e-Filing/Registration/RegistrationHome.html',"_blank");
				  }
		        }
		});
	}
	
	function openDisclaimerOthers(path){
		$("#disclaimerOthers").dialog({
			modal: true,
			width: 807,
			height: 500,
			resizable: false,
			title: 'For Others than Individual and HUF Users ',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },*/
				  Register: function(){
				   window.open('https://incometaxindiaefiling.gov.in/e-Filing/Registration/RegistrationHome.html',"_blank");
				  }
		        }
		});
	}
	
	function openDisclaimerViewTDS(path){
		$("#disclaimerViewTDS").dialog({
			modal: true,
			width: 807,
			height: 300,
			resizable: false,
			//title: 'For Others than Individual and HUF Users ',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },
				  Register: function(){
				   $( this ).dialog( "close" );
				  }*/
		        }
		});
	}
	
	function openDisclaimerView15CABulk(path){
		$("#disclaimerView15CABulk").dialog({
			modal: true,
			width: 807,
			height: 250,
			resizable: false,
			//title: 'For Others than Individual and HUF Users ',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },
				  Register: function(){
				   $( this ).dialog( "close" );
				  }*/
		        }
		});
	}
	
	function openDisclaimerView15G_and_15H(path){
		$("#disclaimerView15G_and_15H").dialog({
			modal: true,
			width: 807,
			height: 250,
			resizable: false,
			//title: 'For Others than Individual and HUF Users ',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },
				  Register: function(){
				   $( this ).dialog( "close" );
				  }*/
		        }
		});
	}
	
	function openDisclaimerView26A_and_27BA(path){
		$("#disclaimerView26A_and_27BA").dialog({
			modal: true,
			width: 807,
			height: 350,
			resizable: false,
			//title: 'For Others than Individual and HUF Users ',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },
				  Register: function(){
				   $( this ).dialog( "close" );
				  }*/
		        }
		});
	}
	
	
	
	
	
/*end*/	
	function openDisclaimer2(path){	

	$("#disclaimerCheckRefund").dialog({
			modal: true,
			width: 600,
			height: 220,
			resizable: false,
			title: 'Check Refund Dispatch Status',
			dialogClass: 'dialog-style',
		    buttons: {
		          "Continue to NSDL website": function() {
				  openDisclaimer3('https://tin.tin.nsdl.com/oltas/refundstatuslogin.html')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('/e-Filing/UserLogin/LoginHome.html?nextPage=myReturn',"_self");
		          },
				  Cancel: function(){
				   $( this ).dialog( "close" );
				  }
		        }
		});
	}
	function openDisclaimer3(path){
	
		$("#disclaimer").dialog({
			modal: true,
			width: 450,
			height: 300,
			resizable: false,
			title: 'Disclaimer',
			dialogClass: 'dialog-style',
		    buttons: {
		          "Confirm": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
				
		          Cancel: function() {
		            $( this ).dialog( "close" );
		          }
		        }
		});
		
	}
	function openDisclaimer4(path){	

	$("#disclaimerePayTax").dialog({
			modal: true,
			width: 600,
			height: 365,
			resizable: false,
			title: 'e-Pay Tax',
			dialogClass: 'dialog-style',
		    buttons: {
		        /*  "Continue to NSDL website": function() {
				  openDisclaimer3('https://onlineservices.tin.egov-nsdl.com/etaxnew/tdsnontds.jsp')
		        	  $( this ).dialog( "close" );
		        },
		          "Login to e-Filing account": function() {
		            window.open('https://incometaxindiaefiling.gov.in/e-Filing/UserLogin/LoginHome.html',"_self");
		          },*/
				  Cancel: function(){
				   $( this ).dialog( "close" );
				  }
		        }
		});
		
	}
	/*How to Discalimers*/
	
	function openDisclaimerUserManualIncomeFromSalary(path){

		$("#disclaimerUserManualIncomeFromSalary").dialog({
			modal: true,
			width: 950,
			height: 650,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualIncomeFromHouse(path){

		$("#disclaimerUserManualIncomeFromHouse").dialog({
			modal: true,
			width: 950,
			height: 650,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualIncomeFromBusiness(path){

		$("#disclaimerUserManualIncomeFromBusiness").dialog({
			modal: true,
			width: 950,
			height: 650,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	function openDisclaimerUserManualIncomeFromOtherSources(path){

		$("#disclaimerUserManualIncomeFromOtherSources").dialog({
			modal: true,
			width: 950,
			height: 650,
			resizable: false,
			//title: '',
			dialogClass: 'dialog-style',
		  buttons: {
		          /*"Login": function() {
		        	  window.open(path);
		        	  $( this ).dialog( "close" );
		        },
		         /* Cancel: function() {
		            $( this ).dialog( "close" );
		          }*/
		        }
		});
	}
	
	/*end*/

	function openInstructions(id){

		$(id).dialog({
			modal: true,
			width: 700,
			height: "auto",
			resizable: false,
			title: 'Instructions',
			dialogClass: 'dialog-style',
		    buttons: {
		          "OK": function() {
		            $( this ).dialog( "close" );
		          }
		        }
		});
	}

	function showdropdown(){
		$(function () {
			/* Navigation submenus Sliding */
			$('.menu').find('li').mouseover(function(){

				$(this).find('.submenu').stop(true,true).slideDown(1000);

			});

			$('.menu').find('li').mouseout(function(){
				$('.submenu').slideUp(1000);
			});

			$('.submenu').mouseover(function(){
				$(this).css("display","block");
			});

		});

	}

	//Java Script For Setting Color Contrast Theme in Session
	function setColorBlindFlg(flag,ID) {
		$.ajax({
					type: "POST",
					url :  "/e-Filing/MyAccount/ColorBlindNessAjax.html?colorBlindFlg="+flag+"&ID="+ID,
			});
	}

	//Java Script For Color Contrast Theme
	function changeCSS(cssFile, cssLinkIndex) {

		var path;
		var oldlink = document.getElementsByTagName("link").item(cssLinkIndex);

		var newlink = document.createElement("link");
		newlink.setAttribute("rel", "stylesheet");
		newlink.setAttribute("type", "text/css");
		newlink.setAttribute("href", "/itax/styles/" + cssFile);

		document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
	}

	function changeImageToContrast() {
		var imgArray = document.getElementsByTagName('img');

		for ( var i = 0; i < imgArray.length; i++) {
			var imgArray = document.getElementsByTagName('img');
			var img = imgArray[i];
			var src = img.src;
			src = src.substring(src.indexOf('itax') - 1);
			var newSrc = src.replace('/itax/images/', '/itax/images_contrast/');
			img.src = newSrc;
		}

	}

	function changeImage() {

		var imgArray = document.getElementsByTagName('img');
		for ( var i = 0; i < imgArray.length; i++) {
			var imgArray = document.getElementsByTagName('img');
			var img = imgArray[i];
			var src = img.src;
			src = src.substring(src.indexOf('itax') - 1);
			var newSrc = src.replace('/itax/images_contrast/', '/itax/images/');
			img.src = newSrc;
		}
	}





//RESTRICTIONS

	function onlyNumbersChars(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}
		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;
	}

	function onlyPercent(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}

	function onlyAsstYear(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 45 || e.which == 45) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}

	function onlyNumbers(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}

	function onlyNegativeNumbers(e) {

		fileModified();

		if (e.target.value != '' && e.target.value.length > 1
				&& e.target.value.charAt(0) != '-' && e.target.originalLength) {
			e.target.maxLength = e.target.originalLength;
		}

		var keynum;

		if (e.target.value.charAt(0) != '-') {
			e.target.maxLength = parseInt(14, 10);

		} else {
			e.target.maxLength = parseInt(15, 10);

		}

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (e.keyCode == 45 || e.which == 45) {
			if (e.target.originalLength) {
				e.target.maxLength = parseInt(e.target.originalLength, 10)
						+ parseInt(1, 10);
			} else {
				e.target.originalLength = e.target.maxLength;
				e.target.maxLength = parseInt(e.target.originalLength, 10)
						+ parseInt(1, 10);
			}
			return true;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}

	function onlyNegativePercent(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (e.keyCode == 45 || e.which == 45) {
			return true;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}

	function onlyDate(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (e.keyCode == 47 || e.which == 47) {
			return true;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;
	}

	function onlyName(e) {

		onlyMidName(e);

	}

	function onlyMidName(e) {

		var keynum;

		if (e.which == 0 ) {
			return true;
		}
		
		if (e.keyCode == 8 ||e.which == 8 ) {
			return true;
		}
		if (e.keyCode == 222 ||e.which == 222 ) {
			return true;
		}
		if (e.keyCode == 9 ||e.which == 9 ) {
			return true;
		}
		
		if (e.keyCode == 13 ||e.which == 13 ) {
			return true;
		}
		
		if (e.keyCode == 32 ||e.which == 32) {
			return true;
		}
		
		if (e.keyCode == 33 ||e.which == 33 ) {
			return true;
		}
		
		if (e.keyCode == 34 ||e.which == 34 ) {
			return true;
		}
		
		if (e.keyCode == 35 ||e.which == 35 ) {
			return true;
		}
		
		if (e.keyCode == 36 ||e.which == 36 ) {
			return true;
		}
		
		if (e.keyCode == 37 ||e.which == 37 ) {
			return true;
		}
		
		if (e.keyCode == 38 ||e.which == 38 ) {
			return true;
		}

		if (e.keyCode == 39 ||e.which == 39 ) {
			return true;
		}
		
		if (e.keyCode == 40 ||e.which == 40) {
			return true;
		}
		
		if (e.keyCode == 41 ||e.which == 41) {
			return true;
		}
			
		if (e.keyCode == 42 ||e.which == 42 ) {
			return true;
		}
		
		if (e.keyCode == 43 ||e.which == 43 ) {
			return true;
		}
		if (e.keyCode == 44 ||e.which == 44 ) {
			return true;
		}
		
		if (e.keyCode == 45 ||e.which == 45) {
			return true;
		}
		if (e.keyCode == 46 ||e.which == 46 ) {
			return true;
		}
		if (e.keyCode == 47 ||e.which == 47 ) {
			return true;
		}
		
		if (e.keyCode == 58 ||e.which == 58) {
			return true;
		}
		
		if (e.keyCode == 59 ||e.which == 59 ) {
			return true;
		}
		if (e.keyCode == 60 ||e.which == 60) {
			return true;
		}
		
		if (e.keyCode == 61 ||e.which == 61) {
			return true;
		}
		
		if (e.keyCode == 62 ||e.which == 62) {
			return true;
		}
		
		if (e.keyCode == 63 ||e.which == 63) {
			return true;
		}
				
		if (e.keyCode == 64 ||e.which == 64) {
			return true;
		}
		
		if (e.keyCode == 91 ||e.which == 91) {
			return true;
		}
		
		if (e.keyCode == 92 ||e.which == 92) {
			return true;
		}
		
		if (e.keyCode == 93 ||e.which == 93) {
			return true;
		}
		
		if (e.keyCode == 94 ||e.which == 94) {
			return true;
		}
		
		if (e.keyCode == 95 ||e.which == 95) {
			return true;
		}
		
		if (e.keyCode == 183 ||e.which == 183 ) {
			return true;
		}
		
		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;

	}

	function onlyAddress(e) {

		var keynum;

		if (e.which == 0 ) {
			return true;
		}
		
		if (e.keyCode == 8 ||e.which == 8 ) {
			return true;
		}
		
		if (e.keyCode == 9 ||e.which == 9 ) {
			return true;
		}
		
		if (e.keyCode == 13 ||e.which == 13 ) {
			return true;
		}
		
		if (e.keyCode == 32 ||e.which == 32) {
			return true;
		}
		
		if (e.keyCode == 33 ||e.which == 33 ) {
			return true;
		}
		
		if (e.keyCode == 34 ||e.which == 34 ) {
			return true;
		}
		
		if (e.keyCode == 35 ||e.which == 35 ) {
			return true;
		}
		
		if (e.keyCode == 36 ||e.which == 36 ) {
			return true;
		}
		
		if (e.keyCode == 37 ||e.which == 37 ) {
			return true;
		}
		
		if (e.keyCode == 38 ||e.which == 38 ) {
			return true;
		}

		if (e.keyCode == 39 ||e.which == 39 ) {
			return true;
		}
		
		if (e.keyCode == 40 ||e.which == 40) {
			return true;
		}
		
		if (e.keyCode == 41 ||e.which == 41) {
			return true;
		}
			
		if (e.keyCode == 42 ||e.which == 42 ) {
			return true;
		}
		
		if (e.keyCode == 43 ||e.which == 43 ) {
			return true;
		}
		if (e.keyCode == 44 ||e.which == 44 ) {
			return true;
		}
		
		if (e.keyCode == 45 ||e.which == 45) {
			return true;
		}
		if (e.keyCode == 46 ||e.which == 46 ) {
			return true;
		}
		if (e.keyCode == 47 ||e.which == 47 ) {
			return true;
		}
		
		if (e.keyCode == 58 ||e.which == 58) {
			return true;
		}
		
		if (e.keyCode == 59 ||e.which == 59 ) {
			return true;
		}
		if (e.keyCode == 60 ||e.which == 60) {
			return true;
		}
		
		if (e.keyCode == 61 ||e.which == 61) {
			return true;
		}
		
		if (e.keyCode == 62 ||e.which == 62) {
			return true;
		}
		
		if (e.keyCode == 63 ||e.which == 63) {
			return true;
		}
				
		if (e.keyCode == 64 ||e.which == 64) {
			return true;
		}
		
		if (e.keyCode == 91 ||e.which == 91) {
			return true;
		}
		
		if (e.keyCode == 92 ||e.which == 92) {
			return true;
		}
		
		if (e.keyCode == 93 ||e.which == 93) {
			return true;
		}
		
		if (e.keyCode == 94 ||e.which == 94) {
			return true;
		}
		
		if (e.keyCode == 95 ||e.which == 95) {
			return true;
		}
		
		if (e.keyCode == 183 ||e.which == 183 ) {
			return true;
		}
		
		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;

	}

	function checkNumber(keynum) {

		if (!(keynum >= 48 && keynum <= 57)) {
			return false;
		} else {
			return true;
		}

	}

	function checkAlphabet(keynum) {

		if (!(keynum >= 65 && keynum <= 90) && !(keynum >= 97 && keynum <= 122)) {
			return false;
		} else {
			return true;
		}

	}

	function onlyEmailId(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}
		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}
		if (e.keyCode == 11 || e.which == 11) {
			return true;
		}

		if (e.keyCode == 95 || e.which == 95) {
			return true;
		}

		if (e.keyCode == 64 || e.which == 64) {
			return true;
		}

		if (e.keyCode == 45 || e.which == 45 ) {
			return true;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;
	}

	function onlyVerificationFullName(name) {
		name.value = name.value.toUpperCase();
		var test_result = true;
		if (name.value != '' && name.value !== null) {

			test_result = /^\w(?:\w+|([.\x20\x2E\x27])(?!\1))+\s*$/
					.test(name.value);
		}

		if (name.value != '' && name.value !== null && test_result == true) {

			var check = /^[0-9\040]*$/.test(name.value);
			if (check == true) {
				test_result = false;
			}

		}
	}

	function onlyOrgName(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 38 || e.which == 38) {
			return true;
		}

		if (e.keyCode == 183 || e.which == 183) {
			return true;
		}

		if (e.keyCode == 39 || e.which == 39) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return true;
		}

		if (e.keyCode == 45 || e.which == 45) {
			return true;
		}

		if (e.keyCode == 35 || e.which == 35) {
			return true;
		}
		if (e.keyCode == 95 || e.which == 95) {
			return true;
		}
		if (e.keyCode == 40 || e.which == 40) {
			return true;
		}
		if (e.keyCode == 41 || e.which == 41) {
			return true;
		}
		if (e.keyCode == 123 || e.which == 123) {
			return true;
		}
		if (e.keyCode == 125 || e.which == 125) {
			return true;
		}
		if (e.keyCode == 91 || e.which == 91) {
			return true;
		}
		if (e.keyCode == 93 || e.which == 93) {
			return true;
		}
		if (e.keyCode == 43 || e.which == 43) {
			return true;
		}
		if (e.keyCode == 64 || e.which == 64) {
			return true;
		}
		if (e.keyCode == 44 || e.which == 44) {
			return true;
		}
		if (e.keyCode == 47 || e.which == 47) {
			return true;
		}
		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;

	}

	function onlyDesignation(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 38 || e.which == 38) {
			return true;
		}

		if (e.keyCode == 183 || e.which == 183) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return true;
		}

		if (e.keyCode == 45 || e.which == 45) {
			return true;
		}
		if (e.keyCode == 40 || e.which == 40) {
			return true;
		}
		if (e.keyCode == 41 || e.which == 41) {
			return true;
		}
		if (e.keyCode == 44 || e.which == 44) {
			return true;
		}
		if (e.keyCode == 47 || e.which == 47) {
			return true;
		}
		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;

	}

	function restrictMaxLength(e) {
		var field = document.getElementById("issue").value;
		var keynum;

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;

		}

		if (field.length >= 250) {

			if (e.keyCode == 9 || e.which == 9) {
				return true;
			} else if (e.which == 0) {
				return true;
			}

			else if (e.keyCode == 8 || e.which == 8) {
				return true;
			} else {
				return false;
			}

		}
	}

	function restrictMaxLengthTextField(e, field, len) {

		if (textFieldRequiredKeys(e)) {

			return true;
		}
		if (field.value.length >= len) {

			return false;

		} else {
			return true;
		}

	}

	function textFieldRequiredKeys(e) {

		var keynum;

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;

		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}
		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}

		if (e.keyCode == 40 || e.which == 40) {
			return true;
		}

		if (e.keyCode == 38 || e.which == 38) {
			return true;
		}
		if (e.keyCode == 39 || e.which == 39) {
			return true;
		}
		if (e.keyCode == 37 || e.which == 37) {
			return true;
		}
		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}
		return false;
	}

	function onlyBankAccNo(e) {
		fileModified();
		var keynum;
		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}
		if (e.which == 0) {
			return true;
		}
		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}
		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}
		if (e.keyCode == 47 || e.which == 47) {
			return true;
		}
		if (e.keyCode == 45 || e.which == 45) {
			return true;
		}
		if (e.keyCode == 46 || e.which == 46) {
			return true;
		}
		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}
		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}
		if (checkNumber(keynum) || checkAlphabet(keynum)) {
			return true;
		}
		return false;
	}

	function onlyNumbersCharsSpace(e) {

	var keynum;

	if (e.keyCode == 13 ||e.which == 13 ) {
		return true;
	}

	if (e.keyCode == 9 ||e.which == 9 ) {
		return true;
	}
	if (e.which == 0 ) {
		return true;
	}

	if (e.keyCode == 8 ||e.which == 8 ) {
		return true;
	}

	if (e.keyCode == 32 ||e.which == 32) {
		return true;
	}

	if (window.event) // IE
	{
		keynum = e.keyCode;
	} else if (e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}

	if (checkNumber(keynum) || checkAlphabet(keynum)) {
		return true;
	}

	return false;
}


	function loadContactTabOnBack(pageId, url) {
		var id = $("#sessionId").attr('value');
		var url = url + "?ID=" + id;
		$('#' + pageId).load(url);

	}

	function loadDynamicPage(pageId, url) {

		var id = $("#sessionId").attr('value');
		var url = url + "?ID=" + id;
		$('#' + pageId).load(url);

		showPage(pageId);
	}

	function showPage(page) {

		var currentPage = document.getElementById("currentPage").value;
		var totalPage = document.getElementById("totalPage").value;
		hideAllPage(currentPage, totalPage);
		document.getElementById(page).style.display = "block";
		document.getElementById(page + "btn").setAttribute("className",
				"tab myCorner active");
		document.getElementById(page + "btn").setAttribute("class",
				"tab myCorner active");
		currentPage = page.substring(4);
		document.getElementById("currentPage").value = currentPage;
		document.body.style.height = "";
	}

	function hideAllPage(currentPage, totalPage) {

		var v = 0;
		for (v = currentPage; v <= totalPage; v++) {
			document.getElementById("page" + v).style.display = "none";
			document.getElementById("page" + v + "btn").setAttribute("className",
					"tab myCorner");
			document.getElementById("page" + v + "btn").setAttribute("class",
					"tab myCorner");
		}
	}

	var ajaxSubmitStarted = false;

	function submitAjaxRequest(form) {

		if (ajaxSubmitStarted) {
			return;
		}

		form.onsubmit = function(){return false};

		ajaxSubmitStarted = true;

		var formId = form.id;
		var target = form.target;

		$.ajax({

					type : "POST",
					url : $("#" + formId).attr('action'),
					data : $("#" + formId).serialize(),

					beforeSend : function() {
						$("#loading").dialog("open");
					},
					success : function(data) {

						if (data.indexOf("Return successfully e-Verified. Download Acknowledgement") != -1) {
							$(".ui-dialog-content").dialog("close");
							$('#staticContentsUrl').html(data);

						} else if(data.indexOf("Link Aadhaar Success.") != -1){
							$(".ui-dialog-content").dialog("close");
							$('#staticContentsUrl').html(data);
						}else {

							$('#' + target).html(data);
						}

					},
					complete : function() {
						ajaxSubmitStarted = false;
						$("#loading").dialog("close");
					}
				});

		return false;
	}

	function triggerAjaxSubmit(formId) {
		try {
			var form = document.getElementById(formId);
			$("#loading").dialog("open");
			form.onsubmit();
			$("#loading").dialog("close");
		} catch (e) {
			alert(e);
		}
		return false;
	}

	function triggerAjaxSubmitForAadhaaar(formId) {

		try {
			document.getElementById('ajaxButton').disabled = true;
			var form = document.getElementById(formId);
			form.onsubmit();
		} catch (e) {
			alert(e);
		}
		return false;
	}

	function documentReadyFunction() {

		$(document).ready(function() {
			/*Added for deadlink error*/
			var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
			if(isSafari){
				if(document.getElementById('correctIndentation')!=null){
					document.getElementById('correctIndentation').style.left="382px";
				}
			}
            /*for testing*/

			$("#loading").dialog({
				autoOpen : false,
				dialogClass : 'noclose',
				modal : true,
				width : 100,
				height : 75
			});

			$("#savingDraft").dialog({
				autoOpen : false,
				dialogClass : 'noclose',
				modal : true,
				width : 100,
				height : 75
			});

			$("#prefillingData").dialog({
				autoOpen: false,
				dialogClass: 'noclose',
				modal: true,
				width: 100,
				height: 75
			});



			$("#dateField").datepicker({
				showOn : "button",
				buttonImage : "/itax/images/calendar.png",
				buttonImageOnly : true,
				changeMonth : true,
				changeYear : true,
				yearRange : "-100:",
				dateFormat : "dd/mm/yy",
				buttonText : "Choose",
				showOtherMonths : true,
				selectOtherMonths : true
			});

			$('#dateField').mask('00/00/0000');

			$(".date_dummy_black").datepicker({
				showOn : "button",
				buttonImage : "/itax/images/calendar.png",
				buttonImageOnly : true,
				changeMonth : true,
				changeYear : true,
				yearRange : "-100:+6",
				dateFormat : "dd/mm/yy",
				buttonText : "Choose",
				showOtherMonths : true,
				selectOtherMonths : true
			});

			$('.date_dummy_black').mask('00/00/0000');
			$('.date_dummy_white').mask('00/00/0000');

			$("a").click(function(e) {

				var flag = $(this).attr("href").match("/e-Filing/");

				if (flag != null && flag.length > 0) {

					if (flag != null && flag.length > 0) {
						$("#loading").dialog("open");
					}

					var onclick = $(this).attr("onclick");

					flag = null;

					if (onclick != "undefined" && onclick != undefined) {
						flag = onclick.match("closeDialog");
					}

					if (flag != null && flag.length > 0) {
						$("#loading").dialog("close");
					}

				}
			});

			keyBoardFocus();

			$(".help").hover(function(){
				if($(".helpmenu.hindiHelp").length == 0){
                    $(".helpmenu").load("/eFiling/Portal/headerHelp.html");
                } else{
				    $(".helpmenu.hindiHelp").load("/eFiling/PortalHindi/headerHelp.html");
                }
			},function(){
				return;
			});


			$('.currency').text(function(){
				return getFormattedCurrency($(this).text());
			});

			$( "#openTimerPopUp" ).dialog({
			    autoOpen: false,
			    width: 750,
			    height: 150,
			    modal : true,
			    show: {
			        duration: 500
			      },
			    hide: {
			        effect: "fold",
			        duration: 500
			     },
			     buttons: {
			         Ok: function() {
			             $(this).dialog("close"); //closing on Ok click
					}
			     },
			});

			$('.menu li').click(function(){
				$('.menu li').removeClass('hover');
			});

		});

		$.ajaxSetup ({
		    cache: false
		});

	}

	function getFormattedCurrency(amount){
		if(amount.length <= 3){
			return amount;
		}

		var amount0 = amount.substring((amount.length)-3,amount.length);
		var amount1 = (amount.substring(0, (amount.length)-3)).replace(/(\d)(?=(\d\d)+(?!\d))/g, "$1,");

		return (amount1+","+amount0);
	};

	var globalVillage = 0;

	function closeDialog() {
		$("#loading").dialog("close");
	}

	function fileModified() {
		fileModifid = true;
	}

	function setFileModifiedFalse() {
		fileModifid = false;
	}

	function keyBoardFocus() {

		$(document).ready(function() {
			$("ul li").focusin(function(){

				if( ($(this).has("li").length != 0) ) {

					 $(this).addClass("hover");

					 $('.helpmenu').find('div:last li:last').focusout(function(){
						 $('.help').removeClass("hover");
					 });

					 $('.helpmenu').find('div li').click(function(){
						 $('.help').removeClass("hover");
					 });

					 $('.helpmenu').mouseout(function(){
						 $('.help').removeClass("hover");
					 });

					 $('.bluecol li').find('ul li:last-child').focusout(function(){
						 $(this).parent().parent().removeClass("hover");
					 });
				}

			});

			$(".menu li").focusin(function(){

				if( ($(this).has("dl").length != 0) ) {

					 $(this).addClass("hover");

					 $('.menu li .submenu').find('dl:last-child  dt:last-child').focusout(function(){

						 $(this).parent().parent().parent().removeClass("hover");

					 });

					 $('.menu li .submenu').mouseout(function(){

						 $('.menu li').removeClass("hover");

					 });

				}
			});
		});
	}

	function onlyNumbersWithHyphen(e) {

		var keynum;

		if (e.keyCode == 13 || e.which == 13) {
			return true;
		}

		if (e.keyCode == 9 || e.which == 9) {
			return true;
		}
		if (e.which == 0) {
			return true;
		}

		if (e.keyCode == 8 || e.which == 8) {
			return true;
		}

		if (e.keyCode == 32 || e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkHyphen(keynum)) {
			return true;
		}

		return false;
	}

	function checkHyphen(keynum) {

		if (keynum != 45) {
			return false;
		} else {
			return true;
		}
		}

function onlyNumbersCharWithDot(e) {

		var keynum;

		if (e.keyCode == 13 ||e.which == 13 ) {
			return true;
		}

		if (e.keyCode == 9 ||e.which == 9 ) {
			return true;
		}
		if (e.which == 0 ) {
			return true;
		}

		if (e.keyCode == 8 ||e.which == 8 ) {
			return true;
		}

		if (e.keyCode == 32 ||e.which == 32) {
			return false;
		}

		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (checkNumber(keynum) || checkDot(keynum) || checkAlphabet(keynum)) {
			return true;
		}

		return false;
	}

	function checkDot (keynum) {

		if (keynum != 46 ) {
			return false;
		}
		else {
			return true;
		}
	}

	//VALIDATION
	/*
	 * $Id: validation.js 692578 2008-09-05 23:30:16Z davenewton $
	 *
	 * Licensed to the Apache Software Foundation (ASF) under one
	 * or more contributor license agreements.  See the NOTICE file
	 * distributed with this work for additional information
	 * regarding copyright ownership.  The ASF licenses this file
	 * to you under the Apache License, Version 2.0 (the
	 * "License"); you may not use this file except in compliance
	 * with the License.  You may obtain a copy of the License at
	 *
	 *  http://www.apache.org/licenses/LICENSE-2.0
	 *
	 * Unless required by applicable law or agreed to in writing,
	 * software distributed under the License is distributed on an
	 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
	 * KIND, either express or implied.  See the License for the
	 * specific language governing permissions and limitations
	 * under the License.
	 */

	function clearErrorMessages(form) {
	    clearErrorMessagesXHTML(form);
		clearActionMessagesAndErros();
	}

	function clearErrorMessagesXHTML(form) {
	try
	{


		var allDivTags = form.getElementsByTagName("div");

		for (var i = 0; i < allDivTags.length; i++) {

	        var divTag = allDivTags[i];

			if (divTag.getAttribute("className") == "error" || divTag.getAttribute("class") == "error" || divTag.getAttribute("errorFor") != null ) {
				var tdNode  = divTag.parentNode;
				tdNode.removeChild(divTag);
			}

	    }

	}
	catch (e)
	{
		alert ('Saras :- ' + e);

	}
	}

	function clearErrorLabels(form) {
	    clearErrorLabelsXHTML(form);
	}


	function clearErrorLabelsXHTML(form) {
	}

	function addError(e, errorText) {
	    addErrorXHTML(e, errorText);
	}

	function addErrorXHTML(e, errorText) {

	    try {
	        var row = (e.type ? e : e[0]);

	        while(row.nodeName.toUpperCase() != "TD") {
	            row = row.parentNode;
			}
			var nodeList = row.childNodes;

			for (var i = 0; i < nodeList.length; i++) {

				var node = nodeList[i];
				if (node.nodeName == 'DIV') {

					var div = node;

					if (div.getAttribute("errorFor") == row.id ) {


						div.innerHTML = errorText;
						return;
					}

				};

			}


	        var error = document.createTextNode(errorText);
	        var div = document.createElement("div");
	        var span = document.createElement("span");

			div.setAttribute("width", "100%");
			div.setAttribute("class", "error");
			div.setAttribute("className", "error"); //ie hack cause ie does not support setAttribute

			div.setAttribute("errorFor", e.id); //ie hack cause ie does not support setAttribute

			div.appendChild(error);

			row.insertBefore(div,nodeList[0]);


	    } catch (e) {
	        alert('Exception :- ' + e);
	    }

	}


	function clearFieldErrorMessages(field) {

	    clearFieldErrorMessagesXHTML(field);
	}

	function clearFieldErrorMessagesXHTML(e) {

			var row = (e.type ? e : e[0]);

	        while(row.nodeName.toUpperCase() != "TD") {
	            row = row.parentNode;
			}


			var nodeList = row.childNodes;

			for (var i = 0; i < nodeList.length; i++) {

				var node = nodeList[i];
				if (node.nodeName == 'DIV') {

					var div = node;


					if (div.getAttribute("errorFor") == e.id  || div.getAttribute("errorFor") == 'undefined' ) {

						var divNodeList = div.childNodes;

								if (div.getAttribute("errorFor") == e.id  || div.getAttribute("errorFor") == 'undefined' ) {


									div.innerHTML = "";
									div.className="";
									return true;

					}

					}

				};

			}

	}

	function clearFieldErrorLabels(field) {

	    clearFieldErrorLabelsXHTML(field);
	}


	function clearFieldErrorLabelsXHTML(field) {
		try
		{

		var td = field.parentNode.parentNode;
	    //td.setAttribute("class", "tdNormal");
		//td.setAttribute("className", "tdNormal");
		}
		catch (e)
		{
			alert (e);
		}

	}



	function clearActionMessagesAndErros() {


		var actionMessage = document.getElementById('actionMessages');


		if (actionMessage != null) {
			actionMessage.parentNode.removeChild(actionMessage);
		}

		var actionError = document.getElementById('actionErrors');

		if (actionError != null) {
			actionError.parentNode.removeChild(actionError);
		}

	}


	function isFirstDateBefore(firstDate,secondDate){
		if((firstDate != null && firstDate != '') && (secondDate != null && secondDate != '')){
			if(eval(firstDate.substring(6,10)) < eval(secondDate.substring(6,10))){
				return true;
			} else if(eval(firstDate.substring(6,10)) == eval(secondDate.substring(6,10))){
				if(eval(firstDate.substring(3,5)) < eval(secondDate.substring(3,5))){
					return true;
				} else if(eval(firstDate.substring(3,5)) == eval(secondDate.substring(3,5))){
					if(eval(firstDate.substring(0,2)) < eval(secondDate.substring(0,2))){
						return true;
					} else if(eval(firstDate.substring(0,2)) == eval(secondDate.substring(0,2))){
						return true;
					} else {
						return false;
					}
				} else{
					return false;
				}
			} else {
				return false;
			}
		}else{
			return false;
		}
	}


	function validatePasswordStrength (password) {

			var special   = (password.match("[!@#$%^&*()_]") != null);
			var alpSmall  = (password.match("[a-z]") != null);
			var alpBig    = (password.match("[A-Z]") != null);
			var numb      = (password.match("[0-9]") != null);

			var checkInt = 4;

			if (!special) {
				checkInt = eval (checkInt - 2);
			}
			if (!alpSmall) {
				checkInt = eval (checkInt - 1);
			}
			if (!alpBig) {
				checkInt = eval (checkInt - 1);
			}
			if (!numb) {
				checkInt = eval (checkInt - 2);
			}

			if (checkInt >= 3) {
				return true;
			}

		return false;

	}

	function isDouble (input) {

				for(var i=0;i<input.length;i++) {
		            if( i == input.length - 3 ) {
	                    continue; // skipping .(dot)
	                 }
					if(!(input.charAt(i)>='0' && input.charAt(i)<='9')) {
			    			 return false;
					}
				}
				return true;
	}

	function isInteger (input) {

				for(var i=0;i<input.length;i++) {
					if(!(input.charAt(i)>='0' && input.charAt(i)<='9')) {
			    			 return false;
					}
				}
				return true;
	}


	function checkDate(inputDate) {

				if (inputDate.replace(/^\\s+|\\s+$/g,'').length == 0) {
					return true;
				}

				var dateArray   = inputDate.split("/");

				var isDateValid = true;

				if (dateArray.length == 3) {

					var dayOfDate     = dateArray [0];
					var monthOfDate   = dateArray [1];
					var yearOfDate    = dateArray [2];

					if (	 isInteger (dayOfDate)
					 	 &&  isInteger (monthOfDate)
					 	 &&  isInteger (yearOfDate)
					 	 &&  dayOfDate.length   == 2
					 	 &&  monthOfDate.length == 2
					 	 &&  yearOfDate.length  == 4 ) {

					 	 var tempDate = new Date(monthOfDate + "/" + dayOfDate + "/" + yearOfDate);

			 	 		if (tempDate.getMonth() != monthOfDate - 1) {

			 	 			isDateValid = false;
						}
					}
					else {
						isDateValid = false;
					}
				}
				else {
					isDateValid = false;
				}


				return isDateValid ;
	}

	function getFormFromField(field) {

				try {

					var form = field.form;

					if (form == undefined) {
						form = field[0].form;
					}

					if (form == undefined) {
						form = document.forms[0];
					}
				  return form;
				} catch (e) {
					//alert (e);

				}

				return document.forms[0];

	}

	function requiredCheck(field,error){

				var tempValLen =field.value.replace(/^\s+|\s+$/g, '').length;

				if ( (field.value != null) && ((field.value == '') || (tempValLen == 0))) {

					addError(field, error);
					return true;
				}

	}

	function requiredStringCheck(field,error){

				var row = (field.type != null) ? field : field[0];
				var tempValLen =row.value.replace(/^\s+|\s+$/g, '').length;

				if ( (row.value != null) && ((row.value == '') || (tempValLen == 0))) {

					addError(row, error);
					return true;
				}

	}

	function regexCheck(field,error,regEx){

				var row = (field.type != null) ? field : field[0];

				if (row.value != null && !row.value.match(regEx)) {

					addError(row, error);
					return true;
				}

	}

	function stringLengthCheck(field, error, min, max){

				if ( field.value != null) {

					var value = field.value;

					if ((min > -1 && value.length < min) || (max > -1 && value.length > max)) {

						addError(field, error);
						return true;
					}

					if (!value.match("^[ \\w \\d \\s \\. \\& \\+ \\- \\, \\! \\@ \\# \\$ \\% \\^ \\* \\( \\) \\; \\\\ \\/ \\| \\< \\> \\\" \\' \\? \\= \\: \\[ \\] \\~ ]*$")) {

						addError(field, "Invalid character(s) in input");
						return true;
					}

				}
	}

	function nameReqStringCheck(field, error, nonEmptyAttributeName){

				if ( field.value != null) {

					var form = getFormFromField(field);
					var nonEmptyField = form.elements[nonEmptyAttributeName];

					if (nonEmptyField.value.replace(/^\s+|\s+$/g, '').length == 0 && field.value.replace(/^\s+|\s+$/g, '').length != 0) {

						addError(field, error);
						return true;
					}
				}
	}

	function validateDateCheck(field, error ){

				if ((field.value != null) && !checkDate(field.value)) {

						addError(field, error);
						return true;
				}
	}

	function emailCheck(field, error ){

		if (field.value != null && field.value.length > 0 && field.value .match(/\b^['_a-z0-9-\+]+(\.['_a-z0-9-\+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2}|aero|arpa|asia|biz|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|nato|net|org|pro|tel|travel|xxx)$\b/gi) == null) {

				addError(field, error);
				return true;
		}
	}

	function conditionalValueCheck(field, checkFiled, checkValue){

		var form = getFormFromField(field);
		var checkFieldValue = form.elements[checkFiled].value;

		if (checkFieldValue != null && checkFieldValue != undefined && checkFieldValue.match(checkValue)) {
			return true;
		}

	}

	function validateDuplicacyCheck(field, error,  dupAttributeName){

		if (field.value != null && field.value.replace(/^\s+|\s+$/g, '').length != 0) {

			var form = getFormFromField(field);
			var checkFieldValue = document.getElementsByName(dupAttributeName)[0].value;

			if (checkFieldValue.toUpperCase().replace(/^\s+|\s+$/g, '') == field.value.toUpperCase().replace(/^\s+|\s+$/g, '')) {

				addError(field, error);
				return true;

			}
		}
	}

	function validateRadioCheck(field, error){

		var checked = false;

		for ( var i = 0; i < field.length; i++) {

			if (field[i].checked) {

				checked = true;
				clearFieldErrorMessages(field[0]);
				clearFieldErrorLabels(field[0]);

			}
		}

		if (!checked) {
			addError(field, error);
			return true;
		}

	}

	function conditionalValidatorCheck(field, error, checkFiled, checkValue, regex){

		var form = getFormFromField(field);
		var checkFieldNodeList = form.elements[checkFiled];
		var toBeChecked = false;

		if (checkFieldNodeList != null) {
			for ( var i = 0; i < checkFieldNodeList.length; i++) {
				if (checkFieldNodeList[i].checked && checkFieldNodeList[i].value == checkValue) {
					toBeChecked = true;
				}
			}
		}
		if (toBeChecked) {
			if (regex == '' || regex == 'null') {
				if ( field.value != null && (field.value == '' || field.value.replace(/^\s+|\s+$/g, '').length == 0)) {
					addError(field, error);
					return true;
				}
			} else if (regex == 'RADIO') {
				var checked = false;
				for ( var i = 0; i < field.length; i++) {

					if (field[i].checked) {
						checked = true;
					}
				}
				if (!checked) {
					addError(field, error);
					return true;
				}
			} else {
				if ( field.value != null && !field.value.match(regex)) {
					addError(field, error);
					return true;
				}
			}
		}

	}

	function validatePhoneNumberCheck(field, error, stdCodeFieldName){

		var form = getFormFromField(field);

		var landlineNumber = field.value.replace(/^\s+|\s+$/g, '');
		var stdCode = form.elements[stdCodeFieldName].value.replace(/^\s+|\s+$/g, '');
		form.elements[stdCodeFieldName].value = stdCode;
		field.value = landlineNumber;

		var totalLength = landlineNumber.length + stdCode.length;

		if (totalLength != 0) {
			if (totalLength != 10) {
				addError(field, error);
				return true;

			} else if (stdCode.length != 0 && stdCode.match('^0')) {

				if (stdCodeFieldName.match('fax')) {
					error = "STD Code cannot begin with '0'.";
				} else {
					error = "STD Code cannot begin with '0'.";
				}
				addError(field, error);
				return true;

			} else if (landlineNumber.length != 0 && landlineNumber.match('^0')) {

				if (stdCodeFieldName.match('fax')) {
					error =  " Fax Number cannot begin with '0'.";
				} else {
					error = "Landline Number cannot begin with '0'.";
				}

				addError(field, error);
				return true;
			}
		}
	}

	function validateNumericConAttribute(field, checkFiled, checkValue){

		var form = getFormFromField(field);
		var checkFieldValue = form.elements[checkFiled].value

		if (checkValue == checkFieldValue ) {
			return true;


		}
	}

	function validateNumericCheck(field, error, minValue, maxValue){

		if(field.value != null){
			var fieldValue = parseFloat(field.value);

			if (fieldValue <  minValue || fieldValue > maxValue ) {

				addError(field, error);
				return true;
			}


		}
	}

	function validatePasswordCheckSpace(field, error){

		if ((field.value != null) && field.value.match(' ') ) {

			addError(field, error);
			 return true;
		}


	}

	function validatePasswordCheck(field, error){

		if ((field.value != null) && !validatePasswordStrength(field.value) ) {

			addError(field, error);
			 return true;
		}

	}

	function multipleConditionalValidatorCheck(field, error, checkFileds, checkValues, regex){

		var toBeChecked = true;
		 checkFileds=checkFileds.split('#');
		checkValues=checkValues.split('#');

		for ( var i = 0; i < checkValues.length && toBeChecked; i++) {

			var form = getFormFromField(field);
			var checkFieldNodeList = form.elements[checkFileds[i]];
			var checkValue = checkValues[i];

			if (checkFieldNodeList != null && checkFieldNodeList.length != undefined && checkFieldNodeList.type != 'select-one') {
				for ( var j = 0; j < checkFieldNodeList.length; j++) {

					if (!(checkFieldNodeList[j].checked && checkFieldNodeList[j].value.match(checkValue))) {
						toBeChecked = false;
					} else {
						toBeChecked = true;
						break;
					}
				}
			} else if (checkFieldNodeList != null && checkFieldNodeList != undefined) {
				if (!(checkFieldNodeList.value.match(checkValue))) {
					toBeChecked = false;
				}
			}
		}
		if (toBeChecked) {
			if (field.value != null && !field.value.match(regex)) {
				addError(field, error);
				return true;
			}
		}
	}


	function clearNameErrors(field){

		var form = getFormFromField(field);

		clearFieldErrorMessages(form.elements['userNameDetails.firstName']);
		clearFieldErrorLabels(form.elements['userNameDetails.firstName']);

		clearFieldErrorMessages(form.elements['userNameDetails.middleName']);
		clearFieldErrorLabels(form.elements['userNameDetails.middleName']);
	}


	//VALIDATION_SIMPLE
	/*
	 * $Id: validation.js 692578 2008-09-05 23:30:16Z davenewton $
	 *
	 * Licensed to the Apache Software Foundation (ASF) under one
	 * or more contributor license agreements.  See the NOTICE file
	 * distributed with this work for additional information
	 * regarding copyright ownership.  The ASF licenses this file
	 * to you under the Apache License, Version 2.0 (the
	 * "License"); you may not use this file except in compliance
	 * with the License.  You may obtain a copy of the License at
	 *
	 *  http://www.apache.org/licenses/LICENSE-2.0
	 *
	 * Unless required by applicable law or agreed to in writing,
	 * software distributed under the License is distributed on an
	 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
	 * KIND, either express or implied.  See the License for the
	 * specific language governing permissions and limitations
	 * under the License.
	 */

	function clearErrorMessages_Online(form) {
		clearErrorMessagesXHTML_Online(form);
	}

	function clearErrorMessagesXHTML_Online(form) {

	}
	function clearFieldErrorLabels_Online(form) {
	}
	function clearFieldErrorMessages_Online(form) {
	}

	function addError_Online(e, errorText) {
		addErrorXHTML_Online(e, errorText);
	}

	var lastErrorField = '';

	function addErrorXHTML_Online(e, errorText) {

		if(e!=null && e!=undefined && e!=''){
			focusTab(e);
			window.scroll(0,findPos(e));
			calculatePos(e);
		}

		lastErrorField=e;
		$('#validationErrorMsg').stop(0,function(){});

		$('#validationErrorMsg').show(0,function(){
			$('#validationErrorMsg').html(errorText);
			$('#validationErrorMsg').fadeOut(12000);
		});

		if(e==null||e==undefined||e==''){
			$('#validationErrorMsg')[0].style.top = '10px';
			$('#validationErrorMsg')[0].style.width = '50%';
			$('#validationErrorMsg')[0].style.left = '';
			$('#validationErrorMsg')[0].className="";
		}
		else{
			calculatePos(e);
			window.onscroll=function() { calculatePos(e, true) };
		}
	}

	function findPos(obj) {
	    var curtop = 0;
	    if (obj.offsetParent) {
	        do {
	            curtop += obj.offsetTop;
	        } while (obj = obj.offsetParent);
	    return [curtop -100];
	    }
	}

	function calculatePos(e, scroll){

		if($('#validationErrorMsg')[0].className=='' && scroll==true){
			return;
		}
		var pos = $('[name="'+e.name+'"]').offset();
		var top = (pos.top - $('#validationErrorMsg')[0].offsetHeight - 15);
		$('#validationErrorMsg')[0].className="triangleBottom-isosceles";
		if(top < 0){
			top = pos.top + e.offsetHeight + 15;
			$('#validationErrorMsg')[0].className="triangleTop-isosceles";
		}
		pos.top = top;
		$('#validationErrorMsg').offset(pos);
		$('#validationErrorMsg')[0].style.width = '300px';
	}

	function getOffset( el ) {
	    var _x = 0;
	    var _y = 0;
	    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
	        _x += el.offsetLeft ;
	        _y += el.offsetTop ;
	        el = el.offsetParent;
	    }
	    return { top: _y -  $(document).scrollTop(), left: _x - $(document).scrollLeft()};
	}

	function isFirstDateBeforeOrEqual(firstDate,secondDate){
		if((firstDate != null && firstDate != '') && (secondDate != null && secondDate != '')){
			if(eval(firstDate.substring(6,10)) < eval(secondDate.substring(6,10))){
				return true;
			} else if(eval(firstDate.substring(6,10)) == eval(secondDate.substring(6,10))){
				if(eval(firstDate.substring(3,5)) < eval(secondDate.substring(3,5))){
					return true;
				} else if(eval(firstDate.substring(3,5)) == eval(secondDate.substring(3,5))){
					if(eval(firstDate.substring(0,2)) < eval(secondDate.substring(0,2))){
						return true;
					} else {
						return false;
					}
				} else{
					return false;
				}
			} else {
				return false;
			}
		}else{
			return false;
		}
	}

	function checkFileSize(fileSize) {
		var browserName = navigator.userAgent;
		var fileIds ;
		if(navigator.userAgent.indexOf('MSIE 8.0')==-1){
		fileIds = document.forms[0].getElementsByClassName('fileUpload');
		}
		else{
			fileIds = document.forms[0].querySelectorAll('.fileUpload');
		}
		var isArray = false;
		var sizeComputed = 0, maxFileSize = 52428800;
		if (!isNaN(fileSize) && fileSize != 0)
			maxFileSize = fileSize;

		if (document.getElementsByName('isFileSizeOk').length == 0) {
			var input = document.createElement("input");
			input.setAttribute("name", "isFileSizeOk");
			input.setAttribute("type", "hidden");
			input.setAttribute("value", "2");
			document.forms[0].appendChild(input);
		}
		if (document.getElementsByName('maxFileSize').length == 0) {
			var input = document.createElement("input");
			input.setAttribute("name", "maxFileSize");
			input.setAttribute("type", "hidden");
			input.setAttribute("value", fileSize);
			document.forms[0].appendChild(input);
		}
		if (fileIds.length > 0) {
			isArray = true;
		}
		var browserAccept = true;

		if (browserName.indexOf('MSIE') != -1) {

			try {
				var myActiveX = new ActiveXObject("Scripting.FileSystemObject");
				if (browserAccept) {
					if (isArray) {
						for ( var i = 0; i < fileIds.length; i++) {
							if (fileIds[i].value != '')
								sizeComputed = sizeComputed
										+ myActiveX.getFile(fileIds[i].value).size;
						}
					} else {
						if (fileIds.value != '')
							sizeComputed = myActiveX.getFile(fileIds.value).size;
					}
				}
			} catch (e) {
				browserAccept = false;
			}
		} else {
			try {

				if (isArray) {
					for ( var i = 0; i < fileIds.length; i++) {
						var tempSize=0;
						if (fileIds[i].files.length != 0){
							tempSize=fileIds[i].files[0].size;
							sizeComputed = sizeComputed + tempSize;
						}

						if (isNaN(sizeComputed)) {
							browserAccept = false;
							break;
						}
						insertFileSize(i,tempSize);
					}
				} else {
					var tempSize=0;
					if (fileIds.files.length != 0){
						tempSize=fileIds.files[0].size;
						sizeComputed = sizeComputed +tempSize ;

					}
					if (isNaN(sizeComputed)) {
						browserAccept = false;
					}
					insertFileSize(0,tempSize);

				}
			} catch (e) {
				alert(e);
				browserAccept = false;
			}
		}
		if (browserAccept)
			if (sizeComputed > maxFileSize) {
				sizeComputed=sizeComputed/(1024*1024);
				sizeComputed=(sizeComputed+'');
				if(sizeComputed.indexOf('.') != -1){
					sizeComputed=sizeComputed.substring(0,sizeComputed.indexOf('.')+4);
				}
				alert('The attachment upload is '+sizeComputed+' MB. All the attachments together submitted exceed 50MB.');
				document.getElementsByName('isFileSizeOk')[0].value = 0;
			} else if (sizeComputed != 0) {
				document.getElementsByName('isFileSizeOk')[0].value = 1;
			}

		/*if (!browserAccept) {
			if (document.getElementById('fileAppletDiv') == null
					|| document.getElementById('fileAppletDiv') == 'undefined') {
				var div = document.createElement("div");
				div.setAttribute("id", "fileAppletDiv");

				var newContent = document.createTextNode("");

				div.appendChild(newContent);

				document.forms[0].appendChild(div);
			}

			document.getElementById("fileAppletDiv").innerHTML = '<object	classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" codebase="http://java.sun.com/products/plugin/autodl/jinstall-1_4-windows-i586.cab#Version=1,4,0,0"						width="130" height="25" mayscript="true">		<param name="type" value="application/x-java-applet;version=1.4"></param>		<param name="code" value="FileUploadApplet"></param>		<param name="archive"	value="/e-Filing/DitApplet/FileUploadApplet.jar"></param>		<param name="mayscript" value="true"></param>			<param name="scriptable" value="true"></param>			<param name="fileNameField" value="uploadFile"></param>			<param name="certificationChainField" value="certificationChain"></param>			<param name="signatureField" value="signature"></param>		<param name="tokenType" value="tokenType"></param>			<param name="signButtonCaption" value="Sign with .PFX file"></param>		<comment> <embed					type="application/x-java-applet;version=1.4"	pluginspage="http://java.sun.com/products/plugin/index.html#download"		code="FileUploadApplet"		archive="/e-Filing/DitApplet/FileUploadApplet.jar" width="130"			height="25" mayscript="true" scriptable="true"		uploadform="mainForm" filenamefield="uploadFile"			certificationchainfield="certificationChain"		signaturefield="signature" tokentype="tokenType"							signbuttoncaption="Sign selected file"></embed> <noembed>Document signing applet cannot be started because Java Plug-In version 1.6 or later is not installed.</noembed> </comment>		</object>';
		}*/

	}
	function countRowInTable(field,inField) {
		var count = 0;
		while (true) {
			if (document.getElementsByName(field+'['+ count + '].'+inField).length != 0)
				count++;
			else
				break;

		}
		return count;
	}

	function getCurDate()
	{

		var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1;

	    var yyyy = today.getFullYear();
	    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}

	    var today = dd+'/'+mm+'/'+yyyy;

	    return today;
	}

	function curDateCompare(DateA, DateB) {     // this function is good for dates > 01/01/1970

	    var a = new Date(DateA.substring(0,2),DateA.substring(3,5),DateA.substring(6,10));
	    var b = new Date(DateB.substring(0,2),DateB.substring(3,5),DateB.substring(6,10));

	    var msDateA = Date.UTC(a.getFullYear(), a.getMonth()+1, a.getDate());
	    var msDateB = Date.UTC(b.getFullYear(), b.getMonth()+1, b.getDate());

	    if (parseFloat(msDateA) < parseFloat(msDateB))
	      return true;

	      return false;
	}

	function focusTab(akhilFieldName){

	    var tempField = document.getElementsByName(akhilFieldName)[0];
	    callMeRec(tempField,akhilFieldName );
	    return false;
	}

	function callMeRec(tempField,akhilFieldName){
	try{
	var parentElem = tempField.parentNode;

		var parentElemId = parentElem.id;

	        if(parentElemId != undefined){
		if(parentElemId.match("^page[0-9]{1,2}$")){
			if(document.getElementById('currentPage').value != parentElemId.substring(4))
			showPage(parentElemId);
			document.getElementsByName(akhilFieldName)[0].focus();
	                 var element=document.getElementsByName(akhilFieldName)[0];

	             colorHighlight(element, [255,0,0], [211,211,211], 2500);
		}else{
			callMeRec(parentElem,akhilFieldName);
		}
	        }else{
	callMeRec(parentElem,akhilFieldName);
	}
		return true;
	}catch(e){
		//alert('exception caught in callMeRec =' + e);
	}

	}


	function colorHighlight(element, startcolour, endcolour, time_elapsed) {

	    var interval = 30;
	    var steps = time_elapsed / interval;
	    var red_change = (startcolour[0] - endcolour[0]) / steps;
	    var green_change = (startcolour[1] - endcolour[1]) / steps;
	    var blue_change = (startcolour[2] - endcolour[2]) / steps;
	    var currentcolour = startcolour;
	    var stepcount = 0;

	element.style.borderColor = 'rgb(' + currentcolour.toString() + ')';
		 var timer = setInterval(function(){
	        currentcolour[0] = parseInt(currentcolour[0] - red_change);
	        currentcolour[1] = parseInt(currentcolour[1] - green_change);
	        currentcolour[2] = parseInt(currentcolour[2] - blue_change);

	element.style.borderColor = 'rgb(' + currentcolour.toString() + ')';

	stepcount += 1;
	        if (stepcount >= steps) {



	element.style.borderColor = 'rgb(' + endcolour.toString() + ')';
	clearInterval(timer);
	        }
	    }, interval);
	}

	function globalVillageCheck(field,error, globalVillage){

		if(globalVillage==undefined || globalVillage == null || globalVillage==0){

			addError_Online(field, error);
			return true;
		}

	}

	function requiredCheck_Online(field){

		var tempValLen =field.value.replace(/^\s+|\s+$/g, '').length;

		if ( (field.value != null) && ((field.value == '') || (tempValLen == 0))) {

				return true;
			}

	}


	function requiredStringCheck_Online(field,error){

		var tempValLen =field.value.replace(/^\s+|\s+$/g, '').length;

		if ( (field.value != null) && ((field.value == '') || (tempValLen == 0))) {

			addError_Online(field, error);
			return true;
		}

	}

	function clearNameErrors_Online(field){

		var form = document.forms[0];

		clearFieldErrorMessages_Online(form.elements['userNameDetails.firstName']);
		clearFieldErrorLabels_Online(form.elements['userNameDetails.firstName']);

		clearFieldErrorMessages_Online(form.elements['userNameDetails.middleName']);
		clearFieldErrorLabels_Online(form.elements['userNameDetails.middleName']);
	}

	function regexCheck_Online(field,error,regEx){

		if (field.value != null && !field.value.match(regEx)) {

			addError_Online(field, error);
			if(field.type != 'select-one'){

				field.value = '' ;
			}
			return true;
		}

	}

	function validateAsstYearCheck(field,error, error1){

		if( field.value != null && field.value.length != 0 && field.value.match("^[0-9]{4}[-][0-9]{2}$")){

			var asstYearOne= field.value.substring(2,4);
			var asstYearTwo= field.value.substring(5);

			if (((asstYearTwo- asstYearOne) != 1) && ((asstYearOne- asstYearTwo) != 99)) {

				addError_Online(field, error);
				field.value = '' ;
				return true;
			}else{

				var asstYearEnter = parseInt(field.value.substring(0,4),10);
				var asstYearSession =parseInt(document.getElementsByName('asstYearSession')[0].value);

				if ( asstYearEnter > asstYearSession ){

					addError_Online(field, error1);
					field.value = '' ;
					return true;
				}
			}

		}
	}

	function validate4DigitAsstYearCheck1(field,error){

		if(field.value != null && field.value.match("^[0-9]{4}$")) {

			var asstYearEnter = parseInt(field.value.substring(0,4),10);
			var asstYearSession =parseInt(document.getElementsByName('asstYearSession')[0].value);
			if ( asstYearEnter > asstYearSession ){

				addError_Online(field, error);
				field.value = '' ;
			}


		}

	}

	function validate4DigitAsstYearCheck2(field,error){

		if(field.value != null && field.value.length!=0 &&  !field.value.match("^[0-9]{4}$" )) {

				addError_Online(field, error);
				field.value = '' ;
			}
	}

	function emailCheck_Online(field, error){


		if (field.value != null && field.value.length > 0 && field.value .match(/\b^['_a-z0-9-\+]+(\.['_a-z0-9-\+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2}|aero|arpa|asia|biz|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|nato|net|org|pro|tel|travel|xxx)$\b/gi) == null) {

				addError_Online(field, error);
				field.value = '' ;
				return true;
		}
	}
	function validateRadioCheck_Online(fieldArray, error){

		var checked = false;

		for ( var i = 0; i < fieldArray.length; i++) {

			if (fieldArray[i].checked) {
				checked = true;
			}
		}

		if (!checked) {
			addError_Online(fieldArray[0], error);
			return true;
		}

	}
	function conditionalValidatorCheck_Online(field, error, checkFiled, checkValue, regex){

			var form = document.forms[0];
			var checkFieldNodeList = form.elements[checkFiled];
			var toBeChecked = false;
			if (checkFieldNodeList != null) {

				for (var i = 0; i < checkFieldNodeList.length; i++) {

					if (checkFieldNodeList[i].checked && checkFieldNodeList[i].value == checkValue ) {
						toBeChecked = true;
					}
				}
			}

			if (toBeChecked) {

				if (regex == '' || regex == 'null') {

					if ( field.value != null && (field.value == '' || field.value.replace(/^\s+|\s+$/g, '').length == 0)) {
						addError_Online(field, error);
						return true;
					}
				} else if (regex == 'RADIO') {
					var checked = false;
					for ( var i = 0; i < field.length; i++) {

						if (field[i].checked) {
							checked = true;
						}
					}
					if (!checked) {
						addError_Online(field, error);
						return true;
					}
				} else {
					if ( field.value != null && !field.value.match(regex)) {
						addError_Online(field, error);
						return true;
					}
				}
			}
	}

	function validatePhoneNumberCheck_Online(field, error, stdCodeFieldName){

		var form = document.forms[0];

		var landlineNumber = field.value.replace(/^\s+|\s+$/g, '');
		var stdCode = form.elements[stdCodeFieldName].value.replace(/^\s+|\s+$/g, '');
		form.elements[stdCodeFieldName].value = stdCode;
		field.value = landlineNumber;

		var totalLength = landlineNumber.length + stdCode.length;

		if (totalLength != 0) {
			if (totalLength != 10) {
				addError_Online(field, error);
				return true;

			} else if (stdCode.length != 0 && stdCode.match('^0')) {

				if (stdCodeFieldName.match('fax')) {
					error = "STD Code cannot begin with '0'.";
				} else {
					error = "STD Code cannot begin with '0'.";
				}
				addError_Online(field, error);
				return true;

			} else if (landlineNumber.length != 0 && landlineNumber.match('^0')) {

				if (stdCodeFieldName.match('fax')) {
					error =  " Fax Number cannot begin with '0'.";
				} else {
					error = "Landline Number cannot begin with '0'.";
				}

				addError_Online(field, error);
				return true;
			}
		}
	}
	function conditionalRegexCheck(field, checkFiled, checkValue){

		var form = document.forms[0];
		var checkFieldValue = form.elements[checkFiled].value;

		if (checkFieldValue != null && checkFieldValue != undefined && checkFieldValue.match(checkValue)) {
			return true;
		}

	}

	function conditionalReqStringCheck(field, error, checkFiled, checkValue){

		var form = document.forms[0];
		var checkFieldValue = form.elements[checkFiled].value;
		if (checkValue == checkFieldValue ){

			if ( (field.value != null) && ((field.value == '') || (field.value.replace(/^\s+|\s+$/g, '').length == 0))) {

				addError_Online(field, error);
					return true;
				}

		}
	}

	function conditionalDateCheck(field, checkFiled,checkValue){

		var form = document.forms[0];
		checkFieldValue = form.elements[checkFiled].value

		if (checkFieldValue != undefined && checkFieldValue.match(checkValue) ) {
			if (field.value != null && (field.value == '' || field.value.replace(/^\s+|\s+$/g,'').length == 0)) {
					 return true;

			}
		}

	}

	function conditionalRequiredCheck(field, checkFiled, checkValue){

		var form = document.forms[0];
		checkFieldValue = form.elements[checkFiled].value

		if (checkFieldValue.match(checkValue) ) {
			if(field.value != null && (field.value == '' || field.value.replace(/^\s+|\s+$/g,'').length == 0)) {

				return true;

			}
		}
	}
	function validateDuplicacyCheck_Online(field, error,  dupAttributeName){

		if (field.value != null && field.value.replace(/^\s+|\s+$/g, '').length != 0) {

			var form = document.forms[0];
			var checkFieldValue = document.getElementsByName(dupAttributeName).value;

			if (checkFieldValue.toUpperCase().replace(/^\s+|\s+$/g, '') == field.value.toUpperCase().replace(/^\s+|\s+$/g, '')) {

				addError_Online(field, error);
				return true;

			}
		}
	}
	function nameReqStringCheck_Online(field, error, nonEmptyAttributeName){

		if(field.value != null) {
			var form = document.forms[0];
			var nonEmptyField = form.elements[nonEmptyAttributeName];

			if (nonEmptyField.value.replace(/^\s+|\s+$/g, '').length == 0 && field.value.replace(/^\s+|\s+$/g, '').length != 0) {

				addError_Online(field, error);
				return true;
			}
		}

	}

	function validateNumericConAttribute(field, checkFiled, checkValue){

		var form = document.forms[0];
		var checkFieldValue = form.elements[checkFiled].value

		if (checkValue == checkFieldValue ) {
			return true;

		}
	}

	function validateIsNumericCheck_Online(field){

		var form = document.forms[0];
		if (field.value != null && isNaN(field.value)) {

			addError_Online(field,"Please enter a numeric value");
			field.value = '' ;
			return true;

		}
	}

	function validateNumericCheck_Online(field, error, minValue, maxValue){

		if(field.value != null && !isNaN(field.value)){

			var fieldValue = parseFloat(field.value);

			if (fieldValue <  minValue || fieldValue > maxValue ) {

				addError_Online(field, error);
				field.value = '';
				return true;
			}
		}
	}

	function validateDateCheck_online(field){

		if(field.value != null && !checkDate(field.value) ) {

			field.value = '' ;
			addError_Online(field, "Invalid date. Please enter the date in dd/mm/yyyy format.");
			return true;

		}
	}

	function minDateCheck(field,error, dynaMinDate, min, isMinCurrentDate){
		if(!isMinCurrentDate){
			if(dynaMinDate!=null){
				if((field.value != null) && isFirstDateBeforeOrEqual(field.value,dynaMinDate) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}else{
				if ((field.value != null) && isFirstDateBefore(field.value, min ) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}
		}else{
				if ((field.value != null)  && isFirstDateBeforeOrEqual(field.value,getCurDate()) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}
	}

	function maxDateCheck(field,error, dynaMaxDate, max, isMaxCurrentDate){
		if(!isMaxCurrentDate){
			if(dynaMaxDate!=null){
				if((field.value != null) && isFirstDateBeforeOrEqual(dynaMaxDate,field.value) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}else{
				if ((field.value != null) && isFirstDateBefore(max,field.value) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}
		}else{
				if ((field.value != null)  && isFirstDateBeforeOrEqual(getCurDate(), field.value) ) {
					addError_Online(field, error);
					field.value = '' ;
					return true;
				}
			}
	}

	function validatePasswordCheckSpace_Online(field, error){

		if ((field.value != null) && field.value.match(' ') ) {

			addError_Online(field, error);
			 return true;
		}
	}

	function validatePasswordCheck_Online(field, error){

		if ((field.value != null) && !validatePasswordStrength(field.value) ) {

			addError_Online(field, error);
			 return true;
		}
	}

	function multipleConditionalValidatorCheck_Online(field, error, checkFileds, checkValues, regex){

		var toBeChecked = true;
		 checkFileds=checkFileds.split('#');
		checkValues=checkValues.split('#');

		for ( var i = 0; i < checkValues.length && toBeChecked; i++) {

			var form = document.forms[0];
			var checkFieldNodeList = form.elements[checkFileds[i]];
			var checkValue = checkValues[i];

			if (checkFieldNodeList != null && checkFieldNodeList.length != undefined && checkFieldNodeList.type != 'select-one') {
				for ( var j = 0; j < checkFieldNodeList.length; j++) {

					if (!(checkFieldNodeList[j].checked && checkFieldNodeList[j].value.match(checkValue))) {
						toBeChecked = false;
					} else {
						toBeChecked = true;
						break;
					}
				}
			} else if (checkFieldNodeList != null && checkFieldNodeList != undefined) {
				if (!(checkFieldNodeList.value.match(checkValue))) {
					toBeChecked = false;
				}
			}
		}
		if (toBeChecked) {
			if (field.value != null && !field.value.match(regex)) {
				addError_Online(field, error);
				if(field.type != 'select-one'){
					field.value='';
				}
				return true;
			}
		}
	}

	function validateTableCheck(fieldName,rowCount, conAttr, checkValue,tableMandatory,tempFieldArray,tempFieldErrMsgArray,tempFunctionArray){
		var form = document.forms[0];
		if(conAttr != 'null' || conAttr != null) {
			var checkFieldValue = form.elements[conAttr];
			if(checkFieldValue != undefined){
				checkFieldValue =checkFieldValue.value;
				if (checkValue == checkFieldValue ){
					tableMandatory='Y';
				}else {
					tableMandatory='N';
				}
			}
		}
	for(var v=0;v<rowCount;v++){
			var count = 0;
			if(tableMandatory=='N'){
				for ( var t1 = 0; t1 < tempFieldArray.length; t1++) {
					var tempFieldName = tempFieldArray[t1];
					var tempValLen = document.getElementsByName(fieldName + v + '].' + tempFieldName)[0].value.replace( /^\s+|\s+$/g,'').length;
					if (tempValLen != 0) {
						count++;
					}
				}
			}

			for(var t1=0;t1<tempFieldArray.length;t1++){
				var tempFieldName = tempFieldArray[t1];
				var tempValLen = document.getElementsByName(fieldName + v + '].' + tempFieldName)[0].value.replace(/^\s+|\s+$/g,'').length;
				var tem = fieldName + v + '].' + tempFieldName;
				if ( tempValLen != 0 ) {
					count++;
				}
				if ( (tableMandatory == 'Y' || count!=0  ) && tempValLen == 0) {
					addError_Online(document.getElementsByName(tem)[0], tempFieldErrMsgArray[t1]);
					focusTab(tem);
					return true;
				}else{
					var errors = tempFunctionArray[t1](document.getElementsByName(tem),false);
					if(!errors){
						focusTab(tem);
						return true;
					}
				}

			}

		}
	}

	function validateTableCheckForConMandFields(fieldName,error,rowCount, conAttr, checkValue,conMandAttr,conAttrForConMandField){

		var form = document.forms[0];
		for(var v=0;v<rowCount;v++){
			if(conAttr != 'null' || conAttr != null) {
				var checkFieldValue = form.elements[conAttr];
				if(checkFieldValue != undefined){
					if(checkValue == checkFieldValue && (conMandAttr != 'null' && conMandAttr != null) && (conAttrForConMandField != 'null' && conAttrForConMandField != null)) {
						var conAttrForConMandFieldVal = document.getElementsByName(fieldName + v + '].' + conAttrForConMandField)[0];
						var conMandAttrVal = document.getElementsByName(fieldName + v + '].' + conMandAttr)[0];
						if(conAttrForConMandFieldVal!= undefined && conMandAttrVal!= undefined){
							conAttrForConMandFieldVal = conAttrForConMandFieldVal.value;
							conMandAttrVal = conMandAttrVal.value;
							if(((conAttrForConMandFieldVal != 'null' || conAttrForConMandFieldVal != null) && conAttrForConMandFieldVal!='') && (conMandAttrVal == null || conMandAttrVal == 'null' || conMandAttrVal == '')){
								addError_Online(document.getElementsByName(fieldName + v + '].' + conMandAttr)[0],error);
								return focusTab(fieldName + v + '].' + conMandAttr);
							}
						}
					}
				}
			}

		}
	}

	function stringLengthCheck_Online(field, error, min, max){

		if ( field.value != null) {

			var value = field.value;

			if ((min > -1 && value.length < min) || (max > -1 && value.length > max)) {

				addError_Online(field, error);
				return true;
			}

			if (!value.match("^[ \\w \\d \\s \\. \\& \\+ \\- \\, \\! \\@ \\# \\$ \\% \\^ \\* \\( \\) \\; \\\\ \\/ \\| \\< \\> \\\" \\' \\? \\= \\: \\[ \\] \\~ ]*$")) {

				addError(field, "Invalid character(s) in input");
				return true;
			}
		}
	}
	
	function specialCharsCheck(field, error, min, max){

		if ( field.value != null) {

			var value = field.value;

			if ((min > -1 && value.length < min) || (max > -1 && value.length > max)) {

				addError_Online(field, error);
				return true;
			}

			if (!value.match("^[ \\w \\d \\s \\. \\& \\+ \\- \\, \\! \\@ \\# \\$ \\% \\^ \\* \\( \\) \\; \\\\ \\/ \\| \\< \\> \\\" \\' \\? \\= \\: \\[ \\] \\~ \\{ \\} ]*$")) {

				addError(field, "Invalid character(s) in input");
				return true;
			}
		}
	}
	function onlyNegativeNumbers(e) {

		fileModified();

			if(e.target.value!='' && e.target.value.length > 1 && e.target.value.charAt(0)!='-' && e.target.originalLength){
				e.target.maxLength = e.target.originalLength;
			}

			var keynum;

		if(e.target.value.charAt(0) !='-'){
			e.target.maxLength = parseInt(14, 10);

		}else{
			e.target.maxLength = parseInt(15, 10);

		}

		if (e.keyCode == 13 ||e.which == 13 ) {
			return true;
		}

		if (e.which == 0 ) {
			return true;
		}

		if (e.keyCode == 9 ||e.which == 9 ) {
			return true;
		}

		if (e.keyCode == 8 ||e.which == 8 ) {
			return true;
		}

		if (e.keyCode == 32 ||e.which == 32) {
			return false;
		}

		if (e.keyCode == 45 ||e.which == 45) {
			if(e.target.originalLength){
				e.target.maxLength = parseInt(e.target.originalLength, 10) + parseInt(1, 10);
			}else{
				e.target.originalLength = e.target.maxLength;
				e.target.maxLength = parseInt(e.target.originalLength, 10) + parseInt(1, 10);
			}
			return true;
		}


		if (window.event) // IE
		{
			keynum = e.keyCode;
		} else if (e.which) // Netscape/Firefox/Opera
		{
			keynum = e.which;
		}

		if (!checkNumber(keynum)) {
			return false;
		}
		return true;

	}



	function downloadDSCUtility(){
		/*alert('DSC utility is developed using JAVA technology and effort has been made to make it user friendly, simpler and faster preparation of tax returns. This utility can run on operating systems like Windows 7.0 or above, Latest Linux and Mac OS 10.10(OS X Yosemite), Where Java Runtime Environment Version 7 update 6 to Version 8 Update 51 is installed.\n\n JRE Version 8 Update 51 is available for download at the below link\n http://www.oracle.com/technetwork/java/javase/downloads/java-archive-javase8-2177648.html#jre-8u51-oth-JPR\n\nThe downloaded ZIP folder of the requisite ITR form should be Extracted/Unzipped before opening the JAVA utility.');*/
		window.open("/eFiling/Portal/DownloadUtil/DSC_UTILITY/DSC_UTILITY.zip?"+Math.random(),'_blank');
	}


	function goToPage(staticContentsUrl,page,flag){

		document.getElementById("staticContentsUrl").innerHTML = '';
		document.getElementById("staticContentsUrl").className = 'leftColumn';
		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());
		staticContentsUrl= "/eFiling/Portal/"+staticContentsUrl;
		$("#staticContentsUrl").load(staticContentsUrl,function(responseTxt, statusTxt, xhr){
			showPage(page);
			if(flag){
				var asYear=document.getElementById("asstYear").value;
				document.getElementById('asstYear').selectedIndex=1;
			}
		});
	}
	/*New function goToPageHindi*/
	function goToPageHindi(staticContentsUrl,page,flag){

		document.getElementById("staticContentsUrl").innerHTML = '';
		document.getElementById("staticContentsUrl").className = 'leftColumn';
		loadStaticPageMme("ltcol","/eFiling/PortalHindi/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/PortalHindi/Header.html?"+Math.random());
		staticContentsUrl= "/eFiling/PortalHindi/"+staticContentsUrl;
		$("#staticContentsUrl").load(staticContentsUrl,function(responseTxt, statusTxt, xhr){
			showPage(page);
			if(flag){
				var asYear=document.getElementById("asstYear").value;
				document.getElementById('asstYear').selectedIndex=1;
			}
		});
	}
	
	function goToPageOnSelection(staticContentsUrl,page,flag){

		document.getElementById("staticContentsUrl").innerHTML = '';
		document.getElementById("staticContentsUrl").className = 'leftColumn';
		loadStaticPageMme("ltcol","/eFiling/Portal/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/Portal/Header.html?"+Math.random());
		staticContentsUrl= "/eFiling/Portal/"+staticContentsUrl;
		$("#staticContentsUrl").load(staticContentsUrl,function(responseTxt, statusTxt, xhr){
			showPage(page);
			if(flag){
				document.getElementById('asstYear').selectedIndex=1;
				var asYear=document.getElementById("asstYear").value;
				disableForms();
				changeNote();
			}
		});
	}
	/*New function for hindi*/
	function goToPageOnSelectionHindi (staticContentsUrl,page,flag){
		document.getElementById("staticContentsUrl").innerHTML = '';
		document.getElementById("staticContentsUrl").className = 'leftColumn';
		loadStaticPageMme("ltcol","/eFiling/PortalHindi/Prelogin_Left_Column.html?"+Math.random());
		loadStaticPageMme("header","/eFiling/PortalHindi/Header.html?"+Math.random());
		staticContentsUrl= "/eFiling/PortalHindi/"+staticContentsUrl;
		$("#staticContentsUrl").load(staticContentsUrl,function(responseTxt, statusTxt, xhr){
			showPage(page);
			if(flag){
				document.getElementById('asstYear').selectedIndex=1;
				var asYear=document.getElementById("asstYear").value;
				disableForms();
				changeNote();
			}
		});
	}

function populateTdsAsstYr(){

	var finYr= document.getElementsByName('stmtParamater.finYr')[0].value;

	if(finYr != "-1"){
	document.getElementsByName('stmtParamater.asstYr')[0].value = parseInt(finYr)+101;
	}
	else{
		document.getElementsByName('stmtParamater.asstYr')[0].value = "";
	}


}


function discLinks(){

	$("#openLinkDisc  a").each(function(){

	var href =  $(this).attr("href");

	$(this).attr("onclick","openDisclaimer('"+href+"')");

	$(this).attr("href","javascript:void(0)");

	$(this).attr("target","");

	  });
	}
function downloadExcel(excelSessionNames){
	var lst = [];
	if (excelSessionNames == null || excelSessionNames.length == 0 || excelSessionNames[0] == '') {
		url="/e-Filing/MyAccount/DownloadMISReport.html?ID="+$("#sessionId")[0].value;
		lst.push(url)
		downloadAll(lst);
		return;
	}
	
	if(typeof excelSessionNames === 'string'){
		url="/e-Filing/MyAccount/DownloadMISReport.html?ID="+$("#sessionId")[0].value+"&dataKey="+excelSessionNames;
		lst.push(url)
		downloadAll(lst);
		return;
	}
	for(var  i = 0; i < excelSessionNames.length; i++){
		var excelSessionName = excelSessionNames[i];
		
		url="/e-Filing/MyAccount/DownloadMISReport.html?ID="+$("#sessionId")[0].value+"&dataKey="+excelSessionName;
		lst.push(url);
	}
	downloadAll(lst);
	
}

function downloadAll(urls) {
  var link = document.createElement('a');

  link.setAttribute('download', null);
  link.style.display = 'none';

  document.body.appendChild(link);

  for (var i = 0; i < urls.length; i++) {
    link.setAttribute('href', urls[i]);
    link.click();
  }

  document.body.removeChild(link);
}
function openPopUp(path){
	
	   $("#showPop").dialog({
	     modal:true,
		 Width:450,
		 height:140,
		 title: 'Know Your PAN | TAN | A.O',
		 resizable: false,
		 dialogClass: 'dialog-style',
		 
		});
			  
 }
function hideDiv(){
	var a =$('#doDisplay').val();
		if(a!="dodisplay")
			$('#hindi').hide();
	}
