<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Tools\ToolsAdmin;
class Permission extends Model
{
    protected $table = "admin_permission";

    const 
    	IS_MENU = 1,  //是菜单
    	IS_NO_MENU = 2,  //不是菜单
    	END = true;

    	//获取菜单权限数据
    public static function getMenus($user = []){

    	$permission = self::select("id","name","fid","url")
    					->where("is_menu",self::IS_MENU)
                        ->orderBy("id")
    					->orderBy("sort")
    					->get()
    					->toArray();

        //如果不是超管
        if($user['is_super'] != 2)
        {   
            //当前登录用户的权限节点
            $pids = ToolsAdmin::getUserPermissionIds($user['user_id']);

            $permission = self::select("id","name","fid","url")
                        ->whereIn("id",$pids)
                        ->where("is_menu",self::IS_MENU)
                        ->orderBy("sort")
                        ->get()
                        ->toArray();
        }

    	$leftMenu = ToolsAdmin::buildTree($permission);

    	return $leftMenu;
    }

    //获取权限列表
    public static function getListByFid($fid=0){

        $list = self::select('id','fid','name','url','is_menu','sort')
                        ->where("fid",$fid)
                        ->orderBy("sort")
                            ->get()
                                ->toArray();
        return $list;
    }

    //添加权限
    public static function addRecord($data){
        return self::insert($data);
    }

    //删除权限
    public static function delRecord($id){
        return self::where("id",$id)->delete();
    }

    
    //获取所有的权限
    public static function getAllPermission()
    {
        $permission = self::select("id","fid","name","url")
                            ->orderBy("sort")
                            ->get()
                            ->toArray();
        $permissions = ToolsAdmin::buildTree($permission);

        return $permissions;
    }

    //通过权限的id 获取权限的url地址
    public static function getUrlsByIds($pids)
    {   
        // dd($pids);
        $permission = self::select("url")
                            ->whereIn("id",$pids)
                            ->get()
                            ->toArray();
            // dd($permission);
        $urls = [];
        
        foreach ($permission as $key => $value) {
            $urls[] = $value['url'];
        }
        // dd($urls);  
        return $urls;
    }
}
