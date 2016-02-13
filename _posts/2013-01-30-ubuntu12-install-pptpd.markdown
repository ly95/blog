---
layout: post
title: Ubuntu12.10 安装 pptpd 实录
date: 2013-01-30 15:58:15
modified: 2014-07-22 01:53:17
tags: pptpd ubuntu vpn
---

切换至root帐号下

安装pptd

{% highlight sh linenos %}
apt-get install pptpd -y
{% endhighlight %}

配置DNS

{% highlight sh linenos %}
vi /etc/ppp/pptpd-options
{% endhighlight %}

{% highlight sh linenos %}
ms-dns 8.8.8.8
{% endhighlight %}

分配客户端虚拟IP

{% highlight sh linenos %}
vi /etc/pptpd.conf
{% endhighlight %}

取消注释最后2行

{% highlight sh linenos %}
#localip 192.168.0.1
#remoteip 192.168.0.234-238,192.168.0.245
#or
localip 192.168.0.234-238,192.168.0.245
remoteip 192.168.1.234-238,192.168.1.245
{% endhighlight %}

添加客户端帐号

{% highlight sh linenos %}
vi /etc/ppp/chap-secrets
{% endhighlight %}

帐号 服务 密码 IP

{% highlight sh linenos %}
test * test *
{% endhighlight %}

路由规则设置ipv4转发

{% highlight sh linenos %}
vi /etc/sysctl.conf
{% endhighlight %}

找到“net.ipv4.ip_forward”所在行，设置为1

{% highlight sh linenos %}
net.ipv4.ip_forward = 1
{% endhighlight %}

更新规则

{% highlight sh linenos %}
sysctl -p
{% endhighlight %}

iptables转发设置

{% highlight sh linenos %}
iptables -P FORWARD ACCEPT
/sbin/iptables --table nat -A POSTROUTING -o eth0 -j MASQUERADE
{% endhighlight %}

最后重启

{% highlight sh linenos %}
/etc/init.d/pptpd restart
netstat -anp | grep pptpd
{% endhighlight %}

pptpd已经在监听1723端口说明一切正常