---
layout: post
title: ReflectionMethod getDocComment返回false
date: 2012-12-19 14:25:32
modified: 2014-06-17 12:22:41
categories: 笔记
tags: PHP
---

开发soap接口的时候，使用Reflector自动生成wsdl文件。

getDocComment服务端则始终为false。

最终发现是eAccelerator删除了phpdoc