<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Brand;
use App\Model\GoodsType;
use App\Model\Goods;
use App\Model\GoodsGallery;
use App\Tools\ToolsAdmin;
use Illuminate\Support\Facades\DB;
use Log;
use App\Tools\ToolsExcel;
class GoodsController extends Controller
{
    //列表页面
    public function list()
    {
        return view('admin.goods.list');
    }
    //获取列表数据的接口
    public function getGoodsData(Request $request)
    {
        $params = $request->all();
        $return = [
            'code' => 2000,
            'msg'  => '获取商品列表数据'
        ];
        $goods = new Goods();
        $data = $this->getListsInfo($goods)->toArray();
        $return['data'] = [
            'list' => $data['data'],
            'current_page' => $data['current_page'],
            'total_page'   => $data['last_page']
        ];
        return json_encode($return);
    }
    //修改属性值
    public function changeAttr(Request $request)
    {
        $params = $request->all();

        $return = [
            'code' => 2000,
            'msg'  => '修改商品属性成功'
        ];
        $goods = Goods::find($params['id']);

        //组装的数据
        $data = [
            $params['key'] => $params['val']
        ];
        $res = $this->updateDataInfo($goods, $data,$params['id']);
        if(!$res){
            $return = [
                'code' => 4000,
                'msg'  => '修改商品属性失败'
            ];
        }
        return json_encode($return);
    }
    //添加页面
    public function add()
    {
        //商品类型
        $type = new GoodsType();
        $assign['type_list'] = $this->getLists($type, ['status'=> GoodsType::USE_ABLE]);
        //商品品牌
        $brand = new Brand();
        $assign['brand_list'] = $this->getLists($brand, ['status'=> Brand::USE_ABLE]);
        //商品分类
        $category = new Category();
        $assign['cate_list'] = $this->getLists($category, ['status'=> Category::USE_ABLE]);
        $assign['cate_list'] = ToolsAdmin::buildTreeString($assign['cate_list'],0,0,'f_id');
        //商品货号
        $assign['goods_sn'] = ToolsAdmin::buildGoodsSn();
        return view('admin.goods.add', $assign);
    }
    //执行添加的操作
    public function store(Request $request)
    {
        $params = $request->all();

        //上传图片的上限
        if(isset($params['image_url']) && count($params['image_url'])>5){
            return redirect()->back()->with('msg','已经超过相册上传的上限');
        }
        //
        $params = $this->delToken($params);
        //拿到相册的数据
        $gallery = $params['image_url'];
        unset($params['image_url']);
//        dd($gallery, $params);
        try{
            //事务开启
            DB::beginTransaction();
            //添加商品信息
            $goods = new Goods();
            $goodsId = $this->addDataBackId($goods, $params);

            //添加相册的信息
            //1 格式化相册的数据
            //1 格式化相册的数据
            $gallery_data = [];//初始化的值
            foreach ($gallery as $key => $value) {
                //判断是否上传了图片
                if(array_key_exists('image_url', $value)){
                    $value['image_url'] = ToolsAdmin::uploadFile($value['image_url']);//上传后图片地址
                    $value['goods_id'] = $goodsId;
                    $gallery_data[$key] = $value;//组装新的数据
                }
            }
            //2、执行添加的操作
            if(!empty($gallery_data)){
                $goodsGallery = new GoodsGallery();
                $this->addDataMany($goodsGallery, $gallery_data);//执行添加的操作
            }
            //事务提交
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            Log::error('商品添加失败'.$e->getMessage());
            return redirect()->back()->with('msg','商品添加失败');
        }
        return redirect('/admin/goods/list');
    }
    //编辑页面
    public function edit($id)
    {
        //商品类型
        $type = new GoodsType();
        $assign['type_list'] = $this->getLists($type, ['status'=> GoodsType::USE_ABLE]);
        //商品品牌
        $brand = new Brand();
        $assign['brand_list'] = $this->getLists($brand, ['status'=> Brand::USE_ABLE]);
        //商品分类
        $category = new Category();
        $assign['cate_list'] = $this->getLists($category, ['status'=> Category::USE_ABLE]);
        $assign['cate_list'] = ToolsAdmin::buildTreeString($assign['cate_list'],0,0,'f_id');
        $goods = new Goods();
        $assign['info'] = $this->getDataInfo($goods, $id);
        return view('admin.goods.edit',$assign);
    }
    //执行编辑的操作
    public function doEdit(Request $request)
    {
        $params = $request->all();
        // dd($params);
        //上传图片的上限
        if(isset($params['image_url']) && count($params['image_url'])>5){
            return redirect()->back()->with('msg','已经超过相册上传的上限');
        }
        //删除token
        $params = $this->delToken($params);
        //拿到相册的数据
        $gallery = $params['image_url'];
        unset($params['image_url']);
        //dd($gallery, $params);
        try{
            //事务开启
            DB::beginTransaction();
            //添加商品信息
            $goods = Goods::find($params['id']);
            $this->storeData($goods, $params);
            //添加相册的信息
            //1 格式化相册的数据
            $gallery_data = [];//初始化的值
            foreach ($gallery as $key => $value) {
                //判断是否上传了图片
                if(array_key_exists('image_url', $value)){
                    $value['image_url'] = ToolsAdmin::uploadFile($value['image_url']);//上传后图片地址
                    $value['goods_id'] = $params['id'];
                    $gallery_data[$key] = $value;//组装新的数据
                }
            }
            // dd($gallery_data);
            //2、执行添加的操作
            if(!empty($gallery_data)){
                $goodsGallery = new GoodsGallery();
                $this->addDataMany($goodsGallery, $gallery_data);//执行添加的操作
            }

            //事务提交
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            Log::error('商品添加失败'.$e->getMessage());
            return redirect()->back()->with('msg','商品添加失败');
        }
        return redirect('/admin/goods/list');
    }
    //删除商品
    public function del($id)
    {
        $return = [
            'code' => 2000,
            'msg'  => '删除商品成功'
        ];
        $goods = new Goods();
        $gallery = new GoodsGallery();
        try{
            DB::beginTransaction();
            //删除商品
            $this->delRecord($goods,$id);
            //删除相册
            $this->delRecord($gallery, $id, 'goods_id');
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            \Log::error('商品删除失败'.$e->getMessage());
            $return = [
                'code' => $e->getCode(),
                'msg'  => $e->getMessage()
            ];
        }
        return json_encode($return);
    }

    //商品批量导入的功能
    public function import()
    {
//        $cellData[] = ['id','goods_name'];
//        $goods = new Goods();
//        $data = $this->getLists($goods);
//        foreach ($data as $key => $value) {
//            $cellData[] = [
//                $value['id'],$value['goods_name']
//            ];
//        }
//        //dd($cellData);
//        \Excel::create('Excel导出数据',function($excel) use ($cellData){
//            $excel->sheet('数据', function($sheet) use ($cellData){
//                $sheet->rows($cellData);
//            });
//        })->export('xls');
//
//        dd('success');
        return view('admin.goods.import');
    }
    //执行导入的操作
    public function doImport(Request $request)
    {
        $params = $request->all();
        $files = $params['file_name'];
        //判断文件的后缀名
        if($files->extension() !="xls" && $files->extension()!="xlsx"){
            return redirect()->back()->with('msg','文件格式不正确，请上传xls，xlsx后缀名文件');
        }
//        dd($files);
        $data = ToolsExcel::import($files);
//            dd($data);
        $goods = new Goods();
        $goodsData = [];
        foreach ($data as $key => $value) {
            $value['goods_sn'] = "JY".date("YmdHis",rand(1000,99999));
            $goodsData[$key] = $value;
        }
//        dd($goodsData);
        $res = $this->addDataMany($goods, $goodsData);
        if(!$res){
            return redirect()->back()->with('msg','导入失败');
        }
        return redirect('/admin/goods/list');
    }
    //商品导出的功能
    public function export()
    {
        $goods = new Goods();
        $data = $this->getLists($goods);
        //导出的数据
        $exportData = [];
        $head = ['cate_id','goods_name','goods_sn',"goods_desc","shop_price","market_price","goods_num","warn_num","keywords","is_shop","shop_time","is_recommand","is_new","is_hot","is_new","sort","give_score","status"]; //excel的head头
        $exportData[] = ['cate_id','goods_name','goods_sn',"goods_desc","shop_price","market_price","goods_num","warn_num","keywords","is_shop","shop_time","is_recommand","is_new","is_hot","is_new","sort","give_score","status"];
        //组装打印的数据
        foreach ($data as $key => $value) {
            $tmpArr = [];
            foreach ($head as $column) {
                $tmpArr[] = $value[$column];
            }
            $exportData[] = $tmpArr;
        }
        ToolsExcel::exportData($exportData);
    }
}