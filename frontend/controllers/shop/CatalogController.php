<?php

namespace frontend\controllers\shop;

use shop\entities\Shop\Product\Product;
use shop\forms\shop\CartForm;
use shop\forms\shop\ReviewForm;
use shop\readModels\BrandReadRepository;
use shop\readModels\CategoryReadRepository;
use shop\readModels\ProductReadRepository;
use shop\readModels\TagReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public $layout = 'catalog';
    private ProductReadRepository $products;
    private CategoryReadRepository $categories;
    private BrandReadRepository $brands;
    private TagReadRepository $tags;

    public function __construct(
        $id,
        $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
    }

    public function actionIndex()
    {
        $dataProvider = $this->products->getAll();

        $category = $this->categories->getRoot();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('Not found');
        }
        $dataProvider = $this->products->getAllByCategory($category);
        return $this->render('category', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionBrand($id)
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('Not found');
        }
        $dataProvider = $this->products->getAllByBrand($brand);
        return $this->render('brand', [
            'dataProvider' => $dataProvider,
            'brand' => $brand,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($id)
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('Not found');
        }
        $dataProvider = $this->products->getAllByTag($tag);
        return $this->render('tag', [
            'dataProvider' => $dataProvider,
            'tag' => $tag,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProduct($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('Not found');
        }
        $this->layout = 'blank';
        $orderForm = new CartForm($product);
        $reviewForm = new ReviewForm();
        return $this->render('product', [
            'product' => $product,
            'orderForm' => $orderForm,
            'reviewForm' => $reviewForm,
        ]);
    }

}