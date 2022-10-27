<?php
/** @var $this \yii\web\View */
/** @var $content string */

?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <div id="content" class="col-sm-9">
            <?= $content ?>
        </div>

        <aside id="column-right" class="col-sm-3 hidden-xs">
            <div class="list-group">
                <a href="http://opencart3:8081/index.php?route=account/login" class="list-group-item">Login</a>
                <a href="http://opencart3:8081/index.php?route=account/register" class="list-group-item">Register</a>
                <a href="http://opencart3:8081/index.php?route=account/forgotten" class="list-group-item">Forgotten Password</a>
                <a href="http://opencart3:8081/index.php?route=account/account" class="list-group-item">My Account</a>
                <a href="http://opencart3:8081/index.php?route=account/address" class="list-group-item">Address Book</a>
                <a href="http://opencart3:8081/index.php?route=account/wishlist" class="list-group-item">Wish List</a>
                <a href="http://opencart3:8081/index.php?route=account/order" class="list-group-item">Order History</a>
                <a href="http://opencart3:8081/index.php?route=account/download" class="list-group-item">Downloads</a>
                <a href="http://opencart3:8081/index.php?route=account/recurring" class="list-group-item">Recurring payments</a>
                <a href="http://opencart3:8081/index.php?route=account/reward" class="list-group-item">Reward Points</a>
                <a href="http://opencart3:8081/index.php?route=account/return" class="list-group-item">Returns</a>
                <a href="http://opencart3:8081/index.php?route=account/transaction" class="list-group-item">Transactions</a>
                <a href="http://opencart3:8081/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>
            </div>

        </aside>

    </div>

<?php $this->endContent() ?>