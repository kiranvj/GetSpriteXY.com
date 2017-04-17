<?php
$fileSource = "images/sample-sprite-getspritexy.png";
if($_FILES)
{
	//echo($_FILES['sprite-upload']['type']);
	// Check if the uploaded file is an image
	if ($_FILES['sprite-upload']['type'] == "image/gif"  ||
		$_FILES['sprite-upload']['type'] == "image/jpg"  ||
        $_FILES['sprite-upload']['type'] == "image/jpeg" ||
		$_FILES['sprite-upload']['type'] == "image/pjpeg" ||
        $_FILES['sprite-upload']['type'] == "image/bmp"  ||
        $_FILES['sprite-upload']['type'] == "image/x-png"  ||
        $_FILES['sprite-upload']['type'] == "image/png")
	{	
	
		$newFileName = "user-files/newpath".uniqid("file"); // Store the file in user-files folder
		
		if(move_uploaded_file($_FILES["sprite-upload"]["tmp_name"],$newFileName))
		{
			$fileSource = $newFileName;
            chmod($newFileName, 0644);
		}
	}	
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find icon positions from a CSS sprite image</title>
<meta name="Description" content="This tool helps to find icon positions inside a CSS sprite sheet which you can use in background-position CSS property. You can use the generated styles in you CSS class.">
<meta name="Keywords" content="css sprite, sprite image, sprite sheet, icon position, background, position, generate css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link href="css/getspritexy-styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
</head>
<body class="no-filereader">
<div id="page-wrapper">
<div id="header"><span class="page-title">GetSpriteXY.com |</span> 
   <h1><a href="#" id="what-why">What, Why, How?</a></h1>  
   <div class="hidden-dom" id="helper-window">
        Q: What does this site do ? <br />
        A: Using this site you can find the co-ordinates of the icons inside a CSS sprite. <br /><br />
        Q: How to use it? <br />
        A: Upload your CSS sprite. The uploaded sprite will be displayed. Use mouse to select an icon. CSS will generated. Copy and use it in your CSS class.<br /><br />
        Icons credit<br />
        <a href="http://www.gnome.org/" target="_blank">Gnome Desktop Project</a><br /><a href="http://tango.freedesktop.org/" target="_blank">Tango Desktop Project</a><br /><a href="http://p.yusukekamiyamane.com/" target="_blank">Yusuke Kamiyamane</a><br /><br />
        <!--<a href="change-log.html">Change log</a>-->
        <span id="close-helper">X</span>
    </div>
    <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FGetspritexycom%2F578266762253420&amp;width=200&amp;height=62&amp;colorscheme=dark&amp;show_faces=false&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:62px;float:right;position: absolute; right: 25%;top: 10px;" allowTransparency="true"></iframe>
</div>
  <form action="" method="post" enctype="multipart/form-data">
    <div id="file-upload-container">
      <label for="sprite-upload">Click here to use your CSS sprite image </label>
      <input type="file" id="sprite-upload" name="sprite-upload" />
      <input type="submit" value="Upload" />
    </div>
  </form>
  <div id="settings-panel">
      <div id="change-background-container">
        <span id="color-section-title">Change background color</span>
        <span class="background-colors selected" id="color-dark"></span>
        <span class="background-colors" id="color-white"></span>
        <span class="background-colors" id="color-red"></span>
        <span class="background-colors" id="color-green"></span>
        <span class="background-colors" id="color-blue"></span>
        <span class="transparent-bg" id="transparent-bg"></span>
      </div>
      <!--<div id="twox-panel">
            <label for="2x-checkbox">2x</label>
            <input type="checkbox" id="2x-checkbox" value="" />
      </div>--><!-- End of 2x-panel -->
  </div>
  <div id="work-area">
    <div id="image-container">
      <img src="<?php echo($fileSource);?>" id="loaded-sprite-image">
    </div>      
    <div id="info-panel" class="is-right-aligned">
        <div id="info-panel-title-bar">
            <span id="display-panel" class="hidden-dom">Hide</span>
            <span id="move-panel-left" title="Move this panel to left"></span>
            <span id="move-panel-right" title="Move this panel to right"></span>
        </div>
        <div id="info-panel-contents">
            <span> X = <span id="selection-x" class="info-data"></span></span>
            <span> Y = <span id="selection-y" class="info-data"></span></span><br />
            <span> Width = <span id="selection-width" class="info-data"></span></span>
            <span> Height = <span id="selection-height" class="info-data"></span></span>
            <div id="user-backgrounds-container">

                <div class="user-background">
                    <label for="sytle-output">Generated style</label>
                    <textarea id="style-output"></textarea>
                    <br />
                    <br />
                    <span>Generated sprite image</span>
                    <div id="generated-sprite-div-wrapper">
                        <div class="background-image" id="generated-sprite-div">
                        </div>  
                    </div>
                </div><!-- End of .user-background -->
            </div><!-- End of user-backgrounds-container -->
        </div><!-- End of info-panel-contents -->
    </div>
   </div> 
  <div id="footer">
    <span id="version">v1.0.38 &clubs; </span><span>Crafted by <a href="#" class="crafted">Kiran Paul V.J.</a> &clubs; </span>
    Maintained by <a href="http://einternals.com" target="_blank">eInternals</a><br />Fork <a class="crafted" href="https://github.com/kiranvj/GetSpriteXY.com">here</a>
  </div>
</div>
<div style="text-align:center; margin-top:30px;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- getspritexy-bottom -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2571409125261248"
     data-ad-slot="9870610150"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!-- Start visitor map -->
<div style="width:500px;text-align:center;margin:30px auto;">
	<script type="text/javascript" src="//rf.revolvermaps.com/0/0/7.js?i=5z9f1nqsvgv&amp;m=0&amp;c=ff0000&amp;cr1=ffffff&amp;sx=0" async="async"></script>
</div>
<!-- End visitor map -->
<!--<div id="no-support-message">
  Your browser does not support HTML5 features needed to function this website properly. A version of this site compactable with old browsers is under construction. Meanwhile please use latest Firefox, Chrome, Safari or any other forward thinking browsers.
</div>
-->
<script type="text/javascript" src="js/lib/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="js/get-sprite-xy.js?v=38"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33065764-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>