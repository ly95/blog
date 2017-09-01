---
layout: post
title: Python Openssl issue
date: 2017-4-19 10:03:00
modified: 2017-4-19 10:03:00
categories: 笔记
tags: Python SSL Bug Scrapy Debian
---

在debian8环境中scrapy爬取https网站时报错

```bash
Traceback (most recent call last):
  ...
  File "/usr/lib/convoy/lib/python2.7/site-packages/twisted/protocols/tls.py", line 41, in <module>
    from OpenSSL.SSL import Error, ZeroReturnError, WantReadError
  File "/usr/lib/convoy/lib/python2.7/site-packages/OpenSSL/__init__.py", line 8, in <module>
    from OpenSSL import rand, crypto, SSL
  File "/usr/lib/convoy/lib/python2.7/site-packages/OpenSSL/SSL.py", line 112, in <module>
    if _lib.Cryptography_HAS_SSL_ST:
AttributeError: 'FFILibrary' object has no attribute 'Cryptography_HAS_SSL_ST'
```

解决办法是将Python加密库cryptography升级

```bash
pip install -U cryptography
```

得到新的报错信息

```bash
c/_cffi_backend.c:15:17: fatal error: ffi.h: No such file or directory
```

需要安装cffi源码

```bash
apt-get install libffi-dev
pip install -U cffi
```

再次尝试升级cryptography，问题解决了。
