<?php

/** @var $this \yii\web\View */

/** @var $products \shop\entities\Shop\Product\Product[] */

use backend\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="row">
    <?php foreach ($products as $product): ?>
        <?php $url = Url::to(['/shop/catalog/product', 'id' => $product->id]) ?>
        <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="product-thumb transition">
                <?php if ($product->mainPhoto): ?>
                    <div class="image">
                        <a href="<?= Html::encode($url) ?>">
                            <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>"
                                 alt="<?= Html::encode($product->name) ?>"
                                 title="<?= Html::encode($product->name) ?>" class="img-responsive"/></a>
                    </div>
                <?php endif; ?>
                <div class="caption">
                    <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($product->name) ?></a>
                    </h4>
                    <p><?= Html::encode(StringHelper::truncateWords(strip_tags($product->description), 20)) ?></p>
                    <p class="price">
                        <span class="price-new">$<?= PriceHelper::format($product->price_new) ?></span>
                        <?php if ($product->price_old): ?>
                            <span class="price-old">$<?= PriceHelper::format($product->price_old) ?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="button-group">
                    <button type="button" onclick="cart.add('<?= $product->id ?>');"><i class="fa fa-shopping-cart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                    <button type="button" data-toggle="tooltip" title="Add to Wish List"
                            onclick="wishlist.add('<?= $product->id ?>');"><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Compare this Product"
                            onclick="compare.add('<?= $product->id ?>');"><i class="fa fa-exchange"></i></button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
