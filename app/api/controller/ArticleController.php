<?php
/**
 * 文章控制器
 */

namespace app\api\controller;

use think\response\Json;
use app\api\service\ArticleService;
use app\common\validate\ArticleValidate;
use app\api\exception\ApiServiceException;

class ArticleController extends ApiBaseController
{
    /**
     * 列表
     * @param ArticleService $service
     * @return Json
     */
    public function index(ArticleService $service): Json
    {
        try {
            $data   = $service->getList($this->param, $this->page, $this->limit);
            $result = [
                'article' => $data,
            ];

            return api_success($result);
        } catch (ApiServiceException $e) {
            return api_error($e->getMessage());
        }
    }

    /**
     * 添加
     * @param ArticleValidate $validate
     * @param ArticleService $service
     * @return Json
     */
    public function add(ArticleValidate $validate, ArticleService $service): Json
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
     * @param ArticleValidate $validate
     * @param ArticleService $service
     * @return Json
     */
    public function info(ArticleValidate $validate, ArticleService $service): Json
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
     * @param ArticleService $service
     * @param ArticleValidate $validate
     * @return Json
     */
    public function edit(ArticleService $service, ArticleValidate $validate): Json
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
     * @param ArticleService $service
     * @param ArticleValidate $validate
     * @return Json
     */
    public function del(ArticleService $service, ArticleValidate $validate): Json
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
