<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub_Admin extends Model
{
    protected $table = 'pub_admin'; // setting up the table name or else laravel will call it Pub_Admins
    protected $primaryKey = 'Username';
}
