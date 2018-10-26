<html>
<head>
<title>QNAP System Status Example</title>
<script>
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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

document.addEventListener("DOMContentLoaded", function(event){

  // Display NAS system status.
  var myButton = document.getElementById("myButton");
  myButton.addEventListener('click', function(ev) {
    var documentStatus = document.querySelector("#status");
    var nasIp = location.hostname;
    var nasSid = getCookie('NAS_SID');
    var request = new XMLHttpRequest();
    request.open("POST", "http://" + nasIp + ":8080/cgi-bin/management/manaRequest.cgi?sid=" + nasSid + "&subfunc=sysinfo", true);
    request.onload = function(oEvent) {
      console.log(request);
      console.log(request.response);
      documentStatus.innerHTML = request.response;
    };

    request.send();
    ev.preventDefault();
  }, false);

  // Display NAS CloudLink status.
  var myButton2 = document.getElementById("myButton2");
  myButton2.addEventListener('click', function(ev) {
    var documentStatus = document.querySelector("#cloudlink_status");
    var nasIp = location.hostname;
    var nasSid = getCookie('NAS_SID');
    var request = new XMLHttpRequest();
    request.open("POST", "http://" + nasIp + ":8080/cgi-bin/qpkg/CloudLink/tunnel_agent.cgi?sid=" + nasSid + "&cmd=get_status", true);
    request.onload = function(oEvent) {
      console.log(request);
      console.log(request.response);
      documentStatus.innerHTML = request.response;
    };

    request.send();
    ev.preventDefault();
  }, false);
});

</script>
</head>
<body>
<div style='font-size:30px'>
<a href='index.php'>Home</a> |
<a href='helloWorld.php'>HelloWorld</a> |
<a href='upload.php'>Upload</a> |
<a href='system.php'>System</a></br>
In this example, we will use the System Status API to get System status.</br>
<button id="myButton">Get System status</button>
</br>
System Info:</br>
<textarea id="status" style="width: 600px; height: 150px;"></textarea>
</br>
<button id="myButton2">Get CloudLink status</button>
</br>
CloudLink Info:</br>
<textarea id="cloudlink_status" style="width: 600px; height: 150px;"></textarea>
</div>
</body>
</html>

