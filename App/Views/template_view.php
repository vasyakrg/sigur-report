<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="/favicon.ico" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Ping v1.0</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<a href="/">Report v1.0</span> <span class="cms"></span></a>
				</div>
				<div id="menu">
					<ul>
						<li class="first active"><a href="/">Главная</a></li>
						<li><a href="/about">О сайте</a></li>
<!--						<li class="last"><a href="/contacts">Контакты</a></li>-->
					</ul>
					<br class="clearfix" />
				</div>
			</div>
    <div id="page">
        <div id="sidebar">
            <div class="side-box">
                <h3>Основное меню</h3>
                <ul class="list">
                    <li class="first "><a href="/">Главная</a></li>
                    <li><a href="/about">О программе</a></li>
                    <li><a href="/search">Искать</a></li>
<!--                    <li class="last"><a href="/contacts">Контакты</a></li>-->
                </ul>
            </div>
<?php if ($sess) {?>
             <div class="side-box">
                    <h3>Личное меню</h3>
                        <ul class="list">
                            <li class="first"><a href="/profile">Профиль</a></li>
<!--                            <li><a href="/myposts">Мои посты</a></li>-->
                            <li><a href="/new">Новый узел</a></li>
                            <li><a href="/log">Лог событий</a></li>
                            <li><a href="/logout">Выйти</a></li>
                        </ul>

            </div>
					<?php }
					else { ?>
<!--            <div class="side-box">-->
<!--                        <h3>Личное меню</h3>-->
<!--                            <ul class="list">-->
<!--                                <li class="first "><a href="/auth">Авторизация</a></li>-->
<!--                                <li class="first "><a href="/register">Регистрация</a></li>-->
<!--                            </ul>-->
<!---->
<!--            </div>-->
                    <?php
                    }
                    ?>
        </div>

				<div id="content">
					<div class="box">
						<?php include 'App/Views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			<div id="page-bottom">
				<div id="page-bottom-sidebar">
					<h3>Наши контакты</h3>
					<ul class="list">
						<li class="first">+7 7212 903 063</li>
						<li>+7 7172 64 25 26</li>
						<li class="last">+7 3833 22 50 04</li>
					</ul>
				</div>
				<div id="page-bottom-content">
					<h4>Подвал</h4>
<!--					<p>ip: --><?php //echo "$this->getmyip".'123'; ?><!--</p>-->
                    <p>тут может быть ваша реклама</p>
				</div>
				<br class="clearfix" />
			</div>
		</div>
		<div id="footer">
			<a href="/">Report v1.0</a> &copy; 2019</a>
		</div>
	</body>
</html>
