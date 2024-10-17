<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use common\models\Setting;

$user = Yii::$app->user;
?>

<header id="site-header" class="site-header mobile-header-blue header-style-1">
      <div id="header_topbar" class="header-topbar md-hidden sm-hidden "> <!-- .clearfix -->
        <div class="container-custom">
          <div class="my-row">
            <div>
              <!-- Info on Topbar -->
              <ul class="topbar-left">
                <li><a target="_blank" onclick="ym(85084891,'reachGoal','CLICK_ON_ADRESS')" href="https://yandex.ru/maps/-/CCQ~aVhHlD">
                  <i class="icon ion-md-pin"></i><?= Setting::getAdress() ?>
                </a></li>
                <li><a onclick="ym(85084891,'reachGoal','CLICK_ON_PHONE')" href="tel:+<?=Setting::getPhoneOnlyNumber() ?>"><i class="icon ion-md-call"></i><?= Setting::getPhone() ?></a></li>
                <li><a href="mailto:<?= Setting::getEmail() ?>"><i class="icon ion-md-mail"></i><?= Setting::getEmail() ?></a></li>
              </ul>
            </div>
            <!-- Info on topbar close -->
            <div>
              <ul class="topbar-right">

                <li class="toggle_search topbar-search">
                  <form action="/search">
                  <div class="d-flex">
                    <?= Html::textInput('q', '', ['class' => 'form-control']) ?>
                    <button class="pt-1 ms-1 bg-transparent border-0"><i class="icon ion-md-search"></i></button>
                  </div>
                  </form>
                </li>
                <li class="topbar-search">
                  <a href="/cart">
                    <span class="icon ion-md-basket">
                      <span id="cartTotalNum" class="fs-09" style="vertical-align: middle;">

                     <?php if($count = Yii::$app->cart->getItemsCount()): ?>
                      (<span class="val"><?= $count ?></span>)
                     <?php endif; ?>

                      </span>
                    </span>
                  </a>
                </li>
                <li>
                <?php if ($user->isGuest): ?>
                  <a href="/site/login">Login</a>
                <?php else: ?>
                  <a href="/backend/site/index" target="_blank">admin</a>
                <?php endif; ?>

                </li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div id="sky">
      <img src="/i/header.png" loading="lazy" alt="header" title="header">
      <div class="lozung-block">
        <span>Поиск, подбор, поставка и техническая<br>поддержка газовых датчиков и сенсоров</span>
      </div>
      <div class="logo-block">
        <div class="logo-brand">
          <a href="/">
            <img src="/i/logo.svg" loading="lazy" alt="Газсенсор: ГАЗОВЫЕ ДАТЧИКИ И СЕНСОРЫ" title="Газсенсор: ГАЗОВЫЕ ДАТЧИКИ И СЕНСОРЫ">
          </a>
        </div>
      </div>
      <div class="main-navigation">
        <ul id="primary-menu" class="menu">
            <li class="menu-item current-menu-ancestor current-menu-parent">
                <a href="/">Главная</a>
            </li>
            <li class="menu-item">
                <a href="/catalog">Каталог</a>
            </li>
            <li class="menu-item">
                <a href="/applications">Применение</a>
            </li>
            <li class="menu-item">
                <a href="/page/accessories">Аксессуары</a>
            </li>
            <li class="menu-item">
                <a href="/manufacture">Производители</a>
            </li>
            <li class="menu-item">
                <a href="/converter">Конвертер</a>
            </li>
            <li class="menu-item">
                <a href="/page/contacts">Контакты </a>
            </li>
        </ul>
        <a style="display: none" href="#" class="btn btn-primary">Вопрос<i class="icon ion-md-paper-plane"></i></a>
      </div>
    </div>
    <div id="sky-wrap" style="background-position: 831.871em 0px;"></div>

    <div class="collapse searchbar" id="searchbar">
      <div class="search-area">
        <div class="container">
          <div class="row">
              <form action="/products" method="post">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="input-group">
                <input type="text" class="form-control" name="titleSearch" placeholder="Поиск...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Поиск</button>
                </span>

              </div>
              <!-- /input-group -->
            </div>
                  </form>
            <!-- /.col-lg-6 -->
          </div>
        </div>
      </div>
    </div>

    <!-- Main header start -->

    <!-- Mobile header start -->
    <div class="mobile-header">
      <div class="container-custom">
        <div class="row">
          <div class="col-6">
            <div class="logo-brand-mobile">
              <a href="/"><img src="/i/logo.svg" loading="lazy" alt="industris" title="industris" /></a>
            </div>
          </div>
          <div class="col-6">
            <div id="mmenu_toggle" class="">
              <button></button>
            </div>
          </div>
          <div class="col-12">
            <div class="mobile-nav" style="display: none;">
              <ul id="primary-menu-mobile" class="mobile-menu">
                  <li class="menu-item  current-menu-ancestor current-menu-parent"><a href="/">Главная</a></li>
                  <li class="menu-item"><a href="/catalog">Каталог</a></li>
                  <li class="menu-item"><a href="/applications">Применение</a></li>
                  <li class="menu-item"><a href="/page/accessories">Аксессуары</a></li>
                  <li class="menu-item"><a href="/manufacture">Производители</a></li>
                  <li class="menu-item"><a href="/converter">Конвертер</a></li>
                  <li class="menu-item"><a href="/page/contacts">Контакты </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
