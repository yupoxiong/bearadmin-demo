<?php
/**
 * 后台自定义命令
 * @author yupoxiong<i@yupoxiong.com>
 */

declare (strict_types=1);


namespace app\command;

use app\admin\model\AdminUser;
use app\common\exception\CommonServiceException;
use app\common\service\StringService;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class AdminReset extends Command
{

    protected function configure()
    {
        $this->setName('admin:reset')
            ->addArgument('password', Argument::OPTIONAL, "新密码，可空")
            ->addOption('uid', null, Option::VALUE_REQUIRED, '需要修改的用户ID')
            ->setDescription('重置管理员密码');
    }

    /**
     * @throws CommonServiceException
     */
    protected function execute(Input $input, Output $output)
    {
        $password = trim((string)$input->getArgument('password'));
        $password = $password ?: StringService::getRandString(10, true, true, true, false);

        $uid = 1;
        if ($input->hasOption('uid')) {
            $uid = $input->getOption('uid');
        }

        $user = (new AdminUser())->where('id', '=', $uid)->findOrEmpty();
        if ($user->isEmpty()) {
            $output->error('用户不存在');
            return;
        }

        $user->password = $password;
        $result = $user->save();
        if($result){
            $output->info('密码重置成功，新密码为：'.$password);
            return;
        }

        $output->error('密码重置失败');
    }
}