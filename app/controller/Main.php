<?php

namespace App\Controller;

use App\Model\Main as Model;
use App\Model\PageAdd as ModelPageAdd;
use App\View\Main as View;
use App\View\PageAdd as ViewPageAdd;


class Main {

    function start() {

        if (@$_REQUEST['page'] == 'add') {
            $objModel = new ModelPageAdd();
            $objModel->sendData();

            $objView = new ViewPageAdd();
            echo $objView->render();
            
        } else {
            $objModel = new Model();
            $content = $objModel->get_content();

            $objView = new View($content);
            echo $objView->render();
        }
    }
    
}