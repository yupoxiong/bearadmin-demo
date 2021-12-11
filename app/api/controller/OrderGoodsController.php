<?php
/**
 * 订单商品控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\OrderGoodsService;
use app\common\validate\OrderGoodsValidate;
use app\api\exception\ApiServiceException;

class OrderGoodsController extends ApiBaseController
{
    /**
     * 列表
     * @param OrderGoodsService $service
     * @return Json
     */
    public function index(OrderGoodsService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'order_goods' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param OrderGoodsValidate $validate
     * @param OrderGoodsService $service
     * @return Json
     */
    public function add(OrderGoodsValidate $validate, OrderGoodsService $service): Json
    {
        $check = $validate->scene('api_add')->check($this->param);
        if (!$check) {
            return api_error($validate->getError());
        }

        $result = $service->createData($this->param);

        return $result ? api_success() : api_error();
    }

    /**
     * 详情
     * @param OrderGoodsValidate $validate
     * @param OrderGoodsService $service
     * @return Json
     */
    public function info(OrderGoodsValidate $validate, OrderGoodsService $service): Json
    {
        $check = $validate->scene('api_info')->check($this->param);
        if (!$check) {
            return api_error($validate->getError());
        }

        try {

            $result = $service->getDataInfo($this->id);
            return api_success([
                'user_level' => $result,
            ]);

        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 修改
     * @param OrderGoodsService $service
     * @param OrderGoodsValidate $validate
     * @return Json
     */
    public function edit(OrderGoodsService $service, OrderGoodsValidate $validate): Json
    {
        $check = $validate->scene('api_edit')->check($this->param);
        if (!$check) {
            return api_error($validate->getError());
        }

        try {
            $service->updateData($this->id, $this->param);
            return api_success();
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 删除
     * @param OrderGoodsService $service
     * @param OrderGoodsValidate $validate
     * @return Json
     */
    public function del(OrderGoodsService $service, OrderGoodsValidate $validate): Json
    {
        $check = $validate->scene('api_del')->check($this->param);
        if (!$check) {
            return api_error($validate->getError());
        }

        try {
            $service->deleteData($this->id);
            return api_success();
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    

    
}
