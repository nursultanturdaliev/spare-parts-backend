<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/18/18
 * Time: 9:48 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class ModelDesignation extends Model
{
    protected $table = 'model_designations';

    protected $fillable = ['model_id', 'href'];

    public $timestamps = false;
}