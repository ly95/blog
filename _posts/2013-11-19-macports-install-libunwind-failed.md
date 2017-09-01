---
layout: post
title: MacPort安装libunwind失败
date: 2013-11-19 10:33:30
modified: 2015-02-17 11:43:11
categories: 笔记
tags: MacPort
---

通过macport重新安装golang的时候得到下面提示

```sh
Extracting libunwind-headers
Error: org.macports.extract for port libunwind-headers returned: command execution failed
Please see the log file for port libunwind-headers for details:
/opt/local/var/macports/logs/_opt_local_var_macports_sources_rsync.macports.org_release_tarballs_ports_devel_libunwind-headers/libunwind-headers/main.log
Error: Problem while installing libunwind-headers
Error: Unable to execute port: upgrade llvm-gcc42 failed
```

通过搜索得到是xcode5升级造成的，先接受新许可。

```sh
sudo xcodebuild -license agree
```

打开错误日志 main.log 看到

```sh
-xf - 
:info:extract sh: /usr/bin/gnutar: No such file or directory
:info:extract gzip: error writing to output: Broken pipe
:info:extract gzip: /opt/local/var/macports/distfiles/libunwind-headers/libunwind-35.1.tar.gz: uncompress failed
:info:extract Command failed:  cd
"/opt/local/var/macports/build/_opt_local_var_macports_sources_rsync.macports.org_release_tarballs_ports_devel_libunwind-headers/libunwind-headers/work" && /usr/bin/gzip -dc '/opt/local/var/macports/distfiles/libunwind-headers/libunwind-35.1.tar.gz' | /usr/bin/gnutar --no-same-owner
-xf -
```

原来是gnutar不存在，回想起来，macos是10.7时安装的macport ，现在已经升级到10.9了。

> The problem is that your version of MacPorts was not built on Mavericks and assumes the tools that were there when it was installed are still available. Since this is no longer the case, you should re-install MacPorts, which will automatically fix this issue.

所以只能重新安装macport