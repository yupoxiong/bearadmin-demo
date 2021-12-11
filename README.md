# AdminDemo
> BearAdmin（基于ThinkPHP6.0版本）的Demo项目，要求PHP版本>=7.4

## 线上演示地址
[bearadmin-demo](https://demo.bearadmin.com/)

- 后台：https://demo.bearadmin.com/admin
- 账号：develop_admin
- 密码：Dev_Admin_0o0

## Demo项目源代码地址
[GitHub](https://github.com/yupoxiong/bearadmin-demo) |
[Gitee](https://gitee.com/yupoxiong/bearadmin-demo)

## 功能一览
### 登录模块
- token验证
- 图形验证码
- 极验滑动验证
- 登录重试限制
### 轮播模块
- 轮播管理
### 用户模块
- 用户管理
- 用户等级管理
### 论坛模块
- 文章管理
- 文章分类管理
- 标签管理
- 评论点赞记录查看
- 聊天室功能
### 商城模块
- 品牌管理
- 商品管理
- 商品分类管理
- 订单管理
- 快递管理
- 支付方式管理
### 杂项演示
- 邮件发送
- 短信发送
- 二维码生成
### 微信模块
- 服务端验证
- 接收 & 回复用户消息
- 获取用户信息
- 发送模版消息
- 统一下单
- 更多...
### 人事管理
- 员工管理
- 部门管理
- 职位管理
### 系统管理
- 用户管理
- 角色管理
- 菜单管理
- 操作日志
- 个人资料
- 代码生成
- 数据维护
- 设置配置


## Demo简介

> Demo线上版本并无太多限制，还请各位手下留情，请勿添加乱七八糟的数据或做较大的改动，如果需要体验完全可以把这份代码clone到本地自己运行。

- 本 Demo 基于最新的 BearAdmin 开发，代码开发用时大约几个小时，主要耗费时间在数据库设计，后期的优化等。如此快的开发速度是依赖于 BearAdmin 的代码自动生成功能。
- 开发项目的时候前期数据库设计一定要尽可能的考虑周全，可有效的提高后期开发的效率，此条仅供参考。
- 文章模块的文章与标签采用了多对多关联，有需要的可以看看。
- demo中增加了基于workerman的聊天室demo，启动命令为`php think chat start`有需要的可自行扩展开发。
- 设置配置目前有登录验证限制及后台用户密码强度检测及部分post请求验证token等功能，可自行查看相关模块。
- 忘记开发管理员密码可以使用命令`php think admin:reset`重置密码。
- 数据库文件放在项目根目录，名称为`sql.zip`可自行使用mysql工具导入。
- demo项目中代码生成添加了树形列表生成功能，可自行测试使用。

## 其他说明
本项目采用大量的开源代码，包括ThinkPHP，AdminLTE等等。
部分代码可能署名已被某些前辈去掉，我也没来得及去查找具体的作者，如果有需要修改的地方，可以与我取得联系，i#yupoxiong.com(手动替换#即可)。
在此，对所有用到的开源代码作者表示由衷的感谢。

交流QQ群：[480018279](//shang.qq.com/wpa/qunwpa?idkey=2e8674491df685dab9f634773b72ce8ed7df033aed7cbf194cda95dd4ad45737)

:stuck_out_tongue::bear::heart: