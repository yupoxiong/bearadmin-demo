<?php
/**
 * 文章分类控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleCategoryService;
use app\common\validate\ArticleCategoryValidate;
use app\api\exception\ApiServiceException;

class ArticleCategoryController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleCategoryService $service
     * @return Json
     */
    public function index(ArticleCategoryService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article_category' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleCategoryValidate $validate
     * @param ArticleCategoryService $service
     * @return Json
     */
    public function add(ArticleCategoryValidate $validate, ArticleCategoryService $service): Json
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
     * @param ArticleCategoryValidate $validate
     * @param ArticleCategoryService $service
     * @return Json
     */
    public function info(ArticleCategoryValidate $validate, ArticleCategoryService $service): Json
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
     * @param ArticleCategoryService $service
     * @param ArticleCategoryValidate $validate
     * @return Json
     */
    public function edit(ArticleCategoryService $service, ArticleCategoryValidate $validate): Json
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
     * @param ArticleCategoryService $service
     * @param ArticleCategoryValidate $validate
     * @return Json
     */
    public function del(ArticleCategoryService $service, ArticleCategoryValidate $validate): Json
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
