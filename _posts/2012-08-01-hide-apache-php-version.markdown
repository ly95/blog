---
layout: post
title: 隐藏apache/php信息
date: 2012-08-01 11:13:36
modified: 2014-06-17 14:30:05
tags: ubuntu apache
---

{% highlight sh linenos %}
vi /etc/php5/apache2/php.ini
{% endhighlight %}

{% highlight sh linenos %}
expose_php Off
{% endhighlight %}

{% highlight sh linenos %}
vi /etc/apache2/conf.d/security
{% endhighlight %}

{% highlight sh linenos %}
ServerTokens Prod
ServerSignature Off
{% endhighlight %}

最后重启apache