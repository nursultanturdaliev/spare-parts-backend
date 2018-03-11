<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/11/18
 * Time: 12:54 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property double price
 * @property integer quantity
 * @property integer user_id
 * @property integer spare_part_id
 */
class Product extends Model
{
    protected $table = 'tetik_products';
    protected $fillable = ['price', 'quantity', 'user_id', 'spare_part_id'];
}