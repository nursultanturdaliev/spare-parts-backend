<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed href
 * @property string content
 */
class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $fillable = ['name', 'href'];
}