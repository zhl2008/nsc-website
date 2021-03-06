<?php
/*
用于发送邮件（邮箱认证，密码重置，消息提醒等功能）
	*/
require_once("./include/email.class.php");
require("./config/email.conf.php");

function mail_core($smtpemailto,$mailtitle,$mailcontent,$mailtype){
	$smtp = new smtp($GLOBALS["smtpserver"],$GLOBALS["smtpserverport"],true,$GLOBALS["smtpuser"],$GLOBALS["smtppass"]);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $GLOBALS["smtpusermail"], $mailtitle, $mailcontent, $mailtype);
	return $state;
}

function send_verified_code($email,$content){
	$state=mail_core($email,"verify your email",$content,"HTML");
	//echo $state;
	if($state){
		echo '<body><form method="post" action="verify_email.php">user email :<input type="text" name="email" /><br>verify code :<input type="text" name="code" /><br><input type="submit" name="Submit" text="Register"/></form></body>';
		/*成功发送邮件后调用相关函数*/
	}
}
?>