<?php
/**
 * 订单控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\User;
use app\common\model\Order;
use app\common\model\Express;
use app\common\validate\OrderValidate;

class OrderController extends AdminBaseController
{

    /**
     * 列表
     * @param Request $request
     * @param Order $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, Order $model): string
    {
        $param = $request->param();
        $data  = $model->with(['user', 'province', 'city', 'district', 'street', 'express',])->scope('where', $param)
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
     * @param Order $model
     * @param OrderValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, Order $model, OrderValidate $validate)
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
            'user_list'     => User::select(),
            'express_list'  => Express::select(),

        ]);

        return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     * @param Request $request
     * @param Order $model
     * @param OrderValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, Order $model, OrderValidate $validate)
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
            'data'          => $data,
            'user_list'     => User::select(),
            'express_list'  => Express::select(),

        ]);

        return $this->fetch('add');
    }

    /**
     * 删除
     * @param mixed $id
     * @param Order $model
     * @return Json
     */
    public function del($id, Order $model): Json
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


    /**
     * 订单详情
     * @throws Exception
     */
    public function detail($id, Order $model): string
    {
        $data = $model->findOrEmpty($id);
        $this->assign([
            'data' => $data
        ]);

        return $this->fetch();
    }


}
