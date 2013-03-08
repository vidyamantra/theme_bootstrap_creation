function frmvalidation()
{
 if(document.editmenu.link.value=='')
 {
 alert("Menu URL can not be blank");
 document.editmenu.link.focus();
 return false;
 }
 if(document.editmenu.name.value=='')
 {
 alert("Menu Link Title can not be blank");
 document.editmenu.name.focus();
 return false;
 }
 return true;
}

function Cancel_button()
{
	window.location="index.php";
}
function delete_cookie ( cookie_name )
{
  var cookie_date = new Date ( );  // current date & time
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}