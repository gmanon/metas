<?php
/**
 ** Class @Meta
 **
 */
 
 class Metas{
     
    private $name = array(
							"generator"=>"HTML-Editor",
							"abstract"=>"The name of this page",
							"reply-to"=>"gmanon@mail.com",
							"rating"=>"general | mature | restricted | 14 years | safe for kids",
							"date"=>"2018-08-06T21:17:13-0400",
							"identifier-url"=>"http://localhost",
							"author"=>"Guillermina Gonjon", 
							"revisit-after"=>"15 days",
							"language"=>"en",
							"copyright"=>"Open Source",
							"keywords"=>"The maxim, the best, we are",
							"description"=>"This is the best website you could ever visit",
							"ROBOTS"=>"NOINDEX, NOFOLLOW"
    );
    
    private $link = "rel, href, sizes, edia, crossorigin";
    
    public function metaName($meta_name, $meta_content="")
    {
        $generate_meta_field = "<label name='$meta_name'><strong>".ucwords($meta_name)."</strong></label><br>\n";
        $generate_meta_field .= 
    								"<label name='content'>Content</label>: &nbsp;&nbsp;
    								<input type='text' name='$meta_name' value='". $_GET[$meta_name]."' />
    								<span style='color:#999;'><em> $meta_content</em></span><br><br>\n";
    
        return $generate_meta_field;
    
    }
    
    private function setName()
    {
        
    }

    public function setLink($rel, $href='', $sizes='', $media='', $crossorigin)
    {

    }
    
    public function getName()
    {
    
    } 
    
    public function getLink()
    {
    
    }    
}
?>