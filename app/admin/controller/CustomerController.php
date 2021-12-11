<?php
/**
 * 客户控制器
 */

namespace app\admin\controller;

use Exception;
use think\Request;
use think\db\Query;
use think\response\Json;
use app\common\model\Customer;
use app\common\validate\CustomerValidate;

class CustomerController extends AdminBaseController
{

    /**
     * 列表
     * @param Request $request
     * @param Customer $model
     * @return string
     * @throws Exception
     */
    public function index(Request $request, Customer $model): string
    {
        $param = $request->param();
        $data  = $model->scope('where', $param)
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
     * @param Customer $model
     * @param CustomerValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function add(Request $request, Customer $model, CustomerValidate $validate)
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
            'status_list' => Customer::STATUS_LIST,
        ]);

        return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     * @param Request $request
     * @param Customer $model
     * @param CustomerValidate $validate
     * @return string|Json
     * @throws Exception
     */
    public function edit($id, Request $request, Customer $model, CustomerValidate $validate)
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
            'status_list' => Customer::STATUS_LIST,
        ]);

        return $this->fetch('add');
    }

    /**
     * 删除
     * @param mixed $id
     * @param Customer $model
     * @return Json
     */
    public function del($id, Customer $model): Json
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
