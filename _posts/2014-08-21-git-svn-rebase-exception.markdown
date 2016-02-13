---
layout: post
title: Git svn rebase异常
date: 2014-08-21 18:06:16
modified: 2015-02-17 11:32:16
tags: git svn
---

环境MacOS，git版本1.9.3(Apple Git-50)，同步版本信息时遭遇此错误提示

{% highlight sh %}
$ git svn rebase

Incomplete data: Delta source ended unexpectedly at /Applications/Xcode.app/Contents/Developer/usr/share/git-core/perl/Git/SVN/Ra.pm line 290.
{% endhighlight %}

处理办法指定同步版本

{% highlight sh %}
git svn reset —r 版本号
{% endhighlight %}

然后再试

{% highlight sh %}
git svn rebase
{% endhighlight %}

如果还报错，重试指定较低的版本。
