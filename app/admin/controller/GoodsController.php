<?php
/**
 * 商品控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\Attr;
use app\common\model\Goods;
use app\common\model\Brand;
use app\common\model\AttrGroup;
use app\common\model\GoodsCategory;
use app\common\validate\GoodsValidate;

class GoodsController extends AdminBaseController
{
    /**
     * 列表
     * @param Request $request
     * @param Goods $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, Goods $model): string
    {
        $param = $request->param();
        $data  = $model->with(['goods_category', 'brand',])->scope('where', $param)
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
     * @param Goods $model
     * @param GoodsValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, Goods $model, GoodsValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('admin_add')->check($param);
            if (!$validate_result) {
                return admin_error($validate->getError());
            }

            $param['attr'] = $this->formatAttr($param);
            $param['detail'] = $request->param(false)['detail'];

            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && (int)$param['_create'] === 1) {
                $url = URL_RELOAD;
            }
            return $result ? admin_success('添加成功', [], $url) : admin_error();
        }
        $this->assign([
            'goods_category_list' => $this->getSelectList(new GoodsCategory()),
            'brand_list'          => (new Brand)->select(),
        ]);
        return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     * @param Request $request
     * @param Goods $model
     * @param GoodsValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, Goods $model, GoodsValidate $validate)
    {
        $data = $model->findOrEmpty($id);
        if ($request->isPost()) {
            $param = $request->param();
            $check = $validate->scene('admin_edit')->check($param);
            if (!$check) {
                return admin_error($validate->getError());
            }

            // 规格处理
            $param['attr'] = $this->formatAttr($param);
            $param['detail'] = $request->param(false)['detail'];

            $result = $data->save($param);

            return $result ? admin_success('修改成功', [], URL_BACK) : admin_error('修改失败');
        }

        $this->assign([
            'data'                => $data,
            'goods_category_list' => $this->getSelectList(new GoodsCategory(), $data->goods_category_id),
            'brand_list'          => (new Brand)->select(),
        ]);

        return $this->fetch('add');
    }

    /**
     * 删除
     * @param mixed $id
     * @param Goods $model
     * @return Json
     */
    public function del($id, Goods $model): Json
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

    protected function formatAttr($param)
    {
        if ($param['use_attr']) {
            foreach ($param['attr_data'] as $key => $value) {

                foreach ($value['attr_info'] as $info_key => $info_value) {
                    if (!$info_value['attr_id']) {
                        //如果是新添加的
                        $current_group = $info_value['attr_group'];
                        $have_group    = (new AttrGroup)->where('name', '=', $current_group)->find();
                        if (!$have_group) {
                            $have_group = AttrGroup::create(['name' => $current_group]);
                        }
                        $current_name = $info_value['attr_name'];
                        $have_name    = (new Attr)->where('attr_group_id', '=', $have_group->id)
                            ->where('name', '=', $current_name)
                            ->find();
                        if (!$have_name) {
                            $have_name = Attr::create([
                                'attr_group_id' => $have_group->id,
                                'name'          => $current_name,
                            ]);
                        }
                        $param['attr_data'][$key]['attr_info'][$info_key] ['attr_id'] = $have_name->id;
                    }
                }
            }
        } else {
            $default_attr       = (new Attr)->where('is_default', '=', 1)->find();
            $param['attr_data'] = [[
                'attr_info' => [
                    [
                        'attr_group' => $default_attr->attrGroup->name ?? '',
                        'attr_name'  => $default_attr->name,
                        'attr_id'    => $default_attr->id,
                    ]

                ],
                'number'    => 0,
                'price'     => 0,
            ]];
        }

        return $param['attr_data'];
    }
}
