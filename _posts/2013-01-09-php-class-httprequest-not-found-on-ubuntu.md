---
layout: post
title: PHP Class 'HttpRequest' not found on Ubuntu
date: 2013-01-09 18:42:30
modified: 2014-06-17 12:22:20
categories: 笔记
tags: PHP
---

安装 pecl_http

```sh
sudo apt-get install php-pear
sudo apt-get install libcurl3-openssl-dev
sudo apt-get install re2c
sudo pecl install pecl_http
sudo vi /etc/php5/cli/php.ini
```

添加一行

```sh
"extension=http.so"
```