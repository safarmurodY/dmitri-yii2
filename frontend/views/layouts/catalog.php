<?php
/** @var $this \yii\web\View */
/** @var $content string */

?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <div class="list-group">

                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=20" class="list-group-item active">Desktops (13)</a>

                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=20_26" class="list-group-item">&nbsp;&nbsp;&nbsp;- PC (0)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=20_27" class="list-group-item active">&nbsp;&nbsp;&nbsp;- Mac (1)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=18" class="list-group-item">Laptops &amp; Notebooks (5)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=25" class="list-group-item">Components (2)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=57" class="list-group-item">Tablets (1)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=17" class="list-group-item">Software (0)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=24" class="list-group-item">Phones &amp; PDAs (3)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=33" class="list-group-item">Cameras (2)</a>
                <a href="http://opencart3:8081/index.php?route=product/category&amp;path=34" class="list-group-item">MP3 Players (4)</a>
            </div>

            <div class="swiper-viewport">
                <div id="banner0" class="swiper-container swiper-container-horizontal swiper-container-fade">
                    <div class="swiper-wrapper" style="transition-duration: 300ms;">      <div class="swiper-slide swiper-slide-active" style="width: 255px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 300ms;"><a href="index.php?route=product/manufacturer/info&amp;manufacturer_id=7"><img src="http://opencart3:8081/image/cache/catalog/demo/compaq_presario-182x182.jpg" alt="HP Banner" class="img-responsive"></a></div>
                    </div>
                </div>
            </div>
            <script type="text/javascript"><!--
                $('#banner0').swiper({
                    effect: 'fade',
                    autoplay: 2500,
                    autoplayDisableOnInteraction: false
                });
                --></script>
        </aside>
        <div id="content" class="col-sm-12">
            <?= $content ?>
        </div>
    </div>

<?php $this->endContent() ?>