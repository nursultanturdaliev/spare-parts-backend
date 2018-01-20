<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/18/18
 * Time: 7:31 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ModificationType extends Model
{
    protected $table = 'modification_types';

    protected $fillable = ['name'];

    public $timestamps = false;
}