<?php
/**
 * 品牌控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\BrandService;
use app\common\validate\BrandValidate;
use app\api\exception\ApiServiceException;

class BrandController extends ApiBaseController
{
    /**
     * 列表
     * @param BrandService $service
     * @return Json
     */
    public function index(BrandService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'brand' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param BrandValidate $validate
     * @param BrandService $service
     * @return Json
     */
    public function add(BrandValidate $validate, BrandService $service): Json
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
     * @param BrandValidate $validate
     * @param BrandService $service
     * @return Json
     */
    public function info(BrandValidate $validate, BrandService $service): Json
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
     * @param BrandService $service
     * @param BrandValidate $validate
     * @return Json
     */
    public function edit(BrandService $service, BrandValidate $validate): Json
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
     * @param BrandService $service
     * @param BrandValidate $validate
     * @return Json
     */
    public function del(BrandService $service, BrandValidate $validate): Json
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
