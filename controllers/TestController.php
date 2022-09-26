<?php

namespace app\controllers;

use app\core\Controller;

class TestController extends Controller
{

    public function index(){
        $params = [];
        if ($request->isPost()) {
            echo "Processing post data.";
            $params[] = "foo";
        }
        // $this->setLayout('bar');  //changable layout, from views/layout/bar.php
        return $this->render('testview', $params);

    }
}