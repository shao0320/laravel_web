<?php

namespace App\Http\Controllers\ShopApi;

use App\Model\Article;
use App\Model\Brand;
use App\Model\Category;
use App\Tools\ToolsAdmin;
use App\Tools\ToolsOss;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //商品分类接口
    public function category(){
        $category=new Category();
        $data=$this->getLists($category);
        $data=ToolsAdmin::buildTree($data,0,"f_id");
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>$data
        ];
        return json_encode($return);


    }
    //首页广告位的借口
    public function ad(Request $request){
        //广告的id参数
        $position=$request->input('position_id',1);
        //广告的条数
        $nums=$request->input('nums',1);

        $currentTime=date("Y-m-d H:i:s");
        $ad=\DB::table('jy_ad')->select('id','ad_name','image_url','ad_link')
            ->where('position_id',$position)
            ->where('start_time','<',$currentTime)
            ->where('end_time','>',$currentTime)
            ->limit($nums)
            ->get();
//        //组装广告的数据
//        $ad_data=[];
//        $toolsOss=new ToolsOss();
//        foreach ($ad as $key=>$value){
//            $ad_data[$key]=[
//              'id'=>$value->id,
//              'ad_name'=>$value->ad_name,
//              'image_url'=>$toolsOss->getUrl($value->image_url,true),
//              'ad_link'=>$value->ad_link
//            ];
//        }
            // dd($ad);
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>$ad
        ];
        return json_encode($return);
    }
    //商品类型列表
    public function goodsList(Request $request){
        //获取商品类型
        $type=$request->input('type',1);
        $nums=$request->input('nums',5);

        if ($type == 1){//热卖商品
        $goods=\DB::table('jy_goods')->select('id','goods_name','market_price')
            ->where('is_hot',1)
            ->where('is_shop',1)
            ->limit($nums)
            ->get();
        }elseif ($type == 2){//推荐商品
            $goods=\DB::table('jy_goods')->select('id','goods_name','market_price')
                ->where('is_recommand',1)
                ->where('is_shop',1)
                ->limit($nums)
                ->get();
        }else{//新品
             $goods=\DB::table('jy_goods')->select('id','goods_name','market_price')
                ->where('is_new',1)
                ->where('is_shop',1)
                ->limit($nums)
                ->get();
        }
        $goodsList=[];
        foreach ($goods as $key=>$value){
            $gallery=\DB::table('jy_goods_gallery')->where('goods_id',$value->id)->first();
            $goodsList[$key]=[
                'id'=>$value->id,
                'goods_name'=>$value->goods_name,
                'market_price'=>$value->market_price,
               'image_url'=>!empty($gallery->image_url) ? $gallery->image_url : "",
            ];
        }
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>$goodsList
        ];
        return json_encode($return);
    }
    //品牌列表
    public function brand(Request $request){
        $nums=$request->input('nums',9);
        $object=new Brand();
        $brand=$this->getLimitDataList($object,$nums,['status'=>1]);
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>$brand
        ];
        return json_encode($return);

    }
    //最新文章
    public function newsArticle(Request $request){
        $nums=$request->input('nums',5);
        $article=new Article();
        $new=$article->getNewArticles($nums,['status'=>3]);
        $return=[
            'code'=>2000,
            'msg'=>'成功',
            'data'=>$new
        ];
        return json_encode($return);
    }
}
