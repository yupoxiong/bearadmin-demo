<?php
/**
 * 商品分类控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\GoodsCategory;
use app\common\validate\GoodsCategoryValidate;

class GoodsCategoryController extends AdminBaseController
{

    /**
     * 列表
     * @param GoodsCategory $model
     * @return string
     * @throws Exception
     */
    public function index(GoodsCategory $model): string
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
     * @param GoodsCategory $model
     * @param GoodsCategoryValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, GoodsCategory $model, GoodsCategoryValidate $validate)
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
     * @param GoodsCategory $model
     * @param GoodsCategoryValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, GoodsCategory $model, GoodsCategoryValidate $validate)
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
     * @param GoodsCategory $model
     * @return Json
     */
    public function del($id, GoodsCategory $model): Json
    {
        $check = $model->inNoDeletionIds($id);
        if (false !== $check) {
            return admin_error('ID为' . $check . '的数据不能被删除');
        }

        $have = $model->whereIn('parent_id', $id)->count();
        if ($have > 0) {
            return admin_error('该数据含有子数据，请删除子数据后再进行删除');
        }

        $result = $model::destroy(static function ($query) use ($id) {
            /** @var Query $query */
            $query->whereIn('id', $id);
        });

        return $result ? admin_success('删除成功', [], URL_RELOAD) : admin_error('删除失败');
    }
}
