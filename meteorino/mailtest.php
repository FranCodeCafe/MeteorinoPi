<?php
$subject = "PHP Test mail";
$message = "Saludos desde el más allá! ";
$from = "MeteorinoPi";

mail("salinascastillojoaquin@gmail.com",$subject,$message,$from);
echo "Mail Sent.";
?>