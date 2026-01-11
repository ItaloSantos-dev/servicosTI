<?php
namespace App\useCases\admin;

use App\Models\OrderType;

class CreateOrderTypeAdmin{
    public  function execute ($data)
    {
        return OrderType::create($data);
    }
}
