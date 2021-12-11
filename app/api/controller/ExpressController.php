<?php
/**
 * 快递控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ExpressService;
use app\common\validate\ExpressValidate;
use app\api\exception\ApiServiceException;

class ExpressController extends ApiBaseController
{
    /**
     * 列表
     * @param ExpressService $service
     * @return Json
     */
    public function index(ExpressService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'express' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ExpressValidate $validate
     * @param ExpressService $service
     * @return Json
     */
    public function add(ExpressValidate $validate, ExpressService $service): Json
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
     * @param ExpressValidate $validate
     * @param ExpressService $service
     * @return Json
     */
    public function info(ExpressValidate $validate, ExpressService $service): Json
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
     * @param ExpressService $service
     * @param ExpressValidate $validate
     * @return Json
     */
    public function edit(ExpressService $service, ExpressValidate $validate): Json
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
     * @param ExpressService $service
     * @param ExpressValidate $validate
     * @return Json
     */
    public function del(ExpressService $service, ExpressValidate $validate): Json
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
