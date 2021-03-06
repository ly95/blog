---
layout: post
title: PHP开发工具PHPDCD
description: PHP Dead Code Detector
date: 2015-8-30 20:23:44
modified: 2015-8-30 20:23:44
categories: 笔记
tags: PHP
---

PHP开发工具PHPMD和PHPCS都不在做介绍了，今天在Github上发现的一款工具也很不错。

**PHP Dead Code Detector (PHPDCD)**

phpdcd 可以扫描php项目中的没有在使用的函数或方法（死代码）

使用方法也简单，下载https://phar.phpunit.de/phpdcd.phar后即可使用。

以Mac OS为例

```sh
wget https://phar.phpunit.de/phpdcd.phar
chmod +x phpdcd.phar
mv phpdcd.phar /usr/local/bin/phpdcd
```

进入项目目录

```sh
cd /var/www/site
phpdcd .
```


即可立即返回扫描报告。

**可选参数**

```sh
Usage:
 phpdcd [--names="..."] [--names-exclude="..."] [--exclude="..."] [--recursive] [values1] ... [valuesN]
Arguments:
 values
Options:
 --names               需要检查的文件名列表，数组形势 (如: ["*.php", "*.ini"])
 --names-exclude       不需要检查的文件名列表，值也是数组形式
 --exclude             按目录排除不需要检查的文件
```
