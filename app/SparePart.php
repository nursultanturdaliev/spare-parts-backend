<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/25/18
 * Time: 10:01 PM
 */

namespace App\Console\Commands;


use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $table = 'tetik_spare_parts';

    protected $fillable = ['number', 'name', 'description'];
}