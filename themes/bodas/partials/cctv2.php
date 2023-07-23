<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    
<video></video>
<br/>
    <input type="file" name="file" id="fileItem" onchange="onChange()" >
    <input type="submit" value="Play">
</form>
<script type="text/javascript">
var URL = window.URL || window.webkitURL;
var video = document.getElementsByTagName('video')[0];
function onChange() {
    var fileItem = document.getElementById('fileItem');
    var files = fileItem.files;
    var file = files[0];
    var url = URL.createObjectURL(file);
    video.src = url;
    video.load();
    video.onloadeddata = function() {
        video.play();
    }
}
</script>
</body>
</html>