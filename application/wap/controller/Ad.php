<?php
/**
 * Created by PhpStorm.
 * User: timeless
 * Date: 16-11-3
 * Time: 上午10:10
 * 阅读广告数据
 */

namespace app\wap\controller;


use think\Controller;
use think\Db;
use think\Request;

class Ad extends Controller
{
    /**
     * 首页信息
     * @access public
     */
    public function index()
    {
        return $this->fetch('index/index');
    }

    /**
     * 点击阅读广告信息
     * @access public
     */
    public function read()
    {
        $id = Request::instance()->param('id');
        $where = ['id' => $id];
        $m = Db::name('ads');
        $count = $m->where($where)->field('readcount')->find()['readcount'];
        $m->where($where)->update(['readcount' => ++$count]);
        if (!$id) {
            exit('您的请求异常。');
        }
        return $this->fetch('read', ['r' => $m->where($where)->find()]);
    }

    /**
     * 广告列表
     * @access public
     */
    public function ads_list()
    {
        return $this->fetch('ads_list', ['r' => Db::name('ads')->limit(0.20)->order('id desc')->field('id,title')->select()]);
    }

    /**
     * 关于我们页面
     * @access public
     */
    public function aboutus()
    {
        return $this->fetch('aboutus');
    }


    /**
     * 关于我们中的其他信息
     * @access public
     */
    public function about()
    {
        return $this->fetch('about/about_' . Request::instance()->param('flag'));
    }


    /**
     * 产品信息
     * @access public
     */
    public function product()
    {
        $flag = Request::instance()->param('flag');
        if (!$flag) {
            return $this->fetch('product');
        }
        return $this->fetch('product/product_' . $flag);

    }

    /**
     * 成功案例
     * @access public
     */
    public function case_list()
    {
        return $this->fetch('case_list');
    }


    /**
     * 客户服务
     * @access public
     */
    public function qiye_service()
    {
        return $this->fetch('qiye_service');
    }

    /**
     * 客户添加
     * @access public
     */
    public function service()
    {
        $flag = Request::instance()->param('flag');
        return $this->fetch('service/service_' . $flag);
    }


}