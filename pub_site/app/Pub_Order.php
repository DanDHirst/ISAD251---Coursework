<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub_Order extends Model
{
    //
    protected $table = 'pub_order'; // setting up the table name or else laravel will call it Pub_Orders
    protected $primaryKey = 'OrderID';
}
