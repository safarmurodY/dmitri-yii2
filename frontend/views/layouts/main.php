<?php

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/** @var $this \yii\web\View */
/** @var $content string */


AppAsset::register($this);
\frontend\assets\SwiperAsset::register($this)
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical">
        <link href="<?= Yii::getAlias('@web/image/catalog/cart.png') ?>" rel="icon">
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <nav id="top">
        <div class="container">
            <div class="pull-left">
                <form action="http://opencart3:8081/index.php?route=common/currency/currency" method="post"
                      enctype="multipart/form-data" id="form-currency">
                    <div class="btn-group">
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown"><strong>$</strong> <span
                                    class="hidden-xs hidden-sm hidden-md">Currency</span>&nbsp;<i
                                    class="fa fa-caret-down"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro
                                </button>
                            </li>
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound
                                    Sterling
                                </button>
                            </li>
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US
                                    Dollar
                                </button>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="code" value=""/>
                    <input type="hidden" name="redirect" value="http://opencart3:8081/index.php?route=common/home"/>
                </form>
            </div>


            <div id="top-links" class="nav pull-right">
                <ul class="list-inline">
                    <li><a href="http://opencart3:8081/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                        <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                    <li class="dropdown"><a href="http://opencart3:8081/index.php?route=account/account"
                                            title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-user"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php if(Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::to(['/auth/signup/request']) ?>">Register</a></li>
                                <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Login</a></li>
                            <?php else: ?>
                                <li><a href="<?= Html::encode(Url::to(['/site/logout'])) ?>"
                                       data-method="post">Logout</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                    <li><a href="http://opencart3:8081/index.php?route=account/wishlist" id="wishlist-total"
                           title="Wish List (0)"><i class="fa fa-heart"></i> <span
                                    class="hidden-xs hidden-sm hidden-md">Wish List (0)</span></a></li>
                    <li><a href="http://opencart3:8081/index.php?route=checkout/cart" title="Shopping Cart"><i
                                    class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span></a>
                    </li>
                    <li><a href="http://opencart3:8081/index.php?route=checkout/checkout" title="Checkout"><i
                                    class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div id="logo">
                        <h1><a href="<?= Url::home() ?>">Your Store</a></h1>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div id="search" class="input-group">
                        <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg"/>
                        <span class="input-group-btn">
                         <button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="cart" class="btn-group btn-block">
                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..."
                                class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i
                                    class="fa fa-shopping-cart"></i> <span id="cart-total">0 item(s) - $0.00</span>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <p class="text-center">Your shopping cart is empty!</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <?php
        NavBar::begin([
//            'brandLabel' => Yii::$app->name,
//            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'screenReaderToggleText' => 'Menu',
                'class' => 'navbar',
                'id' => 'menu',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/about']],
            ['label' => 'Contact', 'url' => ['/contact']],
            ['label' => 'Catalog', 'url' => ['/shop/catalog']],
        ];

        echo Nav::widget([          //nav navbar-nav
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

    </div>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Information</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="http://opencart3:8081/index.php?route=information/information&amp;information_id=4">About
                                Us</a></li>
                        <li>
                            <a href="http://opencart3:8081/index.php?route=information/information&amp;information_id=6">Delivery
                                Information</a></li>
                        <li>
                            <a href="http://opencart3:8081/index.php?route=information/information&amp;information_id=3">Privacy
                                Policy</a></li>
                        <li>
                            <a href="http://opencart3:8081/index.php?route=information/information&amp;information_id=5">Terms
                                &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://opencart3:8081/index.php?route=information/contact">Contact Us</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=account/return/add">Returns</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=information/sitemap">Site Map</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Extras</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://opencart3:8081/index.php?route=product/manufacturer">Brands</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=account/voucher">Gift Certificates</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=affiliate/login">Affiliate</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=product/special">Specials</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>My Account</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://opencart3:8081/index.php?route=account/account">My Account</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=account/order">Order History</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=account/wishlist">Wish List</a></li>
                        <li><a href="http://opencart3:8081/index.php?route=account/newsletter">Newsletter</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p>Powered By <a href="http://www.opencart.com">OpenCart</a><br/> Your Store &copy; 2022</p>
        </div>
    </footer>

    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage();