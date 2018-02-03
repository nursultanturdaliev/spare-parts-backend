<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/3/18
 * Time: 2:49 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string code
 * @property string period
 * @property string production
 * @property string years_content
 * @property int id
 */
class ModelGroup extends Model
{
    protected $table = 'tetik_model_groups';

    public $timestamps = false;

    protected $fillable = ['name', 'code', 'period', 'production', 'years_content', 'manufacturer_id', 'country_id', 'href'];
}