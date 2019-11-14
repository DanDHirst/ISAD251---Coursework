<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetDrink extends Model
{
    //
    protected $table = 'GetDrinks'; // setting up the table name or else laravel will call it Pub_Products
    protected $primaryKey = 'ProdID';
}
