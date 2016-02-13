---
layout: post
title: "[MACOS] MYSQL Error : Thread stack overrun"
date: 2013-08-22 11:20:41
modified: 2014-06-17 11:50:52
tags: mysql
---
locahost执行一简单update语句的时候，遇见Mysql线程堆栈溢出。

完整错误提示：

{% highlight sh %}
Error : Thread stack overrun: 14616 bytes used of a 131072 byte stack, and 128000 bytes needed. Use 'mysqld --thread_stack=#' to specify a bigger stack.
{% endhighlight %}

本机环境：
max os 10.8.4
mysql-server55

修改my.conf设置
{% highlight sh %}
thread_stack = 132K
{% endhighlight %}

重启mysql-server服务

还是不行，提示
{% highlight sh %}
Error: Thread stack overrun: 14616 bytes used of a 135168 byte stack, and 128000 bytes needed. Use 'mysqld --thread_stack=#' to specify a bigger stack.
{% endhighlight %}

真是得寸进尺，索性改到160k，这次没问题了。

原因未知，主观觉得跟使用的客户端工具Navicat Premium有关。