<?php
// メールの送信
$mail = '';
mb_language('uni');
mb_internal_encoding("UTF-8");
$mail .= "件名：NJCからお問合せがありました。\n";
$mail .= "本文：\n";
$mail .= "担当者は対応してください。\n";
$mail .= "\n";
$mail .= "■お問い合わせ内容\n";
$mail .= "\n";
$mail .= "ーーーーーーーーーーーーーーーーーーーーーーーーーーー\n";
$mail .= "\n";
foreach ($message as $key => $value ) {
 $value = preg_replace("/\x0D\x0A|\x0D|\x0A/", "\n", $value);
 $value = stripslashes($value);
 $mail .= "■{$key}：".$value."\n";
}
$mail .= "ーーーーーーーーーーーーーーーーーーーーーーーーーーー\n";
$auto_body .= $sign;
$auto_content=$mail;
$mail .= "\n";
$mail .= "------------------------------------------------------------\n";
$mail .= "■投稿日時： ".date("r")."\n";
$mail .= "■ブラウザ： ".$_SERVER['HTTP_USER_AGENT']."\n";
$mail .= "■IPアドレス： ".$_SERVER['REMOTE_ADDR']."\n";
$mail .= "■ホスト： ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."\n";
$mail .= "------------------------------------------------------------\n";
$mail = wordwrap($mail, 60, "\n");
$x_headers = array();
$x_headers[] = "From: {$auto_mail}";

if(!is_null($cc)){
	$x_headers .= "\n";
	$x_headers .= "Cc: {$cc}";
}

if (is_email($auto_mail)) {
	if(mb_send_mail($to, $subject, $mail, join("\n", $x_headers))){
	//if(mail($to, $subject, $mail , join("\n", $x_headers))){
		$returnCode = FMAIL_THANKS;
	} else {
		$err .= "<p style='color: red;'>※送信に失敗しました。お手数ですが、時間を置いて後ほどもう一度お申込みください。</p>";
		$returnCode = FMAIL_ERROR;
		$page=FMAIL_FORM;
	}
	$header = 'From: '.mb_encode_mimeheader("", 'UTF-8').' <'.$auto_from.'>'."\n";
	//$header = "From: {$auto_from}";
	// 確認メールの送信
	if($auto_flag){
		$auto_body = preg_replace("/\x0D\x0A|\x0D|\x0A/", "\n", $auto_body);
		$auto_body = str_replace('[auto_body]',$auto_content,$auto_body);
		mb_send_mail($auto_mail, $auto_subject, $auto_body, $header);
	}
}
?>