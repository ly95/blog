---
layout: post
title: 用php计算wav文件播放时间
date: 2013-05-28 16:21:14
modified: 2014-06-17 11:31:25
tags: php
---

开发需要，试写了一个php版的

代码如下：

{% highlight php %}
/**
 * get length of wav audio in minutes/seconds
 *
 * @package default
 * @author linyang95#aol.com
 **/
$filename = 'voice_0.wav';
$fp = fopen($filename, 'r');
fseek($fp, 20);
$rawheader = fread($fp, 16);
// v short string
// V long string
$header = unpack('vwFormatTag/vnChannels/VnSamplesPerSec/VnAvgBytesPerSec/vnBlockAlign/vwBitsPerSample', $rawheader);
extract($header);
$rawbody = fread($fp, filesize($filename)-36);
$second = strlen($rawbody) / ( ($nChannels * $nSamplesPerSec * $wBitsPerSample) / 8 );
print ceil($second);
{% endhighlight %}

参考

https://ccrma.stanford.edu/courses/422/projects/WaveFormat

http://blog.csdn.net/qingdaoxuelei/article/details/2815516