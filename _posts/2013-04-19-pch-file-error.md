---
layout: post
title: Pch file error
date: 2013-04-19 00:48:47
modified: 2014-06-17 11:52:48
categories: 笔记
tags: Xcode
---
更新Xcode到4.6.2后，运行项目得到错误

```sh
error: PCH file built from a different branch ((clang-425.0.27)) than the compiler ((clang-425.0.28))
```

需要clean以后重新编译

PCH介绍：http://msdn.microsoft.com/zh-cn/library/hd8sctab(v=vs.80).aspx
