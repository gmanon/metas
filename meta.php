<?php
// data file holding array values for metas, and links
require_once "data.inc.php";

// file holding functions
require_once "functions.inc.php";

// file holding Language
require_once "language.inc.php";

// Necessary var holders
$fields = array("checkbox"=>"name","checkbox"=>"http","checkbox"=>"links");
$language = "en-US";
$error_messages = '';
$keys = '';

$formfields=   "<input type='checkbox' name='field[0]' value='name' /> Name<br>\n
					<input type='checkbox' name='field[1]' value='http' /> Http<br>\n
					<input type='checkbox' name='field[2]' value='link' /> Link<br><br>\n";


// Function to create a form
function form_head($name,$method,$action,$submit,$myfields)
{

    $form = '<blockquote><form name="'.$name.'" action="'.$action.'" method="'.$method.'">'."\n";
    
    $form .= $myfields;
    
    $form .= '<input type="submit" name="'.$submit.'" value="'.$submit.'"><br>'."\n";
    $form .= '</form></blockquote>'."\n";
    
    return $form;
    
}
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="generator" content="Bluefish 2.2.10" >
<meta name="author" content="guillermina" >
<meta name="date" content="2018-08-14T22:56:49-0400" >
<meta name="copyright" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="expires" content="0">
</head>
<body>
<?php
// Page value switch
// Showing all the options available on metas to choose from
	if(!isset($_GET['Show']))
    { echo "<h3>".SHOW_FIELDS."</h3>";
    	echo form_head(SHOW_FIELDS,"get",$_SERVER['SCRIPT_NAME'],"Show",$formfields);
    
    }elseif(isset($_GET['Show']))
    {
    		echo "<h3>".ADD_METAS."</h3>\n"; 
    		echo '<blockquote><form name="show_code" method="get" action="">'."\n";
    		echo '<table border="1"><tr>'."\n";
   
    
    foreach($_GET['field'] as $field)
     {  
     		echo '<td width="200" valign="top"><b>'.ucwords($field).'</b><br/>'."\n";
     		
     		if($field=='name')
     		{
     			foreach($meta_names as $key=>$vars)
     			{
					echo "<input type='checkbox' radiogroup='names' name='name:$key' value='$vars' /> ".ucwords($key)."<br>\n";

				}
     		}
     		elseif($field=='http')
     		{
     			foreach($meta_http_equiv as $key=>$vars)
     			{
					echo "<input type='checkbox' radiogroup='https' name='http:$key' value='$vars' /> ".ucwords($key)."<br>\n";

				}
     		}
     		elseif($field=='link')
     		{
     			foreach($link_header as $key=>$vars)
     			{
     				echo "<input type='checkbox' radiogroup='links' name='link:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    			}
    		}}
    echo '</tr></table>'."\n";
    		'<input type="hidden" name="fields" value="'.$_GET['field'].'">';
    echo '<input type="submit" name="add_metas" value="'.ADD_METAS.'"></form><br>'."\n";
    echo '</form></blockquote>'."\n";
    

    }
    
    if(isset($_GET['add_metas']))
    {
    	echo '<blockquote><form name="show_code" method="get" action="">'."\n";
    	
    	foreach($_GET as $key=>$value)
    	{
    		if(substr($key,0,4)=="name")
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
    		
    
    	echo "<form id='metas'>\n<textarea style='padding-top:12px;padding-left:0;margin-left:0;' cols='65' rows='12' id='myInput' value=''>\n";

    	
    	
    	$counter = 0;
    	foreach($show_vars as $key=>$vars)
		{
    		//echo  "\t&lt;meta name=\"$key\" content=\"$vars\"/&gt;\n";
    		if(stristr($keys[$counter],':',-1)=="name")
    		{
    			echo  "\t&lt;meta name='".stristr(substr($keys[$counter],"5",-1),"/",-1)."' content='".trim(stristr($keys[$counter],"/",0),"/")."'/&gt;\n";
    		}
    		elseif(stristr($keys[$counter],':',-1)=="http")
    		{
    			echo  "\t&lt;meta http-equiv='".
    			stristr(substr($keys[$counter],"5",-1),"/",-1)."' content='".trim(stristr($keys[$counter],"/",0),"/")."'/&gt;\n";
    		}elseif(stristr($keys[$counter],':',-1)=="link")
    		{
    			echo  "\t&lt;link rel='".stristr(substr($keys[$counter],"5",-1),"/",-1)."' url='".trim(stristr($keys[$counter],"/",0),"/")."'/&gt;\n";
    		}
    		
    		$counter++;
    		
    		
    		
		}
		


    	echo "</textarea>\n";
    	echo "<br><!--<input type='submit' onClick='myFunction()' name='copy' value='Copy'>-->
    	<button onclick='myFunction()'>Copy Metas</button>";
    	
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
//echo '<pre>';print_r($keys);echo '</pre>';
require_once("error.inc.php");   

?>