# 北邮iHome

## 目录

1. 个人信息
2. 生活服务/问题反馈
3. 辅助表
4. 界面安排
5. API

## 个人信息

表 iHome_user

- yiban_id : 易班id
- school_id : 学生学号
- school_name : 用户昵称
- type : 用户类型

## 生活服务/问题反馈

表 iHome_question

- id : 问题唯一id号
- type : 生活服务为1 问题反馈为2
- subject : 主题
- content : 内容
- create_time : 创建时间
- create_user : 创建者id
- is_reply : 问题反馈是否回复
- is_anonymous : 是否匿名【此功能是否直接设置为匿名】
- is_judge：是否审核过，可以发布
- hot : 热度
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


## 界面安排

- index.php 主页
- question.php 问题页
- search.php 搜索结果页
- life.php 生活列表详情
- feedback.php 问题反馈详情
- 还有个人页面以及管理页面【待定】

API

**API均位于API/目录下**

- GetList.php

  ```json
  请求参数
  {
    'text' : 搜索关键词 留空则不添加关键词
    'type' : 类型 1为生活服务 2为问题反馈 留空则两类型均返回
    'sortby' : 默认为time 可选参数为time 与 hot
  }
  请求成功返回
  {
    'status' : 'success',
    'data' : [
      {
        'id' : 问题唯一id号
        'type' : 1为生活服务，2为问题反馈
  	  'subject' : 主题
        'summary' : 内容【是否需要这个?】
        'create_user' : 创建者id
        'hot' : 热度
      },
      {
        balabala
      }
    ]
  }
  失败返回
  {
    'status' : 'error'
  }
  ```

  - GetQuestion.php

  ```json
  请求参数
  {
    'id' : 问题标识号
  }

  请求成功返回
  {
    'status' : 'success',
    'data' : {
        'id' : 问题唯一id号
        'type' : 1为生活服务，2为问题反馈
  	  'subject' : 主题
        'summary' : 内容【是否需要这个?】
        'create_user' : 创建者id
        'hot' : 热度
        'comment' :[
          {
            'floor' : 楼层【注意，有可能有的楼层被删除】,
      	  'user_id' : 回复者id,
      	  'user_name' : 回复者昵称,
      	  'reply_floor' : 是否回复某一楼层
          },
    	    {
            下一个回复
    	    }
        ]
      } 
  }
  失败返回
  {
    'status' : 'error'
  }
  ```

  Commit.php

  ```json
  用于添加评论
  请求参数:
  {
    'id' : 问题标识号,
    'user_id' : 用户id【用于与session校验，切不可单使用此数据】,
    'content' : 回复内容,
    'reply_floor' : 可选择回复的楼层
  }

  请求成功返回
  {
    'status' : 'success'
  }
  失败返回
  {
    'status' : 'error'
  }
  ```

  NewQuestion.php

  ```json
  创建问题
  请求参数:
  {
    'user_id' : 用户id【用于session校验，切不可单独使用此数据】,
    'type' : 是生活服务还是反馈问题，
    'subject' : 主题,
    'content' : 内容,
    'is_anonymous' : 是否匿名
  }

  请求成功返回【这里问题还没有审核通过的情况下，他提完问题是看不到自己的问题的？】
  {
    'status' : 'success'
  }
  失败返回
  {
    'status' : 'error'
  }

  ```

  User.php

  ```json
  根据session获得用户信息
  请求参数:无

  请求成功返回:
  {
    'status':'success',
    'data' :{
      'school_id' : 学生学号,
  	'school_name' : 用户昵称,
  	'type' : 用户类型
    }
  }
  ```

  ​