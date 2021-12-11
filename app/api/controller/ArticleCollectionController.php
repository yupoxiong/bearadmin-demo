<?php
/**
 * 文章收藏控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleCollectionService;
use app\common\validate\ArticleCollectionValidate;
use app\api\exception\ApiServiceException;

class ArticleCollectionController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleCollectionService $service
     * @return Json
     */
    public function index(ArticleCollectionService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article_collection' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleCollectionValidate $validate
     * @param ArticleCollectionService $service
     * @return Json
     */
    public function add(ArticleCollectionValidate $validate, ArticleCollectionService $service): Json
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
     * @param ArticleCollectionValidate $validate
     * @param ArticleCollectionService $service
     * @return Json
     */
    public function info(ArticleCollectionValidate $validate, ArticleCollectionService $service): Json
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
     * @param ArticleCollectionService $service
     * @param ArticleCollectionValidate $validate
     * @return Json
     */
    public function edit(ArticleCollectionService $service, ArticleCollectionValidate $validate): Json
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
     * @param ArticleCollectionService $service
     * @param ArticleCollectionValidate $validate
     * @return Json
     */
    public function del(ArticleCollectionService $service, ArticleCollectionValidate $validate): Json
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
