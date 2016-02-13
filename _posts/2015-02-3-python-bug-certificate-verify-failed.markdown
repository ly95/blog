---
layout: post
title: Python Bug CERTIFICATE_VERIFY_FAILED
date: 2015-02-03 23:04:23
modified: 2015-02-17 01:20:03
tags: python ssl bug
---

urllib2请求ssh网址的时候抛出异常

{% highlight sh %}
File "/opt/local/Library/Frameworks/Python.framework/Versions/2.7/lib/python2.7/urllib2.py", line 1197, in do_open
raise URLError(err)
urllib2.URLError: <urlopen error [SSL: CERTIFICATE_VERIFY_FAILED] certificate verify failed (_ssl.c:581)>
{% endhighlight %}

该问题是python一个bug，影响版本：3.5, 3.4, 2.7。临时解决办法程序中加入下面代码

{% highlight python linenos %}
import ssl
    if hasattr(ssl, '_create_unverified_context'):
        ssl._create_default_https_context = ssl._create_unverified_context
{% endhighlight %}

相关链接
https://bugs.python.org/issue22417
