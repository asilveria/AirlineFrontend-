<html>
<head>

<b><title>Airline Database Project</title>
   <style type="text/css">
  	body {
    	font-family: "Arial";
    	color: 000000;
    	background-color: #FFFFFF; 
	}
  </style>  
</head>

<body>
<?php
$dbconn = pg_connect("host=blue.cs.sonoma.edu dbname=group13db user = postgres");
	if ($dbconn) {
        print "Successfully connected to: " . pg_host($dbconn) . "<br/>\n";
		}
	else{
		print"There was an error connecting to the server ";
	}
	$query = ($_POST["query"]);
	
	
	

	$drop = 'drop';
	$insert = 'insert';
	$pos = stripos($query, $drop);
	$pos2 = stripos($query, $insert);
	if($pos !== False or $pos2 !== False)
	{
		echo "This query contains a drop or insert statement. Please refrain from tampering.";
	}
	else{


$result = pg_query($query) or die ('Query failed: ' . pg_last_error());
	
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
	{
		echo "\t<tr>\n";
		foreach ($line as $col_value)
		{
			echo "\t\t<td>$col_value</td>\n";
		}
		echo "\t</tr>\n";
	}
	echo "</table>\n";
	

	pg_free_result($result);

	}
	pg_close($dbconn);
	
?>
	
<button onclick="goBack()">New Query</button>

<script>
function goBack() {
  window.history.back();
}
</script>


</body>
</html>
