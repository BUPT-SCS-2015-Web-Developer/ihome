# 北邮iHome

## 目录

1. 个人信息
2. 生活服务
3. 问题反馈
4. 辅助表

## 个人信息

表 iHome_user

- school_id : 学生学号
- type : 用户类型

## 生活服务/问题反馈

表 iHome_question

- id : 问题唯一id号
- subject : 主题
- content : 内容
- create_time : 创建时间
- create_user : 创建者id
- is_reply : 问题反馈是否回复
- is_anonymous : 是否匿名【此功能是否直接设置为匿名】
- fire : 热度
- reply : 官方回复内容
- **待解决**：审核通过的问题自动生成关键字：jieba分词？

## 辅助表

表iHome_praise 记录点赞与关注相关

* id : 自增段_主键
* user_id : 用户id
* question_id : 对应问题id【索引】
* type : 是关注还是点赞
* status : True正常状态 False已取消/已删除

表iHome_comment

【这里讨论一下 界面展示的时候是否按缩进形式】

- id : 自增段_主键
- question_id : 问题父id
- user_id : 回复用户id
- content : 回复内容
- floor : 本回复楼层
- reply_floor : 回复哪一楼层
- status : True正常状态 False已取消/已删除

