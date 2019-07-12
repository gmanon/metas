<?php
// data file holding array values for metas, and links
require_once "data.inc.php";

// file holding functions
require_once "functions.inc.php";

// file holding Language
require_once "language.inc.php";

// Necessary var holders
$fields = array("checkbox"=>"name","checkbox"=>"http","checkbox"=>"links","checkbox"=>"grpn","checkbox"=>"grph");
$language = "en-US";
$error_messages = '';
$keys = '';

$formfields=   "<input type='checkbox' name='field[0]' value='name' /> Name<br>\n
					<input type='checkbox' name='field[1]' value='http' /> Http<br>\n
					<input type='checkbox' name='field[2]' value='link' /> Link<br>\n
					<input type='checkbox' name='field[3]' value='grpn' /> OpenGraph Name<br>\n
					<input type='checkbox' name='field[4]' value='grph' /> OpenGraph Graph<br><br>\n";

			// Form that shows field options [ name, http, link]
			$show_form = "<h3>".SHOW_FIELDS."</h3>";
			$show_form .= form_head(SHOW_FIELDS,"get",$_SERVER['SCRIPT_NAME'],"Show",$formfields);

			// Form that individual add meta selection

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="generator" content="Bluefish 2.2.10" >
<meta name="author" content="guillermina" >
<meta name="date" content="2018-08-18T23:22:54-0400" >
<meta name="copyright" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="expires" content="0">
<link href="style.css" hreflang="utf-8" title="Style" type="text/css" rel="stylesheet">
</head>
<body>
<?php
// Page value switch
// Showing all the options available on metas to choose from
	if(!isset($_GET['Show']))
    { 
    	// Show possible form fields    	
    	echo $show_form;
    
    }elseif(isset($_GET['Show']))
    {
    		// Show individual fields in columns of name, http and link
    		echo addMetas($_GET['field'], $meta_names, $meta_http_equiv, $link_header, $opengraph_name, $opengraph_graph, ADD_METAS, $_SERVER['SCRIPT_NAME']);
    }

    if(isset($_GET['add_metas']))
    {
    	echo '<blockquote><form name="show_code" method="get" action="'.$_SERVER['SCRIPT_NAME'].'">'."\n";
    	
    	foreach($_GET as $key=>$value)
    	{
    		$label_field = substr($key,0,4);
    		// Adding labels to meta string array
    		if($label_field=="name")
    		{
    			//echo substr($key,0,4);
    			$keys = $keys . (string) $key."/$value" .'*';
    			$newkey = str_replace("name:",'',$key);
    			print metaName($newkey, $value);
    			
    		}elseif(substr($key,0,4)=="http")
    		{
    			$keys = $keys . (string) $key."/$value" . '*';
    			$newkey = str_replace("http:",'',$key);
    			print metaName($newkey, $value);
    			
    		}elseif(substr($key,0,4)=="link")
    		{
    			$keys = $keys . (string) $key."/$value" . '*';
    			$newkey = str_replace("link:",'',$key);
    			print metaName($newkey, $value);
    			
    		}elseif(substr($key,0,4)=="grpn")
    		{
    			$keys = $keys . (string) $key."/$value" . '*';
    			$newkey = str_replace("grpn:",'',$key);
    			print metaName($newkey, $value);
    			
    		}elseif(substr($key,0,4)=="grph")
    		{
    			$keys = $keys . (string) $key."/$value" . '*';
    			$newkey = str_replace("grph:",'',$key);
    			print metaName($newkey, $value);
    			
    		}
    		//print $keys;
    		
    	}
    	
    	echo '<input type="hidden" name="keys" value="'.$keys.'">'."\n";
    	echo '<input type="submit" name="show_code" value="'.SHOW_CODE.'"></form><br>'."\n";
    	echo '</form></blockquote>';
    }
    
    $keys = explode('*',$_GET['keys']); array_pop($keys);
    
    if(isset($_GET['show_code']))
    {
    	
		   // popping out the last two array fields from the global _GET
    		$show_vars = $_GET;
    		array_pop($show_vars);
    		echo showCode($show_vars, $keys, $_SERVER['SCRIPT_NAME']);
    
    }
?>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied Metas: " + copyText.value);
}
</script>

</body>
</html>

<?php
/** echo '<pre>';print_r($keys);echo '</pre>';*/
require_once("error.inc.php");   

?>