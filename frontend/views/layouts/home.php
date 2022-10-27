<?php
/** @var $this \yii\web\View */
/** @var $content string */

use frontend\widgets\FeaturedProductsWidget;

?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-12">
        <div class="swiper-viewport">
            <div id="slideshow0" class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide text-center"><a
                            href="index.php?route=product/product&amp;path=57&amp;product_id=49"><img
                                src="http://opencart3:8081/image/cache/catalog/demo/banners/iPhone6-1140x380.jpg"
                                alt="iPhone 6" class="img-responsive"/></a></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/banners/MacBookAir-1140x380.jpg"
                            alt="MacBookAir" class="img-responsive"/></div>
                </div>
            </div>
            <div class="swiper-pagination slideshow0"></div>
            <div class="swiper-pager">
                <div class="swiper-button-next" id="swiper-button-next-slide"></div>
                <div class="swiper-button-prev" id="swiper-button-prev-slide"></div>
            </div>
        </div>

        <h3>Featured</h3>
        <?= FeaturedProductsWidget::widget([
            'limit' => 4
        ]) ?>

        <div class="swiper-viewport">
            <div id="carousel0" class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/nfl-130x100.png"
                            alt="NFL" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/redbull-130x100.png"
                            alt="RedBull" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/sony-130x100.png"
                            alt="Sony" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/cocacola-130x100.png"
                            alt="Coca Cola" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/burgerking-130x100.png"
                            alt="Burger King" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/canon-130x100.png"
                            alt="Canon" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/harley-130x100.png"
                            alt="Harley Davidson" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/dell-130x100.png"
                            alt="Dell" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/disney-130x100.png"
                            alt="Disney" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/starbucks-130x100.png"
                            alt="Starbucks" class="img-responsive"/></div>
                    <div class="swiper-slide text-center"><img
                            src="http://opencart3:8081/image/cache/catalog/demo/manufacturer/nintendo-130x100.png"
                            alt="Nintendo" class="img-responsive"/></div>
                </div>
            </div>
            <div class="swiper-pagination carousel0"></div>
            <div class="swiper-pager">
                <div class="swiper-button-next" id="swiper-button-next-id"></div>
                <div class="swiper-button-prev" id="swiper-button-prev-id"></div>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>
<?php
$js = <<<JS
$('#carousel0').swiper({
    mode: 'horizontal',
    slidesPerView: 5,
    pagination: '.carousel0',
    paginationClickable: true,
    nextButton: '#swiper-button-next-id',
    prevButton: '#swiper-button-prev-id',
    autoplay: 2500,
    loop: true
});

$('#slideshow0').swiper({
    mode: 'horizontal',
    slidesPerView: 1,
    pagination: '.slideshow0',
    paginationClickable: true,
    nextButton: '#swiper-button-next-slide',
    prevButton: '#swiper-button-prev-slide',
    spaceBetween: 30,
    autoplay: 2500,
    autoplayDisableOnInteraction: true,
    loop: true
});
JS;
$this->registerJs($js);?>

<?php $this->endContent() ?>
