---
layout: post
title: MacPorts创建本地Portfile
date: 2014-06-24 14:06:14
modified: 2015-02-17 11:26:00
categories: 笔记
tags: MacPort
---

使用macport安装编译的时候希望能自定义configure。

直接修改macports官方Portfile不方便管理，创建自定义的本地Portfile是最好选择。编辑文件/opt/local/etc/macports/sources.conf找到这行

```sh
rsync://rsync.macports.org/release/tarballs/ports.tar [default]
```

上面增加一行

```sh
file:///opt/local/portfiles
```

创建资源

```sh
sudo mkdir -p /opt/local/portfiles/ports/www/my_nginx
cd /opt/local/portfiles/ports/www/my_nginx
sudo cp /opt/local/var/macports/sources/rsync.macports.org/release/tarballs/ports/www/nginx/Portfile Portfile
```

编辑Portfile

```sh
vi Portfile
```

找到configure.args-append就可以修改configure，最后加入macport索引

```sh
cd /opt/local/portfiles
portindex
```

运行命令进行测试

```sh
port search my_nginx
```
