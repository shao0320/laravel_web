<?php 
	namespace App\Tools;

	//公共方法类
	class ToolsAdmin
	{	
		//无限极分类数据组装
		public static function buildTree($data,$fid=0,$fKey='fid')
		{
			if(empty($data)){
				return [];
			}

			static $menus = [];   //存储无限极分类数据

			foreach ($data as $key => $value) {

				if($value[$fKey] == $fid){
					// 如果key值不存在
					// 看是否定义父类fid
					if(!isset($menus[$fid])){
						// 给父类fid赋值
						$menus[$value['id']] = $value;
					}else{
						$menus[$fid]['son'][$value['id']] = $value;
					}

					//删除已经添加过的数据
					unset($data[$key]);

					//执行递归调用
					self::buildTree($data,$value['id'],$fKey);
				}
			}

			return $menus;
		}

		//创建无限极分类
        public static function buildTreeString($data,$fid=0,$level=0,$fKey="fid")
        {
            if(empty($data)){
                return [];
            }

            static $tree= [];

            foreach($data as $key => $value){

                //判断当前的父类id是否是递归调用传过来的id
                if($value[$fKey] == $fid){
                    $value['level'] = $level;

                    $tree[] = $value;

                    unset($data[$key]);

                    self::buildTreeString($data,$value['id'],$level+1,$fKey);
                }
            }

            return $tree;
        }

		//图片上传
		public static function uploadFile($files,$isOss = false)
	{
		//参数为空
		if(empty($files)){
			return "";
		}
		if($isOss){
			//oss文件上传
			$oss = new ToolsOss();
			$url =  $oss->putFile($files);
			return $url;
		}
		
		//文件上传的目录
		$basePath = 'uploads/'.date("Y-m-d",time());
		//目录不存在
		if(!file_exists($basePath)){
			@mkdir($basePath, 755, true);
		}
		//文件名字
		$filename = "/".date("YmdHis",time()).rand(0,10000).".".$files->extension();
		@move_uploaded_file($files->path(), $basePath.$filename);//执行文件的上传
		return '/'.$basePath.$filename;
	}



		//获取用户所有权限的主键id
		public static function getUserPermissionIds($userId){

			if(!isset($userId) || empty($userId)){
				return [];
			}

			$userRole = new \App\Model\UserRole();

			//查询角色id
			$roles = $userRole->getRoleIdByUserId($userId);
				
			//角色不存在
			if(empty($roles)){
				return [];
			}

			$rolePermissions = new \App\Model\RolePermission();
			
			//根据用户的角色id调用权限id集合
			$pids = $rolePermissions->getPermissionById($roles->role_id);
			
			return $pids;

		}

		//获取当前登录用户的所有权限url地址
		public static function getUrlsByUserId($userId){
			//获取所有权限节点id
			$pids = self::getUserPermissionIds($userId);
				// dd($pids);
			//获取所有的权限url地址
			$urls = \App\Model\Permission::getUrlsByIds($pids);
					// dd($urls);
			return $urls;
		}

		//商品货号
        public static function buildGoodsSn($string=16){
		    return "JY".date("YmdHis",time());
        }
	}
 ?>