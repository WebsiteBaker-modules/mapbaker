<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="de" xml:lang="de" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
<title>Geo-Koordinaten ermitteln und Geo-Meta-Tags erstellen</title>
<meta name="robots" content="index,follow"/>
<meta name="revisit-after" content="14 days"/>
<meta name="Content-Language" content="de"/><meta name="distribution" content="Global"/>


<link href="geopos.css" rel="stylesheet" type="text/css" media="all"/>
<!--[if IE]><style type="text/css"> #outer{word-wrap:break-word;} </style><![endif]-->
<script src="https://maps.google.com/maps?file=api&amp;v=2" type="text/javascript"></script>
<script src="geoscript.js" type="text/javascript"></script>
<script src="setfocus.js" type="text/javascript"></script>
</head>
<body onload="load(); setFocus('search')" onunload="GUnload()">

<form onsubmit="showAddress(); return false" action="">
   <p>Search:<br/><input id="search" class="searchinput" type="text" value=""/>
 <input name="image" type="image" class="searchbtn" src="search.png" alt="search"/></p>
</form>
<div id="message"></div>
<div  id="map"></div><br/>
<div style="display:none;" id="meta"></div>
<!-- a href="#" onclick="stealMetas()">Holen</a -->
</div>
</body>
</html>