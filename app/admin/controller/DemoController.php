<?php
/**
 *
 * @author yupoxiong<i@yupoxiong.com>
 */

declare (strict_types=1);

namespace app\admin\controller;

use Exception;
use think\Request;
use think\response\Json;
use Overtrue\EasySms\EasySms;
use PHPMailer\PHPMailer\PHPMailer;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class DemoController extends AdminBaseController
{

    /**
     * 邮件页面
     * @throws Exception
     */
    public function email(): string
    {
        return $this->fetch();
    }


    /**
     * 发送邮件功能
     * @param Request $request
     * @return Json
     */
    public function sendEmail(Request $request): Json
    {
        $param = $request->param();

        $config = config('email.smtp');
        $mail   = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {

            $address      = $param['address'];
            $subject      = $param['subject'];
            $content      = $param['content'];
            $full_content = $request->param(false)['content'];

            //服务器配置
            $mail->CharSet   = "UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host       = $config['host'];                // SMTP服务器
            $mail->SMTPAuth   = true;                      // 允许 SMTP 认证
            $mail->Username   = $config['username'];                // SMTP 用户名  即邮箱的用户名
            $mail->Password   = $config['password'];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port       = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom($config['address'], $config['name']);  //发件人
            $mail->addAddress($address, $address);  // 收件人
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $mail->addReplyTo($config['address'], $config['name']); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            //$mail->addAttachment(app()->getRootPath() . 'public/uploads/attachment/20190902/6a673f554c694a41971fca94c7503315.jpg', 'test.jpg');    // 发送附件并且重命名

            //Content
            $mail->isHTML(true);  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $subject;
            $mail->Body    = $full_content;
            $mail->AltBody = $content;

            $mail->send();
            $result = true;
            $msg    = '邮件发送成功';
        } catch (Exception $e) {
            $msg    = '邮件发送失败,错误信息:' . $mail->ErrorInfo;
            $result = false;
        }

        return $result ? admin_success('成功',[], URL_RELOAD) : admin_error($msg);
    }


    /**
     * 短信页面
     * @throws Exception
     */
    public function sms(): string
    {
        return $this->fetch();
    }

    /**
     * 发送短信功能
     * @param Request $request
     * @return Json
     */
    public function sendSms(Request $request): Json
    {
        $param   = $request->param();
        $config  = config('sms');
        $easySms = new EasySms($config);

        try {
            $result  = $easySms->send($param['mobile'], [
                'template' => 'SMS_001',
                'data'     => [
                    'code' => 543260
                ],
            ]);

            if ( $result['aliyun']['status'] === 'success') {
                return admin_success('发送成功');

            }

            return admin_error('发送失败');
        } catch (Exception $e) {
            $msg     = $e->getMessage();
            return admin_error($msg);
        }

    }

    /**
     * 二维码页面
     * @throws Exception
     */
    public function qrcode(): string
    {
        return $this->fetch();
    }


    /**
     * 生成二维码功能
     * @param Request $request
     * @return Json
     */
    public function createQrCode(Request $request): Json
    {
        $param = $request->param();

        $content = $param['content'] ?? '麻烦输入内容OK？';


        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($content)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->logoPath(app()->getRootPath().'public/static/admin/images/avatar.png')
            ->labelText('这是标签，可自定义')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        $result->saveToFile(app()->getRootPath() . 'public/uploads/qrcode-demo-save.jpg');

        $qrcode_url = '/uploads/qrcode-demo-save.jpg';

        return admin_success('生成成功', ['qrcode' => $qrcode_url], URL_CURRENT);
    }
}
