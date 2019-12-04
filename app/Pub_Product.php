<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub_Product extends Model
{
    protected $table = 'pub_product'; // setting up the table name or else laravel will call it Pub_Products
    protected $primaryKey = 'ProdID';
}
