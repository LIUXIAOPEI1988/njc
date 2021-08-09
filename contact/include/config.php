<?php
$parm=$_POST['parm'];
$unicode="UTF-8";
$language="Japanese";
$to = "t_shimogawa@spice-factory.co.jp";
$from = SBC_DBC(@$parm['mail'],1);
$subject = "NJCからお問合せがありました。";

$auto_flag = true;
$auto_from = "t_shimogawa@spice-factory.co.jp";
$auto_mail =SBC_DBC(@$parm['mail'],1);
$auto_subject = "【NJC】お問合せありがとうございました。";

$company=$parm['company'];
$name01=$parm['name01'];
$name02=$parm['name02'];
$tel=$parm['tel'];
$mail=$parm['mail'];
$message1=$parm['message'];

$auto_body = <<<__EOD__

$name01 $name02 様

この度は、お問い合わせいただきまして誠にありがとうございます。
後ほど担当者よりご連絡させて頂きます。

※フォームで入力された項目を自動表示しております。

ーーーーーーーーーーーーーーーーーーーーーーーーーーー

■会社名
$company

■姓
$name01

■名
$name02

■電話番号
$tel

■メールアドレス
$mail

■お問い合わせ内容
$message1


ーーーーーーーーーーーーーーーーーーーーーーーーーーー

__EOD__;
$sign = '



****************************************************
NJC
****************************************************';
?>
