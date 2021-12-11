<?php
/**
 * 文章分类控制器
 */

namespace app\admin\controller;

use app\common\model\Article;
use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\ArticleCategory;
use app\common\validate\ArticleCategoryValidate;

class ArticleCategoryController extends AdminBaseController
{

    /**
     * 列表
     * @param ArticleCategory $model
     * @return string
     * @throws Exception
     */
    public function index(ArticleCategory $model): string
    {
        $data = $this->getTreeList($model);

        $this->assign([
            'data' => $data,
        ]);
        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @param ArticleCategory $model
     * @param ArticleCategoryValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, ArticleCategory $model, ArticleCategoryValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('admin_add')->check($param);
            if (!$validate_result) {
                return admin_error($validate->getError());
            }

            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && (int)$param['_create'] === 1) {
                $url = URL_RELOAD;
            }
            return $result ? admin_success('添加成功', [], $url) : admin_error();
        }
        $this->assign([
            'parent_list' => $this->getSelectList($model),
        ]);

        return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     * @param Request $request
     * @param ArticleCategory $model
     * @param ArticleCategoryValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, ArticleCategory $model, ArticleCategoryValidate $validate)
    {
        $data = $model->findOrEmpty($id);
        if ($request->isPost()) {
            $param = $request->param();
            $check = $validate->scene('admin_edit')->check($param);
            if (!$check) {
                return admin_error($validate->getError());
            }

            $result = $data->save($param);

            return $result ? admin_success('修改成功', [], URL_BACK) : admin_error('修改失败');
        }

        $this->assign([
            'data'        => $data,
            'parent_list' => $this->getSelectList($model, $data->parent_id),
        ]);

        return $this->fetch('add');
    }

    /**
     * 删除
     * @param mixed $id
     * @param ArticleCategory $model
     * @return Json
     */
    public function del($id, ArticleCategory $model): Json
    {
        $check = $model->inNoDeletionIds($id);
        if (false !== $check) {
            return admin_error('ID为' . $check . '的分类不能被删除');
        }

        $son_count = $model->whereIn('parent_id', $id)->count();
        if ($son_count > 0) {
            return admin_error('该分类含有子分类，请删除子分类后再进行删除');
        }

        $article_count = (new Article())->where('article_category_id','=', $id)->count();
        if ($article_count > 0) {
            return admin_error('该分类下有文章，请删除文章后再进行删除');
        }

        $result = $model::destroy(static function ($query) use ($id) {
            /** @var Query $query */
            $query->whereIn('id', $id);
        });

        return $result ? admin_success('删除成功', [], URL_RELOAD) : admin_error('删除失败');
    }
}
