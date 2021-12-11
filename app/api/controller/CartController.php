<?php
/**
 * 购物车控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\CartService;
use app\common\validate\CartValidate;
use app\api\exception\ApiServiceException;

class CartController extends ApiBaseController
{
    /**
     * 列表
     * @param CartService $service
     * @return Json
     */
    public function index(CartService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'cart' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param CartValidate $validate
     * @param CartService $service
     * @return Json
     */
    public function add(CartValidate $validate, CartService $service): Json
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
     * @param CartValidate $validate
     * @param CartService $service
     * @return Json
     */
    public function info(CartValidate $validate, CartService $service): Json
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
     * @param CartService $service
     * @param CartValidate $validate
     * @return Json
     */
    public function edit(CartService $service, CartValidate $validate): Json
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
     * @param CartService $service
     * @param CartValidate $validate
     * @return Json
     */
    public function del(CartService $service, CartValidate $validate): Json
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
