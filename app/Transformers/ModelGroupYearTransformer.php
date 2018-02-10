<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 1:30 PM
 */

namespace App\Transformers;


use App\ModelGroupYear;
use League\Fractal\TransformerAbstract;

class ModelGroupYearTransformer extends TransformerAbstract
{
    public function transform(ModelGroupYear $modelGroupYear)
    {
        return [
            'id'   => $modelGroupYear->id,
            'name' => $modelGroupYear->name
        ];
    }
}