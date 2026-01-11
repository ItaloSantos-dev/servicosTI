<?php
namespace App\useCases\admin;
use App\Models\DiscountCupon;

class UpdateDiscountCuponAdmin
{
    public  function execute ($id, $data)
    {
        $discountCupon = DiscountCupon::findOrFail($id);
        $discountCupon->slug = $data['slug'];
        $discountCupon->amount = $data['amount'];
        $discountCupon->minimum_amount = $data['minimum_amount'];
        if(isset($data['active'])){
            $discountCupon->active=true;
        }
        else{
            $discountCupon->active=false;
        }
        return $discountCupon->save();
    }
}
