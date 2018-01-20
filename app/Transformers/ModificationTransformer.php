<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/20/18
 * Time: 9:03 AM
 */

namespace App\Transformers;


use App\Modification;
use League\Fractal\TransformerAbstract;

class ModificationTransformer extends TransformerAbstract
{

    public function transform(Modification $modification)
    {
        return [
            'id' => $modification->id,
            'modification_type' => $modification->modificationType,
            'name'=>$modification->name
        ];
    }
}