---
layout: post
title: Install PPTP server on Ubuntu 12.04
date: 2012-07-21 22:28:57
modified: 2014-06-17 14:34:16
categories: 笔记
tags: Ubuntu VPN
---

参考

[http://www.larmeir.com/2010/03/setting-up-a-pptp-vpn-server-on-debian-and-ubuntu/](http://www.larmeir.com/2010/03/setting-up-a-pptp-vpn-server-on-debian-and-ubuntu/)

补充：

记得把iptables rules保存

```sh
iptables-save > /etc/iptables.pptp
```

在/etc/network/if-up.d/目录下创建iptables文件，内容如下：

```sh
#!/bin/sh
iptables-restore < /etc/iptables.pptp
```

增加执行权限

```sh
chmod +x /etc/network/if-up.d/iptables
```