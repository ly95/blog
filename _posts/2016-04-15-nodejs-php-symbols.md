---
layout: post
title: "学习词汇解析"
description: Nodejs解析PHP代码
date: 2016-04-15 10:35:00 +0800
categories: 笔记
tags: PHP NodeJS
---

起因在使用Visual Studio Code无法查看到PHP代码结构，突然打算动手解决此事。

能力有限，起初想到的解决办法：通过PHP脚本来解析PHP文档。
可利用相关函数

```php
token_get_all();
// get_defined_*
```

缺点就是存在环境依赖、版本兼容、被编辑的文件语法错误的时候无法解析。

不依赖开发环境，只有使用nodejs扫描PHP源码并生成symbols信息，于是决定就这样做。
中间过程略，学习路线是这样的：了解词汇解析，阅读PHP Zend部分源码，学习re2c，动手写代码。

**好有的想法一定要努力实现不管结果怎样。**

昨晚该插件已发布，名为 php symbols 
[地址](https://marketplace.visualstudio.com/items?itemName=linyang95.php-symbols)。

参考资料：

- [Wiki 词法分析](https://zh.wikipedia.org/wiki/词法分析)
- [CS164](http://www.cs.berkeley.edu/%7Ebodik/cs164sp13)
- [Lex and YACC primer/HOWTO](http://tldp.org/HOWTO/Lex-YACC-HOWTO.html)
- [Yacc 与 Lex 快速入门](https://www.ibm.com/developerworks/cn/linux/sdk/lex/)
- 《领域专用语言实战》(亚马逊购买的kindle版)

