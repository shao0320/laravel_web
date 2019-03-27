<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;
use App\Model\Category;
use App\Model\Author;
use App\Tools\ToolsAdmin;

class NovelController extends Controller
{
    //小说列表
    public function list(){

    	$novel = new Novel();

    	$assign['novels'] = $novel->getList();
    	// dd($assign);
    	return view('admin.novel.list',$assign);
    }

    //小说添加页面
    public function create(){

    	$category = new Category();
    	$author = new Author();
    	//获取分类列表
    	$assign['c_list'] = $category->getCategory();
    	//获取作者列表
    	$assign['a_list'] = $author->getAuthor();

    	// dd($assign);
    	return view('admin.novel.create',$assign);
    }


    //执行添加操作
    public function store(Request $request){

    	$params = $request->all();
    	// return view('admin.novel.store');
    	// dd($params);
    	$params['image_url'] = ToolsAdmin::uploadFile($params['image_url']);
		$params['c_id'] =$params['c_id'];
		$params['desc'] =$params['desc'];
    	unset($params['_token']);
    	// unset($params['editorValue']);
    	// unset($params['rc_id']);
    	// dd($params);
    	$novel = new Novel();
    	// dd($params);
    	$res= $novel->addRecord($params);
    	// dd($res);
    	if($res){
    		return redirect()->back();
    	}

    	return redirect('/admin/novel/list');
    }

    // 小说删除
    public function del($id){
    	
    	$novel = new Novel();

    	$novel = $novel->delRecord($id);

    	return redirect('/admin/novel/list');

    }

      //小说编辑页面
    public function edit($id)
    {
    	$category = new Category();
    	$author = new Author();
    	$novel = new Novel();
    	//获取分类的列表
    	$assign['c_list'] = $category->getCategory();
    	//获取作者列表
    	$assign['a_list'] = $author->getAuthor();
    	//获取小说的详情
    	$assign['novel'] = $novel->getNovelInfo($id);
    	return view('admin.novel.edit',$assign);
    }
    //执行小说编辑功能
    public function doEdit(Request $request)
    {
    	$params = $request->all();
    	//如果上传图片
    	if(isset($params['image_url'])){
    		$params['image_url'] = ToolsAdmin::uploadFile($params['image_url']);
    	}
    	$id = $params['id'];//小说的主键id
    	unset($params['_token']);
    	unset($params['id']);
       $novel = new Novel();
    	$res = $novel->editRecord($params, $id);
    	if(!$res){
    		return redirect()->back();
    	}
    	return redirect('/admin/novel/list');
    }





}


