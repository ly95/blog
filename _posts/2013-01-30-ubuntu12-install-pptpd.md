---
layout: post
title: Ubuntu12.10 安装 pptpd 实录
date: 2013-01-30 15:58:15
modified: 2014-07-22 01:53:17
categories: 笔记
tags: PPTP Ubuntu VPN
---

切换至root帐号下

安装pptd

```sh
apt-get install pptpd -y
```

配置DNS

```sh
vi /etc/ppp/pptpd-options
```

```sh
ms-dns 8.8.8.8
```

分配客户端虚拟IP

```sh
vi /etc/pptpd.conf
```

取消注释最后2行

```sh
#localip 192.168.0.1
#remoteip 192.168.0.234-238,192.168.0.245
#or
localip 192.168.0.234-238,192.168.0.245
remoteip 192.168.1.234-238,192.168.1.245
```

添加客户端帐号

```sh
vi /etc/ppp/chap-secrets
```

帐号 服务 密码 IP

```sh
test * test *
```

路由规则设置ipv4转发

```sh
vi /etc/sysctl.conf
```

找到“net.ipv4.ip_forward”所在行，设置为1

```sh
net.ipv4.ip_forward = 1
```

更新规则

```sh
sysctl -p
```

iptables转发设置

```sh
iptables -P FORWARD ACCEPT
/sbin/iptables --table nat -A POSTROUTING -o eth0 -j MASQUERADE
```

最后重启

```sh
/etc/init.d/pptpd restart
netstat -anp | grep pptpd
```

pptpd已经在监听1723端口说明一切正常