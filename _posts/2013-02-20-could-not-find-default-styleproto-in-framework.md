---
layout: post
title: "Couldn't find default.styleproto in framework"
date: 2013-02-20 23:55:03
modified: 2014-06-17 11:54:50
categories: 笔记
tags: IOS
---

在使用MapKit.framework的时候

控制台提示

```sh
Couldn't find default.styleproto in framework
```

解决办法

打开 Terminal输入并Enter

```sh
rm -r ~/Library/Application Support/iPhone Simulator/版本/Library/Caches/GeoServices
```

重新运行app，错误消失。
