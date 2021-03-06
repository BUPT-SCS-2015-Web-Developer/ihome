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
- name : 用户昵称
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
- is_verify：是否审核过，可以发布
- fire : 热度
- reply : 官方回复内容
- **待解决**：审核通过的问题自动生成关键字：jieba分词？

## 辅助表

表iHome_praise 记录点赞与关注相关

* id : 自增段_主键
* user_id : 用户id
* question_id : 对应问题id【索引】
* type : 是点赞还是关注 praise和follow
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
    'type' : 类型 1为生活服务 2为问题反馈 留空则两者皆回复
      'sortby' : 默认为time 可选参数为time 与 hot 若为recommended则为推荐问题(按热度排列)
      'start' : 从第几个结果开始，默认为0，则传回前十个；10则传回10~19。
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
        'content' : 内容
        'create_user' : 创建者id
        'create_time' : 创建时间
        'hot' : 热度,
        'reply' : 回复内容【问题反馈独有】,
        'is_praise' : 是否点赞,
     	  'is_follow' : 是否关注,
        'comment' :[
          {
            'floor' : 楼层【注意，有可能有的楼层被删除】,
      	  'user_id' : 回复者id,
      	  'user_name' : 回复者昵称,
      	  'reply_floor' : 是否回复某一楼层
          },
    	    {
            下一个回复【评论为生活服务独有】
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
  请求参数:
  管理员 可传递参数id，查看该学号同学信息，不传参则返回个人信息
  普通用户返回个人信息

  请求成功返回:
  {
    'status':'success',
    'data' :{
      'school_id' : 学生学号,
  	'school_name' : 用户昵称,
  	'type' : 用户类型，
      'follow':[
        156,
        456
      ]
    }
  }

  管理员查询失败
  异常status返回error，查不到此人返回failed  
  ```

  praise.php

  ```json
  用于点赞与取消赞，关注与取消关注
  请求参数:
  {
    'id' : 问题id,
    'type' : praise或follow
  }

  成功返回
  {
    'status' : 'success'
  }

  失败返回
  {
    'status' : 'error'
  }
  ```

  classify.php

  获得未分配的问题

  followalert.php

  获得用户关注的问题的新信息

  followlist.php

  用户关注问题的列表

  haveread.php

  用户请求此页面后，所有新信息置为已阅

  reply.php

  各部门回答问题，必要参数 id 问题id  reply 回复内容

  setprocessor.php

  分配问题 必要参数id 问题id， processor 处理问题的部门，可选项：

  ```json
  '管委会','学生事务部','教务部','安全保卫部','后勤保障部','宣传部','医务室','图书馆'
  ```

  ​

