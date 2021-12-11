<?php
/**
 * 文章点赞控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\Article;
use app\common\model\ArticleVote;

class ArticleVoteController extends AdminBaseController
{

    /**
     * 列表
     * @param Request $request
     * @param ArticleVote $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, ArticleVote $model): string
    {
        $param = $request->param();
        $data  = $model->with(['user', 'article',])->scope('where', $param)
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
     * @param ArticleVote $model
     * @return Json
     */
    public function del($id, ArticleVote $model): Json
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
