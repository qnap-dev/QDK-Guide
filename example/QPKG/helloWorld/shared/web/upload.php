<html>
<head>
<title>QNAP Upload File Example</title>
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
  // Upload a file to NAS.
  var fileForm = document.forms.namedItem("fileInfo");
  fileForm.addEventListener('submit', function(ev) {
    var documentUpload = document.querySelector("#upload");
    var data = new FormData(fileForm);
    var nasIp = location.hostname;
    var nasSid = getCookie('NAS_SID');
    var uploadFile = data.get("file");
    var dstPath = "/Public";
    var progress = '-' + uploadFile.name;
    var request = new XMLHttpRequest();
    request.open("POST", "http://" + nasIp + ":8080/cgi-bin/filemanager/utilRequest.cgi?sid=" + nasSid + "&func=upload&type=standard&dest_path=" + dstPath + "&overwrite=1&progress=" + progress, true);
    request.onload = function(oEvent) {
      if (request.status == 200) {
        var result = JSON.parse(this.responseText);
        if (result.status == 1) {
          documentUpload.innerHTML = "File " + uploadFile.name + " is uploaded to path /share" + dstPath + ".";
        } else {
          documentUpload.innerHTML = "File " + uploadFile.name + " is not uploaded successfully.";
        }
      } else {
        documentUpload.innerHTML = "Error " + request.status + " occurred when trying to upload your file.</br>";
      }
    };

    request.send(data);
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
In this example, we will use File Management HTTP API to upload a file.</br>
<form enctype="multipart/form-data" method="post" name="fileInfo">
  <input type="file" name="file" required /></br></br>
  <input type="submit" value="Upload the file!" />
</form>
<div id="upload"></div>
</div>
</body>
</html>

