<?php
/**
 * 文章控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\Tag;
use app\common\model\User;
use app\common\model\Article;
use app\common\model\ArticleCategory;
use app\common\validate\ArticleValidate;

class ArticleController extends AdminBaseController
{

    /**
     * 列表
     * @param Request $request
     * @param Article $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, Article $model): string
    {
        $param = $request->param();
        $data  = $model->with(['user', 'article_category',])->withCount(['articleVote','articleComment','articleCollection'])->scope('where', $param)
            ->paginate([
                'list_rows' => $this->admin['admin_list_rows'],
                'var_page'  => 'page',
                'query'     => $request->get(),
            ]);
        // 关键词，排序等赋值
        $this->assign($request->get());

        $this->assign([
            'data'  => $data,
            'page'  => $data->render(),
            'total' => $data->total(),

        ]);
        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @param Article $model
     * @param ArticleValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, Article $model, ArticleValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('admin_add')->check($param);
            if (!$validate_result) {
                return admin_error($validate->getError());
            }

            $param['content'] = $request->param(false)['content'];

            $result = $model::create($param);

            $result->tag()->saveAll($param['tag']);

            $url = URL_BACK;
            if (isset($param['_create']) && (int)$param['_create'] === 1) {
                $url = URL_RELOAD;
            }
            return $result ? admin_success('添加成功', [], $url) : admin_error();
        }
        $this->assign([
            'user_list'             => (new User)->select(),
            'article_category_list' => $this->getSelectList(new ArticleCategory),
            'tag_list'              => (new Tag())->select(),

        ]);

        return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     * @param Request $request
     * @param Article $model
     * @param ArticleValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, Article $model, ArticleValidate $validate)
    {
        $data = $model->findOrEmpty($id);
        if ($request->isPost()) {
            $param = $request->param();
            $check = $validate->scene('admin_edit')->check($param);
            if (!$check) {
                return admin_error($validate->getError());
            }
            $param['content'] = $request->param(false)['content'];

            $result = $data->save($param);

            $data->tag()->detach();

            $data->tag()->saveAll($param['tag']);

            return $result ? admin_success('修改成功', [], URL_BACK) : admin_error('修改失败');
        }

        $this->assign([
            'data'                  => $data,
            'user_list'             => (new User)->select(),
            'article_category_list' => $this->getSelectList(new ArticleCategory, $data->article_category_id),
            'tag_list'              => (new Tag())->select(),
        ]);

        return $this->fetch('add');
    }

    /**
     * 删除
     * @param mixed $id
     * @param Article $model
     * @return Json
     */
    public function del($id, Article $model): Json
    {
        $check = $model->inNoDeletionIds($id);
        if (false !== $check) {
            return admin_error('ID为' . $check . '的数据不能被删除');
        }

        $result = $model::destroy(static function ($query) use ($id) {
            /** @var Query $query */
            $query->whereIn('id', $id);
        });

        return $result ? admin_success('删除成功', [], URL_RELOAD) : admin_error('删除失败');
    }


}
