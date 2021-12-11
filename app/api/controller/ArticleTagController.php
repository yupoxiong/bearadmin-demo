<?php
/**
 * 文章标签控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleTagService;
use app\common\validate\ArticleTagValidate;
use app\api\exception\ApiServiceException;

class ArticleTagController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleTagService $service
     * @return Json
     */
    public function index(ArticleTagService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article_tag' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleTagValidate $validate
     * @param ArticleTagService $service
     * @return Json
     */
    public function add(ArticleTagValidate $validate, ArticleTagService $service): Json
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
     * @param ArticleTagValidate $validate
     * @param ArticleTagService $service
     * @return Json
     */
    public function info(ArticleTagValidate $validate, ArticleTagService $service): Json
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
     * @param ArticleTagService $service
     * @param ArticleTagValidate $validate
     * @return Json
     */
    public function edit(ArticleTagService $service, ArticleTagValidate $validate): Json
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
     * @param ArticleTagService $service
     * @param ArticleTagValidate $validate
     * @return Json
     */
    public function del(ArticleTagService $service, ArticleTagValidate $validate): Json
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
