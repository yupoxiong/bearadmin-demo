<?php
/**
 * 商品控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\GoodsService;
use app\common\validate\GoodsValidate;
use app\api\exception\ApiServiceException;

class GoodsController extends ApiBaseController
{
    /**
     * 列表
     * @param GoodsService $service
     * @return Json
     */
    public function index(GoodsService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'goods' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param GoodsValidate $validate
     * @param GoodsService $service
     * @return Json
     */
    public function add(GoodsValidate $validate, GoodsService $service): Json
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
     * @param GoodsValidate $validate
     * @param GoodsService $service
     * @return Json
     */
    public function info(GoodsValidate $validate, GoodsService $service): Json
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
     * @param GoodsService $service
     * @param GoodsValidate $validate
     * @return Json
     */
    public function edit(GoodsService $service, GoodsValidate $validate): Json
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
     * @param GoodsService $service
     * @param GoodsValidate $validate
     * @return Json
     */
    public function del(GoodsService $service, GoodsValidate $validate): Json
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
