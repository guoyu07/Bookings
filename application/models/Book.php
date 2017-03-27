<?php

class Application_Model_Book
{

    public function bookRoom($array)
    {
       /*
        $dbTableBookings = new Application_Model_DbTable_Bookings();
        $dbTableBookings->insert($array);
       */
        $dbTableBooking = new Application_Model_DbTable_Booking();
        $dbTableBooking->insert($array);


    }


    public function getBookings() //queries db
    {
        /*
        $dbTableBookings = new Application_Model_DbTable_Bookings();
        $row = $dbTableBookings->fetchAll($dbTableBookings->select());
        return $row;
        */

        $dbTableBooking = new Application_Model_DbTable_Booking();
        $row = $dbTableBooking->fetchAll($dbTableBooking->select());
        return $row;

    }

}

