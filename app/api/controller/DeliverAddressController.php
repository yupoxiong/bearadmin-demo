<?php
/**
 * 收货地址控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\DeliverAddressService;
use app\common\validate\DeliverAddressValidate;
use app\api\exception\ApiServiceException;

class DeliverAddressController extends ApiBaseController
{
    /**
     * 列表
     * @param DeliverAddressService $service
     * @return Json
     */
    public function index(DeliverAddressService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'deliver_address' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param DeliverAddressValidate $validate
     * @param DeliverAddressService $service
     * @return Json
     */
    public function add(DeliverAddressValidate $validate, DeliverAddressService $service): Json
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
     * @param DeliverAddressValidate $validate
     * @param DeliverAddressService $service
     * @return Json
     */
    public function info(DeliverAddressValidate $validate, DeliverAddressService $service): Json
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
     * @param DeliverAddressService $service
     * @param DeliverAddressValidate $validate
     * @return Json
     */
    public function edit(DeliverAddressService $service, DeliverAddressValidate $validate): Json
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
     * @param DeliverAddressService $service
     * @param DeliverAddressValidate $validate
     * @return Json
     */
    public function del(DeliverAddressService $service, DeliverAddressValidate $validate): Json
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
