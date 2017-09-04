---
layout: post
title: Mysql连接数过多
description: php超时有关
date: 2015-12-12 00:31:26
modified: 2015-12-12 00:31:26
categories: 笔记
tags: PHP Mysql
---

最近mysql数据库连接数突然增多，经过模拟测试和阅读php源码确认是由于php超时有关，这种连接状态多为sleep。


```c
# file: php-src/sapi/fpm/fpm/fpm_main.c

int main(int argc, char *argv[])
{
    // 代码略...
    zend_first_try {
        while (EXPECTED(fcgi_accept_request(request) >= 0)) {
            // 代码略...
            php_execute_script(&file_handle);
            // 代码略...
            php_request_shutdown((void *) 0);
            // 代码略...
        }
        // 代码略...
    } zend_catch {
        exit_status = FPM_EXIT_SOFTWARE;
    } zend_end_try();

    // 代码略...
    return exit_status;
}
```

宏zend_first_try和zend_catch看作长跳转(setjump)，
当发生超时，函数php_execute_script将抛出E_ERROR类型错误。

* E_ERROR
* E_CORE_ERROR
* E_COMPILE_ERROR
* E_USER_ERROR
* E_PARSE

以上错误类型不能捕获，源码中这样描述fatal errors:

> fatal errors are real errors and cannot be made exceptions


函数php_request_shutdown会跳过执行，最终析构方法不会被执行。
