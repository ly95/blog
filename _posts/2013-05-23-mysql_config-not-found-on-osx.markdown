---
layout: post
title: mysql_config not found on osx10.8
date: 2013-05-23 15:30:17
modified: 2014-06-17 11:52:38
tags: mysql python
---

系统：osx 10.8.3

{% highlight sh %}
pip install mysql-python
{% endhighlight %}

抛出异常

{% highlight sh %}
EnvironmentError: mysql_config not found
{% endhighlight %}

由于mysql是macport安装，版本55，所以问题就简单了

只需运行命令

{% highlight sh %}
sudo ln -s /opt/local/bin/mysql_config5 /opt/local/bin/mysql_config
{% endhighlight %}