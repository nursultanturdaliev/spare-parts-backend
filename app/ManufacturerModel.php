<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/16/18
 * Time: 7:27 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string manufactured_years
 */
class ManufacturerModel extends Model
{
    protected $fillable = ['name', 'code', 'thumbnail', 'href', 'manufactured_years', 'manufacturer_id'];

    protected $table = 'models';

    public $timestamps = false;
}