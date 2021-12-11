<?php
/**
 * 文章评论控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleCommentService;
use app\common\validate\ArticleCommentValidate;
use app\api\exception\ApiServiceException;

class ArticleCommentController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleCommentService $service
     * @return Json
     */
    public function index(ArticleCommentService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article_comment' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleCommentValidate $validate
     * @param ArticleCommentService $service
     * @return Json
     */
    public function add(ArticleCommentValidate $validate, ArticleCommentService $service): Json
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
     * @param ArticleCommentValidate $validate
     * @param ArticleCommentService $service
     * @return Json
     */
    public function info(ArticleCommentValidate $validate, ArticleCommentService $service): Json
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
     * @param ArticleCommentService $service
     * @param ArticleCommentValidate $validate
     * @return Json
     */
    public function edit(ArticleCommentService $service, ArticleCommentValidate $validate): Json
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
     * @param ArticleCommentService $service
     * @param ArticleCommentValidate $validate
     * @return Json
     */
    public function del(ArticleCommentService $service, ArticleCommentValidate $validate): Json
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
