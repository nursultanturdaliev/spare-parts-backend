<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/26/18
 * Time: 9:27 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string name
 * @property string code
 * @property string content
 * @property mixed manufacturers
 * @property mixed slug
 */
class CatalogType extends Model
{
    protected $table = 'tetik_catalog_types';

    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    public function manufacturers()
    {
        return $this->hasMany(Manufacturer::class);
    }
}