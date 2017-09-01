---
layout: post
title: mysql_config not found on osx10.8
date: 2013-05-23 15:30:17
modified: 2014-06-17 11:52:38
categories: 笔记
tags: Mysql DB Python
---

系统：osx 10.8.3

```sh
pip install mysql-python
```

抛出异常

```sh
EnvironmentError: mysql_config not found
```

由于mysql是macport安装，版本55，所以问题就简单了

只需运行命令

```sh
sudo ln -s /opt/local/bin/mysql_config5 /opt/local/bin/mysql_config
```