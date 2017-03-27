<?php

class BookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

    }




    public function successAction() //post to db and displays calendar
    {
        $book_room = new Application_Model_Book();

        if ($this->_request->isPost()){
            $day    = $this->getParam('day');// $_POST['day'];
            $start  = $this->getParam('start');//$_POST['start'] ;
            $end    = $this->getParam('end');//$_POST['end'];
            $title  = $this->getParam('title');// $_POST['title'];



            $query_params = array(

                'start' => $day . 'T'. $start,
                'end'   => $day . 'T'. $end,
                'title' => $title

            );
            $book_room->bookRoom($query_params);
        }


        $bookings = $book_room->getBookings();
        $this->view->bookings = $bookings;
    }


}





