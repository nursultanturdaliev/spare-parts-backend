<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/27/18
 * Time: 6:45 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'tetik_countries';

    protected $fillable = ['name', 'code'];

    public $timestamps = false;
}