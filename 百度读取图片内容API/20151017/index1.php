<html>
<head>
        <title>TesT</title>
        </head>
<body>        
<?php
$file = "bb.jpg";
$type = getimagesize($file);
$fp = fopen($file,"r") or die("Can't open file");
$file_content = chunk_split(base64_encode(fread($fp,filesize($file))));
switch($type[2]){
                case 1:$img_type="gif";break;
                case 2:$img_type="jpg";break;
                case 3:$img_type="png";break;
        }
$img = 'data:image/'.$img_type.';base64,'.$file_content;
fclose($fp);
?>
<img id="img" src="<?php echo $img; ?>" />
</body>
</html>