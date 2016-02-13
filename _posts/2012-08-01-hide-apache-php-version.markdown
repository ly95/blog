---
layout: post
title: 隐藏apache/php信息
date: 2012-08-01 11:13:36
modified: 2014-06-17 14:30:05
tags: ubuntu apache
---

{% highlight sh %}
vi /etc/php5/apache2/php.ini
{% endhighlight %}

{% highlight sh %}
expose_php Off
{% endhighlight %}

{% highlight sh %}
vi /etc/apache2/conf.d/security
{% endhighlight %}

{% highlight sh %}
ServerTokens Prod
ServerSignature Off
{% endhighlight %}

最后重启apache