---
layout: post
title: 关于MacOS配置defaults
date: 2018-11-15
categories: 笔记
tags: MacOS deafults
---

前提（一定是闲的蛋疼）有怪癖，爱保持整洁。原因每次修改了MacbookPro外接显示器桌面背景图，下次连接电脑时背景图不会与内建显示器的背景图同步。

于是想到删除相关配置。

从熟悉的命令入手，重新给Launchpad的应用程序排序：
```bash
defaults write com.apple.dock ResetLaunchPad -bool TRUE
killall Dock
```
问题来了，不知道显示相关配置的domain值如何重置配置。网上找资料就算了，有怪癖的人不多。思路是先保存一份当前配置到文件，然后修改外接显示器的背景图片比较配置的差异部分。


保存当前配置内容
```bash
defaults read > current_default.txt
```

比对差异
```
vimdiff current_default.txt changed.txt
```

![screenshot](https://raw.githubusercontent.com/ly95/blog/master/_posts/2018-11-15-about-oxs-defaults/screenshot.png)

发现有修改的domain是com.apple.spaces，测试有效，问题解决了。
```bash
defaults delete com.apple.spaces
sudo shutdown -r 0
```
