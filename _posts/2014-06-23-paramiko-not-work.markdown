---
layout: post
title: paramiko命令执行失败
description: Not a git repository
date: 2014-06-23 14:59:56
modified: 2015-02-17 11:33:29
tags: python ssh
---

一个测试站，使用git管理代码。每次同步需要ssh连接更新代码。用python写小程序来完成重复的工作。

{% highlight python linenos %}
import paramiko

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
client.connect('xxxx', 22, username='nobody', password='', timeout=4)
stdin, stdout, stderr = client.exec_command("git pull /var/www/sites")
print stdout.read()
print stderr.read()
client.close()
{% endhighlight %}

结果输出

{% highlight sh linenos %}
fatal: Not a git repository (or any of the parent directories): .git
{% endhighlight %}

最后修改后，执行成功。

{% highlight python linenos %}
stdin, stdout, stderr = client.exec_command("cd /var/www/sites;git pull")
{% endhighlight %}
