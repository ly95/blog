---
layout: post
title: BuildApplet异常
date: 2013-02-28 22:41:21
modified: 2014-06-17 11:53:43
tags: python
---

环境

macports 2.1.3
osx 10.8.2
Python 2.7

macports更新倒2.1.3自动安装了python launcher跟BuildApplet

在运行BuildApplet时抛出异常，暂无找到解决办法。

{% highlight sh %}
Traceback (most recent call last):
File "./Resources/__argvemulator_BuildApplet.py", line 3, in <module>
argvemulator.ArgvCollector().mainloop()
File "/opt/local/Library/Frameworks/Python.framework/Versions/2.7/lib/python2.7/plat-mac/argvemulator.py", line 38, in mainloop
stoptime = Evt.TickCount() + timeout
AttributeError: 'module' object has no attribute 'TickCount'
{% endhighlight %}
