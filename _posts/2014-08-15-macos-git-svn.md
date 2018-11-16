---
layout: post
title: MacOS Git-svn 使用笔记
date: 2014-08-15 13:33:00
modified: 2015-02-17 14:05:26
tags: Git SVN
---

公司服务器使用版本控制工具为svn-1.6，项目较大，开发任务量大，再一次意外将svn升级到1.8并且更新了svn本地资源，造成无法再提交新文件。

一咬牙决心使用git-svn代替svn-client。

Xcode 安装命令行工具

```sh
xcode-select —install
```

克隆远程资源

```sh
git svn clone svn://res-url/something
```

会从第一个版本下载一直到最新版本，如果版本很高那可能花上几天的时间

增加参数节约时间，-r1 是开始版本号

```sh
git svn clone svn://res-url/something -r1:2
```

建好以后再使用rebase同步版本信息

```sh
git svn rebase
```

完成后，最好创建开发分支，和master分开，提交代码前，将开发分支合并到master上再提交到svn服务器，避免冲突。

原svn项目资源大小为3G，git svn下载完毕后大小为3.14G.

常用命令

更新本地资源 git svn rebase

提交本地修改到svn服务端 git svn dcommit

最后推荐免费git客户端：SourceTree