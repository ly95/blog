---
layout: post
title: Mysql连接数过多
date: 2015-12-12 00:31:26
modified: 2015-12-12 00:31:26
tags: mysql php
---

最近mysql数据库连接数突然增多，经过模拟测试和阅读php源码(fpm_main.c)确认是由于php超时有关，这种连接状态多为sleep。

数据库连接关闭操作是写在__destruct方法体里的，而php脚本运行超时时不会调用析构方法。
