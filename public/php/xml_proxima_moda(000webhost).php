<?php
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
// Opens a connection to a MySQL server
$mysqli = new mysqli('localhost', 'id5912503_eloiroca', '3coma1415', 'id5912503_identitylaravel');
$sql = "select titol, cos, nom_imatge from proximes_modes limit 5";
$result = $mysqli->query($sql);
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>RSS example</title>';
echo '<link></link>';
echo '<description>RSS PRÓXIMAS MODAS</description>';
echo '<language>es</language>';
while ( $row = $result->fetch_assoc() ){
$img = "<img class='foto_rss' src='http://identityeye.000webhostapp.com/public/img/fotos_modes/".$row['nom_imatge']."'/>";
echo '<item>';
echo '<title>'.$row['titol'].'</title>';
echo '<description>';
echo $row['titol'];
echo '<![CDATA[<br><br>'.$img.']]>';
echo '</description>';
echo '</item>';
}
echo '</channel>';
echo '</rss>';
?>