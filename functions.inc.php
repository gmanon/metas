<?php
function metaName($meta_name, $meta_content="")
{
    $generate_meta_field = "<label name='$meta_name'><strong>".ucwords($meta_name)."</strong></label><br>\n";
    $generate_meta_field .= 
    								"<label name='content'>Content</label>: &nbsp;&nbsp;
    								<input type='text' name='$meta_name' value='' />
    								<span style='color:#999;'><em> $meta_content</em></span><br><br>\n";
    
    return $generate_meta_field;
    
}

	function name($name)
	{
		if(isset($name))
		{
			${$name} = " {$name}='$name'";
		}else{
			${$name} = '';
		}
		
		return ${$name};
	}
	//print name($rel='stylesheet');

function linkHeader($rel, $href='', $sizes='', $media='', $crossorigin='')
{
	
	if(isset($rel)){$rel = " rel='$rel'";}else{$rel='';}
	if(isset($href)){$href= " href='$href'";}else{$href='';}
	if(isset($sizes)){$sizes = " sizes='$sizes'";}else{$sizes='';}
	if(isset($media)){$media = " media='$media'";}else{$media='';}
	if(isset($crossorigin)){$crossorigin = " crossorigin='$crossorigin'";}else{unset($crossorigin);}
	
	$link_header = "<link$rel$href$ssizes$media$crossorigin />\n";
	
	return $link_header;
}


// Function to create a form
function form_head($name,$method,$action,$submit,$myfields)
{

    $form = '<blockquote><form name="'.$name.'" action="'.$action.'" method="'.$method.'">'."\n";
    
    $form .= $myfields;
    
    $form .= '<input type="submit" name="'.$submit.'" value="'.$submit.'"><br>'."\n";
    $form .= '</form></blockquote>'."\n";
    
    return $form;
    
}

//	Show Code
function showCode($show_vars, $keys, $action)
{
    
    	$show_code = "<form id='metas' method='get' action='".$action."'>\n
    	<textarea style='padding-top:12px;padding-left:0;margin-left:0;' cols='65' rows='12' id='myInput' value=''>\n";
    	
    	$counter = 0;
    	
    	foreach($show_vars as $key=>$vars)
		{
    		//echo  "\t&lt;meta name=\"$key\" content=\"$vars\"/&gt;\n";
    		if(stristr($keys[$counter],':',-1)=="name")
    		{
    			$show_code .= "\t&lt;meta name='".stristr(substr($keys[$counter],"5",-1),"/",-1)."' content='$vars'/&gt;\n";
    		}
    		elseif(stristr($keys[$counter],':',-1)=="http")
    		{
    			$show_code .= "\t&lt;meta http-equiv='".
    			substr($keys[$counter],"5",-1)."' content='$vars'/&gt;\n";
    		}elseif(stristr($keys[$counter],':',-1)=="link")
    		{
    			$show_code .= "\t&lt;link rel='".substr($keys[$counter],"5",-1)."' href='$vars'/&gt;\n";
    		}
    		elseif(stristr($keys[$counter],':',-1)=="grpn")
    		{
    			$show_code .= "\t&lt;meta name='".stristr(substr($keys[$counter],"5",-1),"/",-1)."' content='$vars'/&gt;\n";
    		}
    		elseif(stristr($keys[$counter],':',-1)=="grph")
    		{
    			$show_code .= "\t&lt;meta property='".stristr(substr($keys[$counter],"5",-1),"/",-1)."' content='$vars'/&gt;\n";
    		}
    		
    		$counter++;

		}

    	$show_code .= "</textarea>\n";
    	$show_code .= "<br><button onclick='myFunction()'>Copy Metas</button>";
    	
    	return $show_code;
    	

}

// Add Metas
function addMetas($get_fields, $meta_names='', $meta_http_equiv='', $link_header='', $opengraph_name='', $opengraph_graph='', $string_add_metas, $script_name = ''){
    		// Show individual form fields and add metas
    		$add_metas = "<h3>".$string_add_metas."</h3>\n"; 
    		$add_metas .= '<blockquote><form name="show_code" method="get" action="'.$script_name.'">'."\n";
    		$add_metas .= '<table border="0" cellspacing="0"><tr>'."\n";    		 
   		
    		foreach($get_fields as $field)
     		{  
     			$add_metas .= '<td width="200" valign="top"><b>'.ucwords($field).'</b><br/>'."\n";
     		
     			if($field=='name')
     			{
     				foreach($meta_names as $key=>$vars)
     				{
						$add_metas .= "<input type='checkbox' radiogroup='names' name='name:$key' value='$vars' /> ".ucwords($key)."<br>\n";

					}
     			}
     			elseif($field=='http')
     			{
     				foreach($meta_http_equiv as $key=>$vars)
     				{
						$add_metas .= "<input type='checkbox' radiogroup='https' name='http:$key' value='$vars' /> ".ucwords($key)."<br>\n";
					}
     			}
     			elseif($field=='link')
     			{
     				foreach($link_header as $key=>$vars)
     				{
     					$add_metas .= "<input type='checkbox' radiogroup='links' name='link:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}

     			elseif($field=='grpn')
     			{
     				foreach($opengraph_name as $key=>$vars)
     				{
     					$add_metas .= "<input type='checkbox' radiogroup='grpn' name='grpn:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}
    			
     			elseif($field=='grph')
     			{
     				foreach($opengraph_graph as $key=>$vars)
     				{
     					$add_metas .= "<input type='checkbox' radiogroup='grph' name='grph:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}
    		}
    
    	$add_metas .= '</tr></table>'."\n" . '<input type="hidden" name="fields" value="'.$get_fields.'">';
    	$add_metas .= '<input type="submit" name="add_metas" value="'.$string_add_metas.'"></form><br>'."\n";
    	$add_metas .= '</form></blockquote>'."\n";

	 	return $add_metas;
}
// End of Add Metas function

function formIndividual($fields = array())
{
	    		foreach($fields as $field)
     		{  
     			$meta_list = '<td width="200" valign="top"><b>'.ucwords($field).'</b><br/>'."\n";
     		
     			if($field=='name')
     			{
     				foreach($meta_names as $key=>$vars)
     				{
						$meta_list .= "<input type='checkbox' radiogroup='names' name='name:$key' value='$vars' /> ".ucwords($key)."<br>\n";

					}
     			}
     			elseif($field=='http')
     			{
     				foreach($meta_http_equiv as $key=>$vars)
     				{
						$meta_list .= "<input type='checkbox' radiogroup='https' name='http:$key' value='$vars' /> ".ucwords($key)."<br>\n";
					}
     			}
     			elseif($field=='link')
     			{
     				foreach($link_header as $key=>$vars)
     				{
     					$meta_list .= "<input type='checkbox' radiogroup='links' name='link:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}elseif($field=='grpn')
     			{
     				foreach($opengraph_name as $key=>$vars)
     				{
     					$meta_list .= "<input type='checkbox' radiogroup='grpn' name='grpn:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}elseif($field=='grph')
     			{
     				foreach($opengraph_graph as $key=>$vars)
     				{
     					$meta_list .= "<input type='checkbox' radiogroup='graph' name='grph:$key' value='$vars' /> ".ucwords($key)."<br>\n";

    				}
    			}
    			
    			return $meta_list;
    		}
    }
    
    
    ///////////////////////////////////////////////////////
        		/*switch($label_field){
    			case "name":
    			//echo substr($key,0,4);
    			$keys = $keys . (string) $key."/$value" .'*';
    			$newkey = str_replace("name:",'',$key);
    			$thenewkey .= metaName($newkey, $value);
    			break;

    			case "http":
    			//echo substr($key,0,4);
    			$keys = $keys . (string) $key."/$value" .'*';
    			$newkey = str_replace("http:",'',$key);
    			$thenewkey .= metaName($newkey, $value);
    			break;
    			
    			case "link":
    			//echo substr($key,0,4);
    			$keys = $keys . (string) $key."/$value" .'*';
    			$newkey = str_replace("link:",'',$key);
    			$thenewkey .= metaName($newkey, $value);
    			break;   			
    		}*/
    		

?>
