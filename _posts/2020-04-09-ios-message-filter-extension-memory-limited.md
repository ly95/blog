---
layout: post
title: IOS应用扩展的内存限制
date: 2020-04-09
categories: 笔记
tags: IOS
---

<center>
<img src="https://raw.githubusercontent.com/ly95/blog/master/illustration/2020-04-09/1.jpg" width="400">
</center>

目标平台 IOS 13.2，开发语言 Swift

在调试短信过滤扩展的时候遇到如下报错信息

```
Thread 3: EXC_RESOURCE RESOURCE_TYPE_MEMORY (limit=6 MB, unused=0x0)
```

这不只是资源文件的限制，咨询Apple技术后得知这是extension程序运行时的限制，包含了Code、Data、运行时请求的内存占用。

由于我是用的CoreML模型，解决办法是通过coremktools工具转化精度减少模型体积，不过预测的精度也会降低。