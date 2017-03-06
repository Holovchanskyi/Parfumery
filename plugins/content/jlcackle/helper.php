<?php

// no direct access
defined('_JEXEC') or die;

class plgJLCackleHelper
{
	static function cackle_auth($apiId,$userinfo){
		$timestamp = time();
		$siteApiKey = $apiId;
		if ($userinfo->guest==0){
		   $user = array(
			  'id' => $userinfo->id,
			  'name' => $userinfo->name,
			  'email' => $userinfo->email,
			  'avatar' => ''
		);
				
			$user_data = base64_encode(json_encode($user));
		}
		else{
			$user = '{}';
			$user_data = base64_encode($user);
		}
		$sign = md5($user_data . $siteApiKey . $timestamp);
		return "$user_data $sign $timestamp";
				
	}	
	
	
	function updatecomments($acountapikey,$siteapikey,$article_url){
			$db    = & JFactory::getDBO();
				$query = "SELECT TIMEVALUE FROM `#__jlcacklepro_timer`";
				$db->setQuery( $query );
				$maxcom = $db->loadObject();
				
				
				if (!isset($maxcom->TIMEVALUE)){
					$query = "INSERT INTO `#__jlcacklepro_timer` (`timevalue`) VALUE('".time()."')";
					$db->setQuery( $query );
					$db->query();
			
					plgJLCackleHelper::comment_save($acountapikey,$siteapikey,0,$article_url);
				} elseif (isset($maxcom->TIMEVALUE)){
					$timerez = time() - $maxcom->TIMEVALUE;
 					if ($timerez>300) {
						$query = "SELECT max(comment_id) as maxcom FROM `#__jlcacklepro_comment`";
						$db->setQuery( $query );
						$maxcom = $db->loadObject();
						$maxcom = $maxcom->maxcom;
						$maxcom = $maxcom>0 ? $maxcom : 0;

						plgJLCackleHelper::comment_save($acountapikey,$siteapikey,$maxcom,$article_url);						
						$query = "UPDATE `#__jlcacklepro_timer` SET `timevalue`='".time()."' WHERE `time_id`=1";
						$db->setQuery( $query );
						$db->query();
					}
				}
			return true;
	}
	
	
	
	function comment_save($accountApiKey,$siteApiKey,$cackle_last_comment=0,$article_url){
        $url="cackle.me/api/comment/list?accountApiKey=$accountApiKey&siteApiKey=$siteApiKey&id=$cackle_last_comment";
		$ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        $response = $result;
		
		$response_without_jquery = str_replace('jQuery(', '', $response);
        $response = str_replace(');', '', $response_without_jquery);
        $obj = json_decode($response,true);		
		$response = $obj;
		plgJLCackleHelper::prepare_save_comments($response,$article_url); 
	}
	
	function prepare_save_comments($response,$article_url){
        $obj = $response['comments'];
		if (count($obj)>0) {
			foreach ($obj as $comment) {
			   plgJLCackleHelper::save_comments($comment,$article_url);
			}
		}
    }
	        
	function save_comments($comment,$article_url){
		$db    = & JFactory::getDBO();
        $status;
        if (strtoupper($comment['status']) == "APPROVED"){
            $status = 1;
        }
        elseif (strtoupper($comment['status']) == "PENDING" || strtoupper($comment['status']) == "REJECTED" ){
            $status = 0;
        }
        elseif (strtoupper($comment['status']) == "SPAM" ){
            $status = "spam";
        }
        else {
            $status = "trash";
        }
    
      
        $url = $comment['channel'];
        
        if ($comment['author']!=null){
            $author_name = $comment['author']['name'];
            $author_email= $comment['author']['email'];
            $author_www = $comment['author']['www'];
            $author_avatar = $comment['author']['avatar'];
            $author_provider = $comment['author']['provider'];
            $author_anonym_name = null;
            $anonym_email = null;
        }
        else{
            $author_name = null;
            $author_email= null;
            $author_www = null;
            $author_avatar = null;
            $author_provider = null;
            $author_anonym_name = $comment['anonym']['name'];
            $anonym_email = $comment['anonym']['email'];

        }
        $gparentlocid = null;
        $comment_id = $comment['id'];
        if ($comment['parentId']) {
            $comment_parent_id = $comment['parentId'];
            $query = "select `comment_id` from `#__jlcacklepro_comment` where `user_agent`='Cackle:$comment_parent_id';";
			//echo '<pre>'.print_r($query,true).'</pre>';
			$db->setQuery( $query );
			$locid = $db->loadObject();
			//echo '<pre>'.print_r($locid->comment_id,true).'</pre>';
            $gparentlocid = $locid->comment_id;			
        }
        $commentdata = array(
                'url' => $url,
                'author_name' => $author_name,
                'author_email' => $author_email,
                'author_www' => $author_www,
                'author_avatar' => $author_avatar,
                'author_provider' => $author_provider,
                'anonym_name' => $author_anonym_name,
                'anonym_email' => $anonym_email,
                'rating' => $comment['rating'],
                'created' => strftime("%Y-%m-%d %H:%M:%S", $comment['created']/1000),
                'ip' => $comment['ip'],
                'message' =>$comment['message'],
                'status' => $status,
                'user_agent' => 'Cackle:' . $comment['id'],
                'parent_id' => $gparentlocid,
				'post_id' => $comment['url']
                
        );
		
		
        $db->SetQuery(plgJLCackleHelper::insertCackleCom("#__jlcacklepro_comment",$commentdata));
        $db->query();
		
    }
	
	
	function insertCackleCom($table,$arr){
            $str="";
            $key_str="";
            $val_str="";
            if (count($arr)>0){
				foreach($arr as $key=>$val){
					
					$key_str .= "`" . $key . "`, ";

					$val_str .= "'" . $val . "', ";
				}
			}
            $str .= "insert IGNORE into " . "`" . $table . "` " ;
            $sql_req=$str . "(" . $key_str . ") values (" . $val_str . "); ";
            $sql_req = str_replace(", )",")",$sql_req);
           //echo '<pre>'.print_r($sql_req,true).'</pre>';
           return $sql_req;
    }
	
	
    function list_jlcackle_com($post_id){
	
	   $uri = JURI::getInstance();
	   $base = $uri->toString(array('scheme', 'host', 'port'));
	   $uri = &JFactory::getURI();
	   $url = $base.$uri->toString(array('path', 'query', 'fragment'));

	   $db    = & JFactory::getDBO();
	   $querydt = "SELECT * FROM `#__jlcacklepro_comment` where `post_id` ='". $url."' and `status` = '1'";
	   
	   $db->setQuery( $querydt );
	   $list_coms = $db->loadObjectList();
	   //echo '<pre>'.print_r($url,true).'</pre>';
	   $rez='';
	   if (count($list_coms)>0){
		   foreach ($list_coms as $comment) {
			   $rez .= plgJLCackleHelper::jlcackle_html($comment);
		   }
	   }
	   return '<div id="mc-content"><ul id="cackle-comments">'.$rez.'</ul></div>';
    }
	
	function jlcackle_html($comment) {
	    $html_jlcackle = '<li id="cackle-comment-'.$comment->comment_id.'">
		<div id="cackle-comment-header-'.$comment->comment_id.'" class="cackle-comment-header">
		<cite id="cackle-cite-'.$comment->comment_id.'">';
		if($comment->author_name){
			$html_jlcackle .= '<a id="cackle-author-user-'.$comment->comment_id.'" href="'.$comment->author_www.'" target="_blank" rel="nofollow">'.$comment->author_name.'</a>';
		} else {
			$html_jlcackle .= '<span id="cackle-author-user-'.$comment->comment_id.'">'.$comment->anonym_name.'</span>';
		}
		$html_jlcackle .= '</cite></div><div id="cackle-comment-body-'.$comment->comment_id.'" class="cackle-comment-body">
		<div id="cackle-comment-message-'.$comment->comment_id.'" class="cackle-comment-message">'.$comment->message.'
		</div></div></li>';
		return $html_jlcackle;
	}

}
?>