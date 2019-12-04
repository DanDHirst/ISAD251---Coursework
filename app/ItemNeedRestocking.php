<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ItemNeedRestocking extends Model
{
    //
    protected $table = 'ItemNeedRestocking'; // setting up the table name or else laravel will call it Pub_Products
    protected $primaryKey = 'ProdID';
}
