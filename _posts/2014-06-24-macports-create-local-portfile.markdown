---
layout: post
title: macports 创建本地 Portfile
date: 2014-06-24 14:06:14
modified: 2015-02-17 11:26:00
tags: macport macos
---

使用macport安装编译的时候希望能自定义configure。

直接修改macports官方Portfile不方便管理，创建自定义的本地Portfile是最好选择。编辑文件/opt/local/etc/macports/sources.conf找到这行

{% highlight sh %}
rsync://rsync.macports.org/release/tarballs/ports.tar [default]
{% endhighlight %}

上面增加一行

{% highlight sh %}
file:///opt/local/portfiles
{% endhighlight %}

创建资源

{% highlight sh %}
sudo mkdir -p /opt/local/portfiles/ports/www/my_nginx
cd /opt/local/portfiles/ports/www/my_nginx
sudo cp /opt/local/var/macports/sources/rsync.macports.org/release/tarballs/ports/www/nginx/Portfile Portfile
{% endhighlight %}

编辑Portfile

{% highlight sh %}
vi Portfile
{% endhighlight %}

找到configure.args-append就可以修改configure，最后加入macport索引

{% highlight sh %}
cd /opt/local/portfiles
portindex
{% endhighlight %}

运行命令进行测试

{% highlight sh %}
port search my_nginx
{% endhighlight %}
