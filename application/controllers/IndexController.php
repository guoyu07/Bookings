<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        //$newconfig = new Application_Model_Book();
        //$newconfig->newConfig('roombooker','root','');

    }

    public function createdatabaseAction()
    {
        if ($this->_request->isPost()){
            $newconfig = new Application_Model_Book();
            $newconfig->newConfig($_POST['db_name'],$_POST['db_username'],$_POST['db_pass']);
        }

    }

}

