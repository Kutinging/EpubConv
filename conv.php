<?php
	function getip(){
		if (!empty($_SERVER["HTTP_CLIENT_IP"])){
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else{
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		return $ip;
	}
	
	$FileName = $_POST['FileName'];
	$FileName=explode(".",$FileName)[0];
	
	$conv = shell_exec('./module/epub.sh "epubfiles/'.$FileName.'"');
	
	//echo $conv;
	
	if(strpos($conv,'Ok')>0){
			shell_exec("echo '<p>".getip()." Convert ".$FileName." at ".date("Y-m-d H:i:s")."</p>\n'>>log");
			$EPubName = $FileName."_tc.epub";
			//����U������
			header("Location: ./?f={$EPubName}#StartDownload");
	}else if(strpos($conv,'exists')>0){
		//����L���ɮ׭���
		echo "No ".$FileName.".epub exists.";
	}else{
		//������~����
		
	}
?>