---
layout: post
title: [Xcode4.5]MuPDF编译问题stdio.h not found
date: 2012-09-29 10:58:44
modified: 2014-06-17 14:27:28
tags: ios xcode
---

app因为ios data storage拒绝后，使用更新后的Xcode编译App失败

{% highlight sh %}
stdio.h not found
{% endhighlight %}

解决办法是，ctrl+,开打Preferences，下载Command Line Tools。