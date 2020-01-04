<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSales extends Model
{
    protected $table = 'amountproductssold'; // setting up the table name or else laravel will call it Pub_Products
    protected $primaryKey = 'ProdID';
}
