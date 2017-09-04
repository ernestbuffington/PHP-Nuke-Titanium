
var lastKlicked_Val  = "";


// *********************
function getStr(myVal)
// *********************
{
 var retVal = "";
 retVal = myVal + "";
 return retVal;
}


// ************************
function strTrim(stringToTrim)
// ************************
{
    stringToTrim = getStr(stringToTrim);

    if ((stringToTrim!="") && (stringToTrim!=" "))
    {
	 return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
  return "";
}


// **************************
function anon(cbox)
// **************************
{
	if (cbox.checked) {
		document.forms.frm_login.phpftp_user.value   = "anonymous";
		document.forms.frm_login.phpftp_passwd.value = "myself@somewhere.com";
	}
	else
	{
		document.forms.frm_login.phpftp_user.value   = "";
		document.forms.frm_login.phpftp_passwd.value = "";
	}
}



// **************************************************  
function finish_form(wert,nach,errortext,confirmtext)
// **************************************************
{
    if ((errortext==null)||(errortext.length==0))     { errortext = false; }    
    if ((confirmtext==null)||(confirmtext.length==0)) { confirmtext = false; } else { confirmtext += ' ' + wert + '?'; }

    if ((wert!='')&&(wert!='..')&&(wert!='.'))
    {
    	// wert ok
        nach.value = wert;    // WERT AUS EXPLORER (DIR ODER FILE) IN SUB FORM HIDDEN FELD UEBERNEHMEN

        if (confirmtext)
        {
        	if (confirm(confirmtext)) { return true; }
        	else                      { return false; }
        }
        
    	// keine confirmation aber wert ok
        return true;
    }
    else // wert nicht ok
    {
    	if (errortext) { alert(errortext); }
    }

    return false;
}


// **************************
function switch_dir(dir)
// **************************
{
 if ((dir!="")&&(dir!=null))
 {
  document.forms.directory_select.phpftp_dir.value=dir;
  document.forms.directory_select.submit();
 }
}


// **************************
function enter_dir(clickObj)
// **************************
{
    if (clickObj != "")
    {
        if (clickObj!="..") { document.forms.directory_select.submit(); }
        else                { go_up(); }
    }
}


// *****************************
function download_file(clickObj)
// *****************************
{
    if (clickObj != "")
    {
        document.forms.file_select.submit();
    }
}


// *****************************
function go_up()
// *****************************
{
    document.forms.directory_up.submit();
}


// *****************************
function check_file(fname)
// *****************************
{
    fname = fname.replace(/^\s+|\s+$/g, '');

    if (fname!="")
    {
        return true;
    }
    return false;
}


// **********************************
function decode_unix_right(strRights)
// **********************************
{
 var perm = new Array("","","");

 strRights = strTrim(strRights);

 if (strRights.length==9)
 {
  var strRightNumbers = strRights.replace(/r/g,"4").replace(/w/g,"2").replace(/x/g,"1").replace(/-/g,"0");

  var arrPerm = new Array(strRightNumbers.substr(0,3),strRightNumbers.substr(3,3),strRightNumbers.substr(6,3));

  for (i=0;i<3;i++) {
   perm[i] = parseInt(arrPerm[i].substr(0,1))+parseInt(arrPerm[i].substr(1,1))+parseInt(arrPerm[i].substr(2,1));
  }
 }

 return perm.join("");
}


// **********************************
function show_right_number(wert,feld)
// **********************************
{
 var pos1 = wert.indexOf("|");
 if (pos1!=-1) {
    feld.value = decode_unix_right(wert.substr(pos1+1,9));
 }
 else
 {
    feld.value = "---";
 }
}

