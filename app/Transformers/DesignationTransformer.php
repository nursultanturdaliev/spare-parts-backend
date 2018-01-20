<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/20/18
 * Time: 8:02 AM
 */

namespace App\Transformers;


use App\ModelDesignation;
use League\Fractal\TransformerAbstract;

class DesignationTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['modifications'];

    public function transform(ModelDesignation $designation)
    {
        return [
            'id' => $designation->id
        ];
    }

    public function includeModifications(ModelDesignation $designation)
    {
        return $this->collection($designation->modifications, new ModificationTransformer(),'modifications');
    }
}