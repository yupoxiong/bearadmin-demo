<?php
/**
 * 文章评论控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\Article;
use app\common\model\ArticleComment;

class ArticleCommentController extends AdminBaseController
{

    /**
     * 列表
     * @param Request $request
     * @param ArticleComment $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, ArticleComment $model): string
    {
        $param = $request->param();
        $data  = $model->with(['user', 'article',])
            ->where('parent_id', '=', 0)
            ->scope('where', $param)
            ->paginate([
                'list_rows' => $this->admin['admin_list_rows'],
                'var_page'  => 'page',
                'query'     => $request->get(),
            ]);
        // 关键词，排序等赋值
        $this->assign($request->get());

        $this->assign([
            'article' => (new Article)->find($param['article_id']),
            'data'    => $data,
            'page'    => $data->render(),
            'total'   => $data->total(),

        ]);
        return $this->fetch();
    }

    /**
     * 删除
     * @param mixed $id
     * @param ArticleComment $model
     * @return Json
     */
    public function del($id, ArticleComment $model): Json
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
