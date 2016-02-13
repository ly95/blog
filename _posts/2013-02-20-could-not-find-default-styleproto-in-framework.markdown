---
layout: post
title: Couldn't find default.styleproto in framework
date: 2013-02-20 23:55:03
modified: 2014-06-17 11:54:50
tags: ios
--

在使用MapKit.framework的时候

控制台提示

{% highlight sh linenos %}
Couldn't find default.styleproto in framework
{% endhighlight %}

解决办法

打开 Terminal输入并Enter

{% highlight sh linenos %}
rm -r ~/Library/Application Support/iPhone Simulator/版本/Library/Caches/GeoServices
{% endhighlight %}

重新运行app，错误消失。
