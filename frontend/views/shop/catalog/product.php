<?php
/** @var $this \yii\web\View */
/** @var $product \shop\entities\Shop\Product\Product */
/** @var $orderForm \shop\forms\shop\CartForm */
/** @var $reviewForm \shop\forms\shop\ReviewForm */

use backend\helpers\PriceHelper;
use frontend\assets\MagnificAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerMetaTag(['name' => 'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->meta->keywords]);

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()){
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $this->title;
MagnificAsset::register($this);
?>
<div class="row">
    <div class="col-sm-8">
        <ul class="thumbnails">
            <?php foreach($product->photos as $i => $photo): ?>
                <?php if($i == 0): ?>
                    <li>
                        <a class="thumbnail" href="<?= $photo->getUploadedFileUrl('file') ?>" title="s">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>"
                                 title="<?= Html::encode($product->name) ?>" alt="<?= Html::encode($product->name) ?>">
                        </a>
                    </li>
                <?php else: ?>
                    <li class="image-additional">
                        <a class="thumbnail" href="<?= $photo->getUploadedFileUrl('file') ?>" title="s">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>"
                                 title="<?= Html::encode($product->name) ?>" alt="<?= Html::encode($product->name) ?>">
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
            <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
            <li><a href="#tab-review" data-toggle="tab">Reviews (0)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-description">
                <?= Yii::$app->formatter->asNtext($product->description) ?>
            </div>
            <div class="tab-pane" id="tab-specification">
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach($product->values as $value): ?>
                        <?php if(!empty($value->value)): ?>
                            <tr>
                                <th><?= Html::encode($value->characteristic->name) ?></th>
                                <td><?= Html::encode($value->value) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab-review">
                <div id="review">
                    <?php if(empty($product->reviews)): ?>
                        <p>There are no reviews for this product.</p>
                    <?php endif; ?>
                </div>
                <h2>Write a review</h2>
                <?php if(Yii::$app->user->isGuest): ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Please <?= Html::a('Log in', Url::to(['/auth/auth/login'])) ?> to write review
                        </div>
                    </div>
                <?php else: ?>
                    <?php $form = ActiveForm::begin() ?>
                    <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->voteList(),
                        ['prompt' => ' ---- Select ---- ']) ?>
                    <?= $form->field($reviewForm, 'text')->textInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('send', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                    </div>
                    <?php ActiveForm::end() ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="" onclick="wishlist.add('42');"
                    data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
            </button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="" onclick="compare.add('42');"
                    data-original-title="Compare this Product"><i class="fa fa-exchange"></i>
            </button>
        </div>
        <h1><?= Html::encode($product->name) ?></h1>
        <ul class="list-unstyled">
            <li>Brand: <a href="<?= Url::to(['brand', 'id' => $product->brand_id]) ?>">
                    <?= $product->brand->name ?>
                </a>
            </li>
            <li>Tags:
                <?php foreach($product->tags as $tag): ?>
                    <a href="<?= Html::encode(Url::to(['tag', 'id' => $tag->id])) ?>">
                        <?= Html::encode($tag->name) ?>
                    </a>
                <?php endforeach; ?>
            </li>
            <li>Product Code:<?= $product->code ?></li>

        </ul>
        <ul class="list-unstyled">
            <li>
                <h2><?= PriceHelper::format($product->price_new) ?></h2>
            </li>
        </ul>
        <div id="product">
            <hr>
            <h3>Available Options</h3>
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($orderForm, 'modification')->dropDownList($orderForm->modificationsList(), ['prompt' => 'select']) ?>
            <?= $form->field($orderForm, 'quantity')->textInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Add to card', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="rating">
            <p>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a> /
                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a></p>
            <hr>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url="http://opencart3:8081/index.php?route=product/product&amp;product_id=42"><a class="addthis_button_facebook_like at300b" fb:like:layout="button_count"><div class="fb-like fb_iframe_widget" data-layout="button_count" data-show_faces="false" data-share="false" data-action="like" data-width="90" data-height="25" data-font="arial" data-href="http://opencart3:8081/index.php?route=product/product&amp;product_id=42" data-send="false" style="height: 25px;" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=http%3A%2F%2Fopencart3%3A8081%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D42&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90"><span style="vertical-align: bottom; width: 90px; height: 28px;"><iframe name="f30e0d41477faac" width="90px" height="25px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v2.6/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df334834ed3dac7%26domain%3Dopencart3%26is_canvas%3Dfalse%26origin%3Dhttp%253A%252F%252Fopencart3%253A8081%252Ff26ec62ea96d898%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=http%3A%2F%2Fopencart3%3A8081%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D42&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90" style="border: none; visibility: visible; width: 90px; height: 28px;" class=""></iframe></span></div></a> <a class="addthis_button_tweet at300b"><div class="tweet_iframe_widget" style="width: 62px; height: 25px;"><span><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" style="position: static; visibility: visible; width: 73px; height: 20px;" title="Twitter Tweet Button" src="https://platform.twitter.com/widgets/tweet_button.7dae38096d06923d683a2a807172322a.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fopencart3%3A8081%2Findex.php%3Froute%3Dproduct%2Fproduct%26path%3D20%26product_id%3D42&amp;size=m&amp;text=Apple%20Cinema%2030%3A&amp;time=1666888263800&amp;type=share&amp;url=http%3A%2F%2Fopencart3%3A8081%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D42%23.Y1qyRNy8GIc.twitter" data-url="http://opencart3:8081/index.php?route=product/product&amp;product_id=42#.Y1qyRNy8GIc.twitter"></iframe></span></div></a> <a class="addthis_button_pinterest_pinit at300b"></a> <a class="addthis_counter addthis_pill_style" href="#" style="display: inline-block;"><a class="atc_s addthis_button_compact">Share<span></span></a><a class="addthis_button_expanded" target="_blank" title="More" href="#"></a></a><div class="atclear"></div></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
</div>
<h3>Related Products</h3>
<div class="row">
    <div class="col-xs-6 col-sm-3">
        <div class="product-thumb transition">
            <div class="image"><a href="http://opencart3:8081/index.php?route=product/product&amp;product_id=40"><img src="http://opencart3:8081/image/cache/catalog/demo/iphone_1-200x200.jpg" alt="iPhone" title="iPhone" class="img-responsive"></a></div>
            <div class="caption">
                <h4><a href="http://opencart3:8081/index.php?route=product/product&amp;product_id=40">iPhone</a></h4>
                <p>iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a name o..</p>
                <p class="price">                 $123.20
                    <span class="price-tax">Ex Tax: $101.00</span>  </p>
            </div>
            <div class="button-group">
                <button type="button" onclick="cart.add('40', '1');"><span class="hidden-xs hidden-sm hidden-md">Add to Cart</span> <i class="fa fa-shopping-cart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('40');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('40');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="product-thumb transition">
            <div class="image"><a href="http://opencart3:8081/index.php?route=product/product&amp;product_id=41"><img src="http://opencart3:8081/image/cache/catalog/demo/imac_1-200x200.jpg" alt="iMac" title="iMac" class="img-responsive"></a></div>
            <div class="caption">
                <h4><a href="http://opencart3:8081/index.php?route=product/product&amp;product_id=41">iMac</a></h4>
                <p>Just when you thought iMac had everything, now there´s even more. More powerful Intel Core 2 Duo pro..</p>
                <p class="price">                 $122.00
                    <span class="price-tax">Ex Tax: $100.00</span>  </p>
            </div>
            <div class="button-group">
                <button type="button" onclick="cart.add('41', '1');"><span class="hidden-xs hidden-sm hidden-md">Add to Cart</span> <i class="fa fa-shopping-cart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('41');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('41');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // $('#review').delegate('.pagination a', 'click', function(e) {
    //     e.preventDefault();
    //
    //     $('#review').fadeOut('slow');
    //
    //     $('#review').load(this.href);
    //
    //     $('#review').fadeIn('slow');
    // });
    //
    // $('#review').load('index.php?route=product/product/review&product_id=42');
    //
    // $('#button-review').on('click', function() {
    //     $.ajax({
    //         url: 'index.php?route=product/product/write&product_id=42',
    //         type: 'post',
    //         dataType: 'json',
    //         data: $("#form-review").serialize(),
    //         beforeSend: function() {
    //             $('#button-review').button('loading');
    //         },
    //         complete: function() {
    //             $('#button-review').button('reset');
    //         },
    //         success: function(json) {
    //             $('.alert-dismissible').remove();
    //
    //             if (json['error']) {
    //                 $('#review').after('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
    //             }
    //
    //             if (json['success']) {
    //                 $('#review').after('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
    //
    //                 $('input[name=\'name\']').val('');
    //                 $('textarea[name=\'text\']').val('');
    //                 $('input[name=\'rating\']:checked').prop('checked', false);
    //             }
    //         }
    //     });
    // });
    // $(document).ready(function() {
    // $('.thumbnails').magnificPopup({
    //     type:'image',
    //     delegate: 'a',
    //     gallery: {
    //         enabled: true
    //     }
    // });
    // });

</script>
<?php
$js = <<<JS
    $(function() {
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    });
JS;
$this->registerJs($js);