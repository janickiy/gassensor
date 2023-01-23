<?php

use common\models\Setting;

?>

<footer id="site-footer" class="site-footer bg-footer">
<div class="main-footer">
  <div class="container-custom">
    <div class="row">

      <div class="col-md-3 col-sm-6">
        <div class="widget-footer">
          <div id="media_image-1" class="widget widget_media_image">
            <a href="/"><img loading="lazy" src="/i/logo-footer.svg" alt="Газсенсор: ГАЗОВЫЕ ДАТЧИКИ И СЕНСОРЫ"></a>
          </div>
        </div>
      </div>
      <!-- end col-lg-3 -->

        <div class="col-md-3 col-sm-6">
          <div class="widget-footer">
            <div id="custom_html-2" class="widget_text widget widget_custom_html padding-left">
              <div class="textwidget custom-html-widget">
                <ul>
                  <li><a href="/">Главная</a></li>
                  <li><a href="/catalog">Газовые датчики и аксессуары</a></li>
                  <li><a href="/catalog">Каталог</a></li>
                  <li><a href="/page/accessories">Аксессуары</a></li>
                </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-lg-3 -->

          <div class="col-md-3 col-sm-6">
            <div class="widget-footer">
              <div id="custom_html-3" class="widget_text widge widget-footer widget_custom_html padding-left">
                <div class="textwidget custom-html-widget">
                  <ul>
                    <li><a href="/">Новости</a></li>
                    <li><a href="/page/vacancy">Вакансии</a></li>
                    <li><a href="/page/contacts">Контакты</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-lg-3 -->

        <div class="col-md-3 col-sm-6">
          <div class="widget-footer">

          </div>
        </div>
        <!-- end col-lg-3 -->

      </div>
    </div>
  </div>
  <!-- .main-footer -->
  <div class="footer-bottom">
    <div class="container-custom">
      <div class="row">
        <div class="col-md-12 flex-end space-beetween">
          <div>
            <ul class="topbar-left">
              <li><a target="_blank" onclick="ym(85084891,'reachGoal','CLICK_ON_ADRESS_FOOTER')" href="https://yandex.ru/maps/-/CCQ~aVhHlD">
                <i class="icon ion-md-pin"></i><?= Setting::getAdress() ?>
              </a></li>
              <li><a onclick="ym(85084891,'reachGoal','CLICK_ON_PHONE')" href="tel:+<?=Setting::getPhoneOnlyNumber() ?>"><i class="icon ion-md-call"></i><?= Setting::getPhone() ?></a></li>
              <li><a href="mailto:<?= Setting::getEmail() ?>"><i class="icon ion-md-mail"></i><?= Setting::getEmail() ?></a></li>
            </ul>
            <div id="custom_html-1" class="widget_text widget widget_custom_html" style="padding: 10px 0;">
              <div class="textwidget custom-html-widget">
                <p>© 2011-<?= date('Y') ?> Газсенсор. Все права защищены.</p>
              </div>
            </div>
          </div>
          <a id="back-to-top" href="#" class="btn btn-back-to-top pull-right">Наверх<i class="icon ion-ios-arrow-dropup-circle"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- .copyright-footer -->
</footer>
