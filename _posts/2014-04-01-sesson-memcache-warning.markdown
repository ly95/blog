---
layout: post
title: session+memcache问题
date: 2014-04-01 18:42:56
modified: 2015-02-17 11:41:51
tags: php memcache
---
配置php.ini

{% highlight sh linenos %}
session.save_handler = memcache
session.save_path ="localhost:11211"
{% endhighlight %}

日志提示

{% highlight sh linenos %}
Warning: session_start() [function.session-start]: Keycannot be empty
{% endhighlight %}

原因未知，先记录一下。