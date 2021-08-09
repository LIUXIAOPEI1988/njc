<?php
include_once('include/functions.php');
define("FMAIL_FORM", 0);
define("FMAIL_THANK", 1);
define("FMAIL_ERROR", 2);
$returnCode='';

$action = @$_POST['action'];
$page = FMAIL_FORM;
$error_msg = array();
$error_flag = false;

$error_company = '';
$error_name01 = '';
$error_name02 = '';
$error_tel = '';
$error_mail = '';
$error_acceptance = '';

if ($action == '') {
	$page = FMAIL_FORM;
} elseif ($action == 'action') {

	$parm = @$_POST['parm'];

	if (@$parm['company'] == '') {
		$error_flag = true;
		$error_company = '※会社名を入力してください。';
	}

	if (@$parm['name01'] == '') {
		$error_flag = true;
		$error_name01 = '※姓を入力してください。';
  	}
	if (@$parm['name02'] == '') {
		$error_flag = true;
		$error_name02 = '※名を入力してください。';
  	}
  
	if (@$parm['tel'] == '') {
		$error_flag = true;
		$error_tel = '※電話番号を入力してください。';
	} elseif (!is_number(@$parm['tel'])) {
		$error_flag = true;
		$error_tel = '※電話番号は正しくありません。';
	}

	if (@$parm['mail'] == '') {
		$error_flag = true;
		$error_mail = '※メールアドレスを入力してください。';
	} elseif (!is_email(@$parm['mail'])) {
		$error_flag = true;
		$error_mail = '※メールアドレスは正しくありません。';
	}

	if (@$parm['acceptance'] == '') {
		$error_flag = true;
		$error_acceptance = '※同意の上チェックをしてください。';
	}

	if ($error_flag) {
		$page = FMAIL_FORM;
	} else {
		error_reporting(0);
		require_once 'include/config.php';
		mb_language($language);
		mb_internal_encoding($unicode);

		if (!@$_POST) {
			header("location:index.php");
			exit();
		}

		$page = FMAIL_THANK;
		$parm = $_POST['parm'];

		$message['会社名'] = '
' . $parm['company'] . '
';
		$message['お名前'] = '
' . $parm['name01'] . ' ' . $parm['name02'] . '
';
		$message['電話番号'] = '
' . $parm['tel'] . '
';
		$message['電話番号メールアドレス'] = '
' . $parm['mail'] . '
';
		$message['お問い合わせ内容'] = '
' . $parm['message'] . '
'; 	 
		include("include/sendmail.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title>NJC</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../common/css/import.css" media="all" />
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all" />


</head>
<body>
<div id="wrapper">
	
	<header>
		<div id="header">
			<div id="headerin">
				<h1 id="headerlogo" class="op">
					<a href="../index.html">
						<img src="../common/img/logo_header.svg" alt="NJC">
					</a>
				</h1>
				<nav id="gnavi">
					<ul>
						<li><a href="../index.html#anchor01" class="">NJCが考える「DX」とは</a></li>
						<li><a href="../index.html#anchor02" class="">実現に向けたステップ</a></li>
						<li><a href="../index.html#anchor03" class="">ケーススタディ</a></li>
						<li><a href="../index.html#anchor04" class="">セミナー情報</a></li>
					</ul>
					<a href="../contact/" class="contact_btn ffM">
						<img src="../common/img/icon_mail.svg" alt="CONTACT">
						<span>CONTACT</span>
					</a>
				</nav>
			</div><!-- /.headerIn -->
			<p class="navbartoggle visiblets" data-target=".navbarcollapse">
				<span></span>
				<span></span>
				<span></span>
			</p>	
			<nav class="navbarcollapse">
				<ul>
					<li><a href="../index.html#anchor01" class="">NJCが考える「DX」とは</a></li>
					<li><a href="../index.html#anchor02" class="">実現に向けたステップ</a></li>
					<li><a href="../index.html#anchor03" class="">ケーススタディ</a></li>
					<li><a href="../index.html#anchor04" class="">セミナー情報</a></li>
				</ul>
				<p class="btn">
					<a href="../contact/" class="contact_btn ffM">
						<img src="../common/img/icon_mail.svg" alt="CONTACT">
						<span>CONTACT</span>
					</a>
				</p>
			</nav><!-- /.navbar-collapse -->
		</div><!-- /#header -->
	</header>
	<article class="contact_index">
		<section class="contact_form" id="form">
			<div class="inner">
				<?php
					switch ($page) {
					case FMAIL_FORM:
				?>
				<form name="form01" action="#form" method="post">
					<input type="hidden" name="action" value="action">
					<div class="comtit01 center">
						<h2 class="hd01"><span class="roboto">Contact</span>お問い合わせ</h2>
						<p>詳しく話しを聞きたいなど、お気軽にお問い合わせください。 </p>
					</div>
					<div class="box">
						<div class="item">
							<input type="text" name="parm[company]" value="<?php echo @$parm['company']; ?>" placeholder="会社名">
							<p class="error"><?php echo $error_company; ?></p>
						</div>
						<div class="item col-2">
							<div>
								<input type="text" name="parm[name01]" value="<?php echo @$parm['name01']; ?>" placeholder="姓">
								<p class="error"><?php echo $error_name01; ?></p>
							</div>
							<div>
								<input type="text" name="parm[name02]" value="<?php echo @$parm['name02']; ?>" placeholder="名">
								<p class="error"><?php echo $error_name02; ?></p>
							</div>
						</div>
						<div class="item">
							<input type="text" name="parm[tel]" value="<?php echo @$parm['tel']; ?>" placeholder="電話">
							<p class="error"><?php echo $error_tel; ?></p>
						</div>
						<div class="item">
							<input type="text" name="parm[mail]" value="<?php echo @$parm['mail']; ?>" placeholder="E-mail">
							<p class="error"><?php echo $error_mail; ?></p>
						</div>
						<div class="item">
							<textarea name="parm[message]" placeholder="お問い合わせ内容（任意）"><?php echo @$parm['message']; ?></textarea>
						</div>
					</div>
					<p class="agree"><label for="checkbox"><input type="checkbox" id="checkbox" name="acceptance[]" value="同意する"><span>
					当社の「個人情報の取り扱いに関するご案内」 の利用目的に同意します。</span></label></p>
					<input type="hidden" name="parm[acceptance]" value="">
					<p class="error"><?php echo $error_acceptance; ?></p>
					<p class="link">取得した個人情報の当社における利用範囲&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;日本事務器株式会社 <br>事業戦略本部 個人情報の部店責任者&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;事業戦略本部 戦略企画部長 TEL. 050-3000-1510</p>
					<p class="submit"><button type="submit">送信する</button></p>
					<?php
						if($returnCode == FMAIL_ERROR){
							echo $err;
						}
					?>
				</form>
				<?php
					break;
					case FMAIL_THANK:
				?>
				<script type="text/javascript">
					window.location.href='thanks.html';
				</script>
				<?php
					break;}
				?>
			</div>
		</section>
	</article>
	<footer>
		<div id="footer">
			<div class="inner">
				<a href="#">会社概要</a><a href="#">サイトのご利用条件</a><a href="#">個人情報保護方針</a><a href="#">情報セキュリティ基本方針</a><a href="#">個人情報の取り扱いに関するご案内環境方針</a>
			</div><!-- /.inner -->
			<p id="copyright">Copyright © 2021 Nippon Jimuki Co.,Ltd. All rights reserved.</p>
		</div><!-- /#footer -->
	</footer>
</div><!-- /#wrapper -->

<script type="text/javascript" src="../common/js/jquery.min.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="../common/js/jquery.matchHeight-min.js"></script>
<script>
$(function(){
	$('input[name="acceptance[]"]').on('click',function(){
		var acceptance=[];
		$('input[name="parm[acceptance]"]').val('');
		$('input[name="acceptance[]"]:checked').each(function(){
			acceptance.push($(this).val());
			$('input[name="parm[acceptance]"]').val(acceptance);
		});
	});
})
</script>
</body>
</html>
