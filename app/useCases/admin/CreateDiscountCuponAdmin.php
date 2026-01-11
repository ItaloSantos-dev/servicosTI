<?php
namespace App\useCases\admin;

use App\Models\DiscountCupon;

class CreateDiscountCuponAdmin
{
    public function execute ($data)
    {
        if($data['amount']>50){
            return null;
        }
        return DiscountCupon::create($data);
    }

}
