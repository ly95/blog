---
layout: post
title: ubuntu记录所有用户操作日志
date: 2013-01-26 20:29:16
modified: 2014-06-17 12:19:55
tags: ubuntu
---

在/etc/profile.d/目录创建userlog.sh文件

{% highlight sh %}
sudo vi /etc/profile.d/userlog.sh
{% endhighlight %}

内容如下

{% highlight sh %}
PS1="`whoami`@`hostname`:"'[$PWD]'
history
USER_IP=`who -u am i 2>/dev/null| awk '{print $NF}'|sed -e 's/[()]//g'`
if [ "$USER_IP" = "" ]
then
USER_IP=`hostname`
fi
if [ ! -d /tmp/history ]
then
mkdir /tmp/history
chmod 777 /tmp/history
fi
if [ ! -d /tmp/history/${LOGNAME} ]
then
mkdir /tmp/history/${LOGNAME}
chmod 300 /tmp/history/${LOGNAME}
fi
export HISTSIZE=4096
DT=`date +"%Y%m%d_%H%M%S"`
export HISTFILE="/tmp/history/${LOGNAME}/${USER_IP} history.$DT"
chmod 600 /tmp/history/${LOGNAME}/*history* 2>/dev/null
{% endhighlight %}