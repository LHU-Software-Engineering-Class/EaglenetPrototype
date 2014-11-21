<?php
/*
File Name: Breaking Bad... code.
Created by: Dan Muthler
Creation Date: 11/18/14
Last Modified By: Dan Muthler
Last Modified Date: 11/18/14
Desc: The purpose of this code will be to verify that 
strings passed to the Strip_html_tags.php file are stripped of things that shouldn't be there.
*/
include 'strip_html_tags.php';
include 'header.php';

$links = '<a href="http://www.google.com">Google</a>';
echo strip_html_tags($links);

$urls = '<img src="https://lh3.googleusercontent.com/-oXbyCuM-vws/AAAAAAAAAAI/AAAAAAAAAAA/c4wTlG8-Ht0/photo.jpg"  width="90" height="90" alt="Users Avatar" border="0" />';
echo strip_html_tags($urls);

$head = '<head>ENCLOSED DATA</head>';
echo strip_html_tags($head);

$style = '<style> ENCLOSED DATA...</style>';
echo strip_html_tags($style);

$script = '<script> ENCLOSED DATA...</script>';
echo strip_html_tags($script);

$object = '<object> ENCLOSED DATA...</object>';
echo strip_html_tags($object);

$embed = '<embed> ENCLOSED DATA...</embed>';
echo strip_html_tags($embed);

$applet = '<applet> ENCLOSED DATA...</applet>';
echo strip_html_tags($applet);

$noframes = '<noframes> ENCLOSED DATA...</noframes>';
echo strip_html_tags($noframes);

$noscript = '<noscript> ENCLOSED DATA...</noscript>';
echo strip_html_tags($noscript);

$noember = '<noembed> ENCLOSED DATA...</noembed>';
echo strip_html_tags($noembed);

 
