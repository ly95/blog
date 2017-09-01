---
layout: post
title: Ubuntu12.10安装日志分析工具AWStats
date: 2012-12-08 18:18:39
modified: 2014-06-17 14:23:15
categories: 笔记
tags: Ubuntu
---

安装

```sh
apt-get install awstats
```

配置

```sh
vi /etc/awstats/awstats.conf
```

查询并修改下列参数

```sh
LogFile="/var/log/apache2/access.log"
LogFormat=1
SiteDomain="ly95.me"
HostAliases="localhost 127.0.0.1 ly95.me"
```

增加一条定时任务

```sh
vi /etc/crontab
```

```sh
0 */3 * * * root /usr/lib/cgi-bin/awstats.pl -config=ly95.me -update > /var/log/awstats.log
```

Apache 默认VirtualHost标签里增加

```ini
Alias /awstatsclasses “/usr/share/awstats/lib/"
Alias /awstats-icon/ “/usr/share/awstats/icon/"
Alias /awstatscss “/usr/share/doc/awstats/examples/css"
ScriptAlias /awstats/ /usr/lib/cgi-bin/
```

重启Apache

访问 http://ly95.me/awstats/awstats.pl