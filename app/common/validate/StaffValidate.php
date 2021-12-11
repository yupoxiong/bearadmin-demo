<?php
/**
 * 员工验证器
 */

namespace app\common\validate;

class StaffValidate extends CommonBaseValidate
{
    protected $rule = [
            'avatar|照片' => 'require',
    'name|姓名' => 'require',
    'department_id|部门' => 'require',
    'position_id|职位' => 'require',
    'job_number|工号' => 'require',
    'mobile|手机号' => 'require',
    'email|邮箱' => 'require',
    'birthday|生日' => 'require',
    'hired_date|入职日期' => 'require',
    'is_boss|是否为老板' => 'require',
    'is_leader|是否所属部门领导' => 'require',
    'sort_number|排序' => 'require',
    'status|是否启用' => 'require',

    ];

    protected $message = [
            'avatar.required' => '照片不能为空',
    'name.required' => '姓名不能为空',
    'department_id.required' => '部门不能为空',
    'position_id.required' => '职位不能为空',
    'job_number.required' => '工号不能为空',
    'mobile.required' => '手机号不能为空',
    'email.required' => '邮箱不能为空',
    'birthday.required' => '生日不能为空',
    'hired_date.required' => '入职日期不能为空',
    'is_boss.required' => '是否为老板不能为空',
    'is_leader.required' => '是否所属部门领导不能为空',
    'sort_number.required' => '排序不能为空',
    'status.required' => '是否启用不能为空',

    ];

    protected $scene = [
        'admin_add'     => ['avatar', 'name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number', 'status', ],
        'admin_edit'    => ['id', 'avatar', 'name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number', 'status', ],
        'admin_del'     => ['id', ],
        'admin_disable' => ['id', ],
        'admin_enable'  => ['id', ],
        'api_add'       => ['avatar', 'name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number', 'status', ],
        'api_info'      => ['id', ],
        'api_edit'      => ['id', 'avatar', 'name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number', 'status', ],
        'api_del'       => ['id', ],
        'api_disable'   => ['id', ],
        'api_enable'    => ['id', ],
    ];
}
