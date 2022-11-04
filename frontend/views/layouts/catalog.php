<?php
/** @var $this \yii\web\View */
/** @var $content string */

use frontend\widgets\CategoriesWidget;

?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <?= CategoriesWidget::widget([
                'active' => $this->params['active_category']??null,
            ]) ?>

            <!--<div class="swiper-viewport">
                <div id="banner0" class="swiper-container swiper-container-horizontal swiper-container-fade">
                    <div class="swiper-wrapper" style="transition-duration: 300ms;">
                        <div class="swiper-slide swiper-slide-active" style="width: 255px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 300ms;">
                            <a href="index.php?route=product/manufacturer/info&amp;manufacturer_id=7">
                                <img src="http://opencart3:8081/image/cache/catalog/demo/compaq_presario-182x182.jpg" alt="HP Banner" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#banner0').swiper({
                    effect: 'fade',
                    autoplay: 2500,
                    autoplayDisableOnInteraction: false
                });
                </script>-->
        </aside>
        <div id="content" class="col-sm-9">
            <?= $content ?>
        </div>
    </div>

<?php $this->endContent() ?>