<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //指定表
    protected $table = "jy_order";

       //国家
    public  static function getOrderCountry()
    {
    	return self::select("region_name")
    				->leftJoin("jy_region","jy_order.country","=","jy_region.id")
    				->first();
    }
    //省
    public  static function getOrderProvince()
    {
    	return self::select("region_name")
    				->leftJoin("jy_region","jy_order.province","=","jy_region.id")
    				->first();
    }
    //市
    public static function getOrderCity()
    {
    	return self::select("region_name")
    				->leftJoin("jy_region","jy_order.city","=","jy_region.id")
    				->first();
    }
    //县
    public static function getOrderDistrict()
    {
    	return self::select("region_name")
    				->leftJoin("jy_region","jy_order.district","=","jy_region.id")
    				->first();
    }
    
}
