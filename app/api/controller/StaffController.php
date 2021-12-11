<?php
/**
 * 员工控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\StaffService;
use app\common\validate\StaffValidate;
use app\api\exception\ApiServiceException;

class StaffController extends ApiBaseController
{
    /**
     * 列表
     * @param StaffService $service
     * @return Json
     */
    public function index(StaffService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'staff' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param StaffValidate $validate
     * @param StaffService $service
     * @return Json
     */
    public function add(StaffValidate $validate, StaffService $service): Json
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
     * @param StaffValidate $validate
     * @param StaffService $service
     * @return Json
     */
    public function info(StaffValidate $validate, StaffService $service): Json
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
     * @param StaffService $service
     * @param StaffValidate $validate
     * @return Json
     */
    public function edit(StaffService $service, StaffValidate $validate): Json
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
     * @param StaffService $service
     * @param StaffValidate $validate
     * @return Json
     */
    public function del(StaffService $service, StaffValidate $validate): Json
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
