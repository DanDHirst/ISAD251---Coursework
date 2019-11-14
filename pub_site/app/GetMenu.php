<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetMenu extends Model
{
    protected $table = 'get_menu'; // setting up the table name or else laravel will call it Pub_Products
    protected $primaryKey = 'ProdID';
}
