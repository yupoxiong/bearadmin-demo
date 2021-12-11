<?php
/**
 * 职位控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\PositionService;
use app\common\validate\PositionValidate;
use app\api\exception\ApiServiceException;

class PositionController extends ApiBaseController
{
    /**
     * 列表
     * @param PositionService $service
     * @return Json
     */
    public function index(PositionService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'position' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param PositionValidate $validate
     * @param PositionService $service
     * @return Json
     */
    public function add(PositionValidate $validate, PositionService $service): Json
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
     * @param PositionValidate $validate
     * @param PositionService $service
     * @return Json
     */
    public function info(PositionValidate $validate, PositionService $service): Json
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
     * @param PositionService $service
     * @param PositionValidate $validate
     * @return Json
     */
    public function edit(PositionService $service, PositionValidate $validate): Json
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
     * @param PositionService $service
     * @param PositionValidate $validate
     * @return Json
     */
    public function del(PositionService $service, PositionValidate $validate): Json
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
