<?php
		header('Content-type: text/xml; charset="iso-8859-1"', true);
		echo '';

?>
<?xml version="1.0" encoding="iso-8859-1"?> 
<rss version="2.0">
<channel>
    <title>RSS example</title>
    <link></link>
    <description>RSS PRÓXIMAS MODAS</description>
    <language>es</language>
    <?php
	    $mysqli = new mysqli('localhost', 'root', '', 'identitylaravel');
			
		$sql = "select id, titol, cos, nom_imatge from proximes_modes order by id DESC limit 5";
		//Farem la consulta
		if ( ! $result = $mysqli->query($sql) ) {
			echo "No s'ha pogut realitzar la consulta";
			echo mysqli_error();
			exit;
		}
        while ( $row = $result->fetch_assoc() ){
    ?>
	    <item>
	        <title><?php echo $row['titol'] ?></title>
	        <?php $img = "<img class='foto_rss' src='http://localhost/IdentityEYE/public/img/fotos_modes/".$row['nom_imatge']."'/>"; ?>
	        <description> 
	        	<?php echo $row['cos']?>
	        	<?php echo '<![CDATA[<br><br>'.nl2br($img).' ]]>'?>
	        </description>
			
	        
			
	    </item>
    <?php }
    ?>
</channel>
</rss>