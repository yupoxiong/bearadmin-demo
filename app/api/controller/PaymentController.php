<?php
/**
 * 支付方式控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\PaymentService;
use app\common\validate\PaymentValidate;
use app\api\exception\ApiServiceException;

class PaymentController extends ApiBaseController
{
    /**
     * 列表
     * @param PaymentService $service
     * @return Json
     */
    public function index(PaymentService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'payment' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param PaymentValidate $validate
     * @param PaymentService $service
     * @return Json
     */
    public function add(PaymentValidate $validate, PaymentService $service): Json
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
     * @param PaymentValidate $validate
     * @param PaymentService $service
     * @return Json
     */
    public function info(PaymentValidate $validate, PaymentService $service): Json
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
     * @param PaymentService $service
     * @param PaymentValidate $validate
     * @return Json
     */
    public function edit(PaymentService $service, PaymentValidate $validate): Json
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
     * @param PaymentService $service
     * @param PaymentValidate $validate
     * @return Json
     */
    public function del(PaymentService $service, PaymentValidate $validate): Json
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
