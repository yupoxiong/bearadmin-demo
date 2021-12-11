<?php
/**
 * 部门控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\DepartmentService;
use app\common\validate\DepartmentValidate;
use app\api\exception\ApiServiceException;

class DepartmentController extends ApiBaseController
{
    /**
     * 列表
     * @param DepartmentService $service
     * @return Json
     */
    public function index(DepartmentService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'department' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param DepartmentValidate $validate
     * @param DepartmentService $service
     * @return Json
     */
    public function add(DepartmentValidate $validate, DepartmentService $service): Json
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
     * @param DepartmentValidate $validate
     * @param DepartmentService $service
     * @return Json
     */
    public function info(DepartmentValidate $validate, DepartmentService $service): Json
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
     * @param DepartmentService $service
     * @param DepartmentValidate $validate
     * @return Json
     */
    public function edit(DepartmentService $service, DepartmentValidate $validate): Json
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
     * @param DepartmentService $service
     * @param DepartmentValidate $validate
     * @return Json
     */
    public function del(DepartmentService $service, DepartmentValidate $validate): Json
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
