---
layout: post
title: "Elasticsearch 浅谈"
description: "elasticsearch 笔记"
date: 2016-08-31 22:56:00 +0800
categories: 笔记
tags:
  - DB
  - Elasticsearch
---


## Elasticsearch是什么？


简单说明，__Elasticsearch是一个基于Lucene的开源搜索引擎__。拥有一下特点:

- 分布式的实时文件存储，每个字段都被索引并可被v搜索。
- 分布式的实时分析搜索引擎。
- 可以扩展到上百台服务器，处理PB级结构化或非结构化数据。



在ES中存储数据的行为就叫做索引，数据存储在文档，文档归属于一种类型(type)，而这些类型存在于索引(index)中，我们可以画一些简单的对比图来类比传统关系型数据库：

```
Relational DB -> Databases -> Tables -> Rows -> Columns
Elasticsearch -> Indices   -> Types  -> Documents -> Fields
```

更多内容可查阅官网。


## 排名



截止2016年8月，Search engine 类型数据库排名第一、309种数据库中排名11。

[Ranking链接](http://db-engines.com/en/ranking)



## 安装配置



比较简单不再叙述。



## Api



基于HTTP协议，以JSON为数据交互格式的RESTful API，通过9200端口的与ES进行通信。

例子：

索引数据

```sh
curl -XPOST 'http://127.0.0.1:9200/ly95/person' -d '{
    "user" : "ly95",
    "created_date" : "2016-08-22T17:25:12",
    "note" : "trying out Elasticsearch",
    "age": 24
}'
```



## Mapping



Mapping是定义文档字段类型的过程，好比关系型数据库建表，这里称为创建索引，__索引创建后字段类型是不允许修改的__，只能重建索引。ES是允许自动创建索引的，可在配置中开启于关闭此功能

```yaml
action.auto_create_index: true
```



例子：

```sh
curl -XPOST 'http://127.0.0.1:9200/ly95/person' -d '{
  "settings": {
    "number_of_shards": 1,
    "number_of_replicas": 1 
  },
  "mappings": {
      "person": {
          "_source": {
              "enabled": true
          },
          "properties": {
              "user": {
                  "type": "string"
              },
              "created_date": {
                  "type": "date",
                  "format": "strict_date_optional_time"
              },
              "note": {
                  "type": "string"
              },
              "age": {
                  "type": "integer"
              }
          }
      }
  }
}'
```


正确返回结果：

```json
{"index":"ly95","type":"person","id":"AVbf7x4lkuRtCTeIkBAN","version":1,"_shards":{"total":2,"successful":1,"failed":0},"created":true}
```

更多字段类型查看 [字段类型表](https://www.elastic.co/guide/en/elasticsearch/reference/current/mapping-types.html)



## 中文分词



默认不支持中文分词，会将中文按字拆分，安装smartcn可以解决。


```sh
./bin/plugin install analysis-smartcn
```

例子：

创建索引，指定分词器。

```sh
curl -XPUT 'http://127.0.0.1:9200/test' -d '{
  "settings": {
    "index": {
      "analysis": {
        "analyzer": {
          "default": {
            "type": "smartcn"
          }
        }
      }
    }
  }
}'
```

GET请求

http://127.0.0.1:9200/test/_analyze?text=凡人牧白

得到分词结果：

```json
{"tokens":[{"token":"凡人","start_offset":0,"end_offset":2,"type":"word","position":0},{"token":"牧","start_offset":2,"end_offset":3,"type":"word","position":1},{"token":"白","start_offset":3,"end_offset":4,"type":"word","position":2}]}
```


## 搜索DSL语法



待续……

## Script使用



待续……

## 压测工具



Rally是ES压测工具。在实际使用ES时有各种情况，所以Rally做了2种假设: 

1、ES集群每台机器配置一致；

2、你会提交数据给ES做索引，并查询这些数据来做压测。

Rally提供了一份3.8G数据作为测试数据，不用担心压缩后只有198M，Rally也允许自定义压测数据。

安装环境要求：

- Python 3.4+，并安装pip3
- JDK8
- git

官方文档没有注明git的版本要求，服务器默认的1.8版本，Rally启动老失败，查阅Rally源码发现问题。



utils/git.py

```python
def checkout(src_dir, branch="master"):
    if process.run_subprocess(
            "git -C {0} checkout --quiet {1}".format(src_dir, branch)):
        raise exceptions.SupplyError("Could not checkout '%s'" % branch)
```



so, 如果git不支持-C选项Rally是不会正常工作的。所以我把git升级到2.9.0才解决。

压测结果如下:

|                                   Metric |   Value |
| ---------------------------------------: | ------: |
|         Min Indexing Throughput [docs/s] |   34314 |
|      Median Indexing Throughput [docs/s] | 39095.5 |
|         Max Indexing Throughput [docs/s] |   39564 |
|                      Indexing time [min] | 41.8126 |
|                         Merge time [min] | 12.9383 |
|                       Refresh time [min] | 3.70082 |
|                         Flush time [min] |  0.2281 |
|                Merge throttle time [min] | 1.56302 |
| Query latency term (90.0 percentile) [ms] | 2.23644 |
| Query latency term (99.0 percentile) [ms] | 3.01261 |
| Query latency term (99.9 percentile) [ms] |  16.868 |
| Query latency term (100 percentile) [ms] | 17.4577 |
| Query latency country_agg_uncached (90.0 percentile) [ms] | 113.844 |
| Query latency country_agg_uncached (99.0 percentile) [ms] | 129.566 |
| Query latency country_agg_uncached (99.9 percentile) [ms] | 146.583 |
| Query latency country_agg_uncached (100 percentile) [ms] |   157.9 |
| Query latency scroll (90.0 percentile) [ms] | 28.8342 |
| Query latency scroll (99.0 percentile) [ms] | 29.4671 |
| Query latency scroll (99.9 percentile) [ms] | 29.8244 |
| Query latency scroll (100 percentile) [ms] | 30.3477 |
| Query latency country_agg_cached (90.0 percentile) [ms] | 2.55187 |
| Query latency country_agg_cached (99.0 percentile) [ms] | 4.54663 |
| Query latency country_agg_cached (99.9 percentile) [ms] | 16.7916 |
| Query latency country_agg_cached (100 percentile) [ms] | 21.1481 |
| Query latency expression (90.0 percentile) [ms] | 280.156 |
| Query latency expression (99.0 percentile) [ms] | 291.208 |
| Query latency expression (99.9 percentile) [ms] | 299.789 |
| Query latency expression (100 percentile) [ms] | 301.472 |
| Query latency default (90.0 percentile) [ms] | 34.4101 |
| Query latency default (99.0 percentile) [ms] | 45.6405 |
| Query latency default (99.9 percentile) [ms] | 59.2157 |
| Query latency default (100 percentile) [ms] | 63.8479 |
| Query latency phrase (90.0 percentile) [ms] | 3.26815 |
| Query latency phrase (99.0 percentile) [ms] | 4.02543 |
| Query latency phrase (99.9 percentile) [ms] | 20.8176 |
| Query latency phrase (100 percentile) [ms] | 21.0913 |
|                   Total Young Gen GC [s] |  44.911 |
|                     Total Old Gen GC [s] |   0.301 |
|                            Segment count |     148 |
|      Indices Stats(90.0 percentile) [ms] | 3.70353 |
|      Indices Stats(99.0 percentile) [ms] | 10.9675 |
|       Indices Stats(100 percentile) [ms] | 27.8454 |
|        Nodes Stats(90.0 percentile) [ms] | 4.58134 |
|        Nodes Stats(99.0 percentile) [ms] | 5.46218 |
|         Nodes Stats(100 percentile) [ms] | 6.06723 |



更多Rally使用方法和安装说明请参见 [文档](https://esrally.readthedocs.io/en/latest/)。




## 推荐插件


- [Web管理界面](https://mobz.github.io/elasticsearch-head/)
- [中文分词](https://www.elastic.co/guide/en/elasticsearch/plugins/current/analysis-smartcn.html)
- [elasticsearch-sql](https://github.com/NLPchina/elasticsearch-sql)使用SQL语句搜索。


## 其他链接


- [官方网站](https://www.elastic.co/products/elasticsearch)
- [Elasticsearch权威指南－中文](http://es.xiaoleilu.com)


