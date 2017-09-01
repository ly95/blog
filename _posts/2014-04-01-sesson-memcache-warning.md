---
layout: post
title: Session+memcache问题
description: 原因未知，先记录一下。
date: 2014-04-01 18:42:56
modified: 2015-02-17 11:41:51
categories: 笔记
tags: PHP Memcache
---

配置php.ini

```sh
session.save_handler = memcache
session.save_path = "localhost:11211"
```

日志提示

```sh
Warning: session_start() [function.session-start]: Keycannot be empty
```

原因未知，先记录一下。