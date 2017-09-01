---
layout: post
title: 隐藏apache/php信息
date: 2012-08-01 11:13:36
modified: 2014-06-17 14:30:05
categories: 笔记
tags: Ubuntu Apache
---

编辑文件/etc/php5/apache2/php.ini

```sh
vi /etc/php5/apache2/php.ini
```

参数expose_php设置为Off

```sh
expose_php Off
```

编辑文件/etc/apache2/conf.d/security

```sh
vi /etc/apache2/conf.d/security
```

修改如下

```sh
ServerTokens Prod
ServerSignature Off
```

最后重启Apache就好了