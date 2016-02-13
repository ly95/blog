---
layout: post
title: PHP Class 'HttpRequest' not found on Ubuntu
date: 2013-01-09 18:42:30
modified: 2014-06-17 12:22:20
tags: php
---

安装 pecl_http

{% highlight sh linenos %}
sudo apt-get install php-pear
sudo apt-get install libcurl3-openssl-dev
sudo apt-get install re2c
sudo pecl install pecl_http
sudo vi /etc/php5/cli/php.ini
{% endhighlight %}

添加一行

{% highlight sh linenos %}
"extension=http.so"
{% endhighlight %}