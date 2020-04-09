<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->

<script>
    function setCookie(cname,cvalue,exdays) {
var d = new Date();
d.setTime(d.getTime() + (exdays*24*60*60*1000));
var expires = "expires=" + d.toGMTString();
console.log(expires);
document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
var name = cname + "=";
var decodedCookie = decodeURIComponent(document.cookie);
var ca = decodedCookie.split(';');
for(var i = 0; i < ca.length; i++) {
var c = ca[i];
while (c.charAt(0) == ' ') {
  c = c.substring(1);
}
if (c.indexOf(name) == 0) {
  return c.substring(name.length, c.length);
}
}
return "";
}

function checkCookie() {
var user=getCookie("username");
if (user != "") {
alert("Welcome again " + user);
} else {
 user = prompt("Please enter your name:","");
 if (user != "" && user != null) {
   setCookie("username", user, 30);
 }
}
}
    function redireccionar() {

      var emailJson={"email":"", "id":"","password":""};
      var email=document.getElementById("instituto-email").value;
      var id=document.getElementById("instituto-id").value;
      var password=document.getElementById("instituto-password").value;
      emailJson.email=email;
      emailJson.id=id;
      emailJson.password=password;
      console.log("PAPA O PAPA");
      console.log(emailJson.email);
      setCookie("email",JSON.stringify(emailJson),30);
      window.location.href="http://localhost:4200/estudiante/confirmacion";
    }
</script>


</head>
<body onload="redireccionar()">
<input type="hidden" id="instituto-email" value="{{$usuario->email}}" />
<input type="hidden" id="instituto-id" value="{{$usuario->id}}"/>
<input type="hidden" id="instituto-password" value="{{$usuario->password}}"/>
</body>

</html>
