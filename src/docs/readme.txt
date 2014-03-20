2013-03-20
1. 完成模型层基类base_model的封装
1. 完成个人的豆瓣阅读记录的抓取

2013-03-21
1. 完成通用的分页功能
2. 完成标签/分类的结构设计

2013-03-22
1. 完成我读的页面数据显示和分页
2. 整理了需要身份验证的controller基类Authed_Controller, 需要认证的controller需要继承Authed_Controller

2013-03-23
1. 升级了jquery, jquery-ui，加入了基于bootstrap的几个框架modal，fuelux
2. 增肌了图书的评分控件
3. 修改了豆瓣上我读的书的同步功能
4. 页面划分三部分：data, layout, widgets，暂时在/books上测试 /books返回页面 /books.data 获得数据 /books.layout 返回layout...
5. 升级了用户的豆瓣阅读同步工具

2013-03-24
1. 增加timer工具
2. 解决文件上传，用户上传自己的avatar头像
3. 完成base_model的save_or_update功能
4. 修改了图书旁边的读书状态的用户的头像

2013-03-26
1. 增加了读书计划的页面

2013-03-31
1. 增加了alexa工具，/alexa访问

2013-04-01
1. 整理菜单，增加写作

2013-04-02
1. 扩展了Router的功能，增加了MY_Router
2. 增加了后端的用户、群组、资源权限问题

2013-04-04
1. 修复了评论的bug
2. 增加了分享url链接，生成一个带缩略图的页面

2013-04-06
1. 增加了部分分类、标签、菜单功能
2. 增加了箴言功能
3. 增加了一个个人页面，个人的八大财富轮盘：/me, 功能有待探索和实现
4. 扇贝禁止了X-Frame-Options:DENY, 删除扇贝的iframe页面

2013-04-07
robin:
	4/7晚准备进一步细化计划、任务、和番茄钟之间的关系。目前/book/958 这个页面， /plan/make/book/958, /plans, /reading/plan/break_down/28, reading/tasks,之间的关系还需要进一步整理，整个流程下来的步骤明天定义好。要做的事情：
	1. 日历上拖动和分解计划两个之间的关系没有处理；
	2. 任务优先级没有；
	3. 任务的计划和执行结果的对照没有；
	4. 当日计划和当日执行结果；
	5. 番茄钟重启，加载下一个任务功能没有；
	6. 番茄钟显示需调整优化；
	
2013-04-10
1. 优化架构

2013-04-17
1. 整理了阅读功能下面的二级菜单链接

用phantomjs解析网页

目标管理

todolist:
时间管理
    番茄钟

精力管理

人脉管理

理财管理

其他：
社交工具管理起来
https://github.com/lifesinger/lifesinger.github.com/issues/120
