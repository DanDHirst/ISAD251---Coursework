<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub_Order_Detail extends Model
{
    protected $table = 'pub_order_detail'; // setting up the table name or else laravel will call it Pub_Order_details
    protected $primaryKey = 'OrderDetailsID';
}
