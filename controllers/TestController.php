<?php

namespace app\controllers;

use app\core\Controller;
use momik\simplemvc\core\Request;

/**
 *
 */
class TestController extends Controller
{

    /**
     * @return mixed
     */
    public function index(Request $request)
    {
        $params = [];
        if ( $request->isPost() ) {
            echo "Processing post data.";
            $params[] = "foo";
        }

        // $this->setLayout('bar');  //changable layout, from views/layout/bar.php
        return $this->render('testview', $params);
    }

}