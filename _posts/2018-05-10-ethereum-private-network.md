---
layout: post
title: 以太坊私链搭建
date: 2018-05-10
categories: 笔记
tags: blockchain 区块链
---

# 1. 私链搭建

由于节点之间的连接只有在对等节点具有相同的协议版本和网络ID的情况下才有效，因此可以通过将这些节点设置为非默认值来有效地隔离网络。建议使用——networkid命令行选项。它的参数是一个整数，主网络有id 1(默认)。

**如果节点没有连接到主网络节点，则以太网络是一个私有网络。在这种情况下，私有只意味着保留或隔离，而不是保护或安全。**

## 1.1 Defining the private genesis state

每一个区块链都是从genesis block开始。第一次运行geth时，genesis block将提交到数据库。
这包括一个小的JSON文件(例如，称为genesis.json)

```json
{
  "config": {
        "chainId": 15,
        "homesteadBlock": 0,
        "eip155Block": 0,
        "eip158Block": 0
    },
  "alloc": {
		  "7df9a875a174b3bc565e6424a0050ebc1b2d1d82": { "balance": "300000" }
	  },
  "coinbase"   : "0x0000000000000000000000000000000000000000",
  "difficulty" : "0x00000",
  "extraData"  : "0x68747470733a2f2f6c7939352e6d65",
  "gasLimit"   : "0x2fefd8",
  "nonce"      : "0x0000000000000042",
  "mixhash"    : "0x0000000000000000000000000000000000000000000000000000000000000000",
  "parentHash" : "0x0000000000000000000000000000000000000000000000000000000000000000",
  "timestamp"  : "0x00"
}
```

### 1.1.1 参数说明

| 参数名 | 描述 |
| ------: | ------: |
| **chainId** | EIP155后加入，目的区别主网（主网值是1）与其他网络，将影响交易签名 |
| **homesteadBlock** | 当设置为0时，意味着将使用Ethereum的Homestead版本。Homestead是以太坊平台的第二个主要版本，其中包括多项协议更改和网络更改 |
| **coinbase**| 当前块, 挖矿奖励交易地址(160-bit address) |
| **difficulty**| 从上一个块的difficulty和timestamp进行计算得出，难度越高，矿工运算量越大。测试环境可设低值 |
| **extraData** | 可选，字符串长度最大32字节 |
| **gasLimit** | gas上限 |
| **nonce** | A 64-bit hash, 用于工作量证明 |
| **mixhash** | A 256-bit hash, 参与块头有效性验证，具体见论文4.3.4章节 |
| **parentHash** | 指向父块，Keccak 256位散列，从而有效地构建块链。在创世纪块的情况下，只有在这种情况下，它是0 |
| **timestamp** | 当前块开始的时间戳 |
| **alloc** | 允许定义预先填充的钱包列表 |

### 1.1.2 初始化数据库
```bash
geth --datadir path/to/custom/data/folder init genesis.json
```

**启动需要指定networkid，与chainId值保持一致**

```bash
geth --datadir path/to/custom/data/folder --networkid 15
```

## 1.2 网络引导节点

启动一个引导节点(高可用)，其他人可以通过引导节点在网络上发现彼此。(官方推荐)

```bash
bootnode --genkey=boot.key
bootnode --nodekey=boot.key
```

运行后会在控制台输出enode URL供其他节点连接，并在bootnode上交换节点信息。(注意：需要把URL中的字符[::]替换为可访问的IP地址)

```bash
INFO [05-09|13:08:44] UDP listener up self=enode://a81d4bba596f9674f9eaae11f4fbd3c33eacf00763e66b0e7435cac14764548ab511261c1c175e346a57a8bfc42b4f674251e4beeabfb20a507d80a01f567f9a@[::]:30301
```

**注意：执行make all编译才会出现 build/bin/bootnode 可执行文件**

## 1.3 启动成员节点

```
geth --datadir path/to/custom/data/folder --ethash.dagdir path/to/custom/data/folder/ethash --identity "node00" --networkid 15 --bootnodes enode://a81d4bba596f9674f9eaae11f4fbd3c33eacf00763e66b0e7435cac14764548ab511261c1c175e346a57a8bfc42b4f674251e4beeabfb20a507d80a01f567f9a@127.0.0.1:30301
```

## 1.4 接口

### 1.4.1 RPC接口参数

```bash
  --rpc                  Enable the HTTP-RPC server
  --rpcaddr value        HTTP-RPC server listening interface (default: "localhost")
  --rpcport value        HTTP-RPC server listening port (default: 8545)
  --rpcapi value         API's offered over the HTTP-RPC interface
  --rpccorsdomain value  Comma separated list of domains from which to accept cross origin requests (browser enforced)
  --rpcvhosts value      Comma separated list of virtual hostnames from which to accept requests (server enforced). Accepts '*' wildcard. (default: "localhost")
```

### 1.4.2 WebSocket接口参数

```bash
  --ws                   Enable the WS-RPC server
  --wsaddr value         WS-RPC server listening interface (default: "localhost")
  --wsport value         WS-RPC server listening port (default: 8546)
  --wsapi value          API's offered over the WS-RPC interface
  --wsorigins value      Origins from which to accept websockets requests
  --rpccorsdomain value  Comma separated list of domains from which to accept cross origin requests (browser enforced)
```

### 1.4.3 接口权限

**注意：所有人都可以访问API。 默认情况下，IPC接口启用了所有API。**

例子，仅开启eth和miner接口
```bash
--rpcapi "eth,miner"
```

全部开启
```bash
--rpcapi "db,eth,net,web3,miner"
```

## 1.5 Console

进入交互式的JavaScript执行环境
```
> geth attach http://127.0.0.1:8545
> Welcome to the Geth JavaScript console!

> instance: Geth/v1.8.8-unstable-6cf0ab38/darwin-amd64/go1.10.2
>  modules: eth:1.0 net:1.0 rpc:1.0 web3:1.0
```

**需要留意modules，显示了可用的接口类别。**

通过unix socket进入执行环境
```bash
> geth attach /Users/linyang/private-geth/data0/geth.ipc
> Welcome to the Geth JavaScript console!

> instance: Geth/v1.8.8-unstable-6cf0ab38/darwin-amd64/go1.10.2
>  modules: admin:1.0 debug:1.0 eth:1.0 miner:1.0 net:1.0 personal:1.0 rpc:1.0 txpool:1.0 web3:1.0
```

### 1.5.1 命令简要说明

* eth：包含一些跟操作区块链相关的方法；
* net：包含一些查看p2p网络状态的方法；
* admin：包含一些与管理节点相关的方法；
* miner：包含启动&停止挖矿的一些方法；
* personal：主要包含一些管理账户的方法；
* txpool：包含一些查看交易内存池的方法；
* web3：包含了以上对象，还包含一些单位换算的方法。

## 1.6 启动新节点

我这里为了更好的理解以太平台，另开新节点。(因为2个节点都在localhost，需要指定不同的端口)

```bash
geth --datadir {folder2} init genesis.json
geth --datadir {folder2} --ethash.dagdir {folder2}/ethash --networkid 15 --identity "node01" --port 30302 --bootnodes enode://a81d4bba596f9674f9eaae11f4fbd3c33eacf00763e66b0e7435cac14764548ab511261c1c175e346a57a8bfc42b4f674251e4beeabfb20a507d80a01f567f9a@127.0.0.1:30301
```

进入console，查看是否自动发现了其他节点，正确如下：
```bash
> admin.peers
[{
    caps: ["eth/63"],
    id: "1662c8187c6a42ffc74939545debfe7bdc2505a7d2041c399124c21884f68cd8d73eaa086c78d91ce156d143630388bb5d1eb84f84a766258cf179f7245170a4",
    name: "Geth/node00/v1.8.8-unstable-6cf0ab38/darwin-amd64/go1.10.2",
    network: {
      inbound: false,
      localAddress: "127.0.0.1:64178",
      remoteAddress: "127.0.0.1:30303",
      static: false,
      trusted: false
    },
    protocols: {
      eth: {
        difficulty: 917952,
        head: "0xee18cd170606f58f40564b230c067ab4b8b69271276c371c2cef6477d3e674aa",
        version: 63
      }
    }
}]
```

### 1.6.1 挖矿前先创建账号

```bash
> personal.newAccount("miner")
"0xfb3aa7ece068bc423629a5e44cb32b39cc367819"
```

查询余额，新账号余额为0

```bash
> eth.getBalance('0xfb3aa7ece068bc423629a5e44cb32b39cc367819')
0
```

### 1.6.2 启动时增加挖坑选项，重启新节点。

1. 仅用于测试，运行资源最小化minerthreads=1
2. etherbase 公开账户地址，获取采矿奖励。默认为第一个账户

```bash
geth <usual-flags> --mine --minerthreads=1 --etherbase=0x78a3a94dd67480bc8b5a6883842077afe495199d
```

完整命令
```bash
geth --datadir {folder2} --ethash.dagdir {folder2}/ethash --networkid 15 --identity "node01" --port 30302 --bootnodes enode://a81d4bba596f9674f9eaae11f4fbd3c33eacf00763e66b0e7435cac14764548ab511261c1c175e346a57a8bfc42b4f674251e4beeabfb20a507d80a01f567f9a@127.0.0.1:30301 --mine --minerthreads=1 --etherbase=0x78a3a94dd67480bc8b5a6883842077afe495199d

......
INFO [05-10|11:36:02] Generating DAG in progress               epoch=0 percentage=98 elapsed=2m34.316s
INFO [05-10|11:36:04] Generating DAG in progress               epoch=0 percentage=99 elapsed=2m36.242s
INFO [05-10|11:36:04] Generated ethash verification cache      epoch=0 elapsed=2m36.247s
INFO [05-10|11:36:09] Generating DAG in progress               epoch=1 percentage=0  elapsed=1.822s
INFO [05-10|11:36:10] Generating DAG in progress               epoch=1 percentage=1  elapsed=3.630s
INFO [05-10|11:36:11] Successfully sealed new block            number=1 hash=06604a…a3e592
INFO [05-10|11:36:11] 🔨 mined potential block                  number=1 hash=06604a…a3e592
INFO [05-10|11:36:11] Commit new mining work                   number=2 txs=0 uncles=0 elapsed=356.439µs
......
```

挖坑一段时间后，查询账户余额
```bash
> eth.getBalance('0x3f81d9bbbe36113ff6f78f9567e277aa604ed7a9')
30000000000000000000
> web3.fromWei('30000000000000000000', 'ether')
30
```
账户中就有30以太币了

## 1.7 交易
```bash
> personal.newAccount('ly')
"0xf8e938812d246692d825d51b8e57da96a5eb8b6d"
> personal.unlockAccount(eth.coinbase, "ly", 100)
> eth.sendTransaction({
    from: eth.coinbase,
    to: web3.eth.accounts[1],
    value: web3.toWei(1,"ether")
})
```

未完待续……

------

# 参考

- [白皮书-以太坊:下一代智能合约和去中心化应用平台](https://ethfans.org/posts/ethereum-whitepaper)
- [以太坊源码 github.com](https://github.com/ethereum/go-ethereum)
- [https://github.com/ethereum/go-ethereum#operating-a-private-network](https://github.com/ethereum/go-ethereum#operating-a-private-network)
- [Management APIs · ethereum/go-ethereum Wiki · GitHub](https://github.com/ethereum/go-ethereum/wiki/Management-APIs#list-of-management-apis)
