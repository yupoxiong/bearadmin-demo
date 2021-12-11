<?php
/**
 * 轮播控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\SlideService;
use app\common\validate\SlideValidate;
use app\api\exception\ApiServiceException;

class SlideController extends ApiBaseController
{
    /**
     * 列表
     * @param SlideService $service
     * @return Json
     */
    public function index(SlideService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'slide' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param SlideValidate $validate
     * @param SlideService $service
     * @return Json
     */
    public function add(SlideValidate $validate, SlideService $service): Json
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
     * @param SlideValidate $validate
     * @param SlideService $service
     * @return Json
     */
    public function info(SlideValidate $validate, SlideService $service): Json
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
     * @param SlideService $service
     * @param SlideValidate $validate
     * @return Json
     */
    public function edit(SlideService $service, SlideValidate $validate): Json
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
     * @param SlideService $service
     * @param SlideValidate $validate
     * @return Json
     */
    public function del(SlideService $service, SlideValidate $validate): Json
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
