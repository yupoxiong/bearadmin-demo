<?php
/**
 * 文章点赞控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleVoteService;
use app\common\validate\ArticleVoteValidate;
use app\api\exception\ApiServiceException;

class ArticleVoteController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleVoteService $service
     * @return Json
     */
    public function index(ArticleVoteService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article_vote' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleVoteValidate $validate
     * @param ArticleVoteService $service
     * @return Json
     */
    public function add(ArticleVoteValidate $validate, ArticleVoteService $service): Json
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
     * @param ArticleVoteValidate $validate
     * @param ArticleVoteService $service
     * @return Json
     */
    public function info(ArticleVoteValidate $validate, ArticleVoteService $service): Json
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
     * @param ArticleVoteService $service
     * @param ArticleVoteValidate $validate
     * @return Json
     */
    public function edit(ArticleVoteService $service, ArticleVoteValidate $validate): Json
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
     * @param ArticleVoteService $service
     * @param ArticleVoteValidate $validate
     * @return Json
     */
    public function del(ArticleVoteService $service, ArticleVoteValidate $validate): Json
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
