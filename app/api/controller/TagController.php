<?php
/**
 * 标签控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\TagService;
use app\common\validate\TagValidate;
use app\api\exception\ApiServiceException;

class TagController extends ApiBaseController
{
    /**
     * 列表
     * @param TagService $service
     * @return Json
     */
    public function index(TagService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'tag' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param TagValidate $validate
     * @param TagService $service
     * @return Json
     */
    public function add(TagValidate $validate, TagService $service): Json
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
     * @param TagValidate $validate
     * @param TagService $service
     * @return Json
     */
    public function info(TagValidate $validate, TagService $service): Json
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
     * @param TagService $service
     * @param TagValidate $validate
     * @return Json
     */
    public function edit(TagService $service, TagValidate $validate): Json
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
     * @param TagService $service
     * @param TagValidate $validate
     * @return Json
     */
    public function del(TagService $service, TagValidate $validate): Json
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
