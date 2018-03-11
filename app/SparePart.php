<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/25/18
 * Time: 10:01 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string number
 * @property string name
 * @property string description
 */
class SparePart extends Model
{
    protected $table = 'tetik_spare_parts';

    protected $fillable = ['number', 'name', 'description', 'spare_part_group_id'];
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}