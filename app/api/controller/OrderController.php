<?php
/**
 * 订单控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\OrderService;
use app\common\validate\OrderValidate;
use app\api\exception\ApiServiceException;

class OrderController extends ApiBaseController
{
    /**
     * 列表
     * @param OrderService $service
     * @return Json
     */
    public function index(OrderService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'order' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param OrderValidate $validate
     * @param OrderService $service
     * @return Json
     */
    public function add(OrderValidate $validate, OrderService $service): Json
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
     * @param OrderValidate $validate
     * @param OrderService $service
     * @return Json
     */
    public function info(OrderValidate $validate, OrderService $service): Json
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
     * @param OrderService $service
     * @param OrderValidate $validate
     * @return Json
     */
    public function edit(OrderService $service, OrderValidate $validate): Json
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
     * @param OrderService $service
     * @param OrderValidate $validate
     * @return Json
     */
    public function del(OrderService $service, OrderValidate $validate): Json
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
