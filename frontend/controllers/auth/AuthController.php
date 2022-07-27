<?php

namespace frontend\controllers\auth;

use frontend\services\auth\AuthService;
use yii\web\Controller;

class AuthController extends Controller
{
    private $service;
    public function __construct($id, $module, AuthService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }
}