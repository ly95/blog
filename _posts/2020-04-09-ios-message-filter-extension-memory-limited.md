---
layout: post
title: Apple应用扩展的内存限制
date: 2020-04-09
categories: 笔记
---

目标平台 IOS 13.2，开发语言 Swift

在调试短信过滤扩展的时候遇到如下报错信息

```
Thread 3: EXC_RESOURCE RESOURCE_TYPE_MEMORY (limit=6 MB, unused=0x0)
```

这不只是资源文件的限制，咨询过Apple技术后得知这是extension程序运行时的限制，包含了Code、Data、运行时请求的内存占用。

由于我是使用的CoreML模型，解决办法使用coremktools转化精度减少模型体积，不过预测的精度也会降低。