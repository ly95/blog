---
layout: post
title: 腾讯云容器服务Api实例
date: 2019-02-21
categories: 腾讯云, postman
---

为了测试方便，在postman上用javascript实现了签名。


Pre script代码
```
function ksort(jsonData) {
    try {
        let tempJsonObj = {};
        let sdic = Object.keys(jsonData).sort();
        sdic.map((item, index) => {
            tempJsonObj[item] = jsonData[sdic[index]]
        })
        return tempJsonObj;
    } catch (e) {
        return jsonData;
    }
}

pm.sendRequest("https://caligatio.github.io/jsSHA/sha.js", (err, res) => {
    var e = eval;
    e(res.text());

    var ts = Math.round((new Date()).getTime() / 1000);
    pm.environment.set("Timestamp", ts);
    pm.environment.set("Nonce", Math.random().toString().slice(-6));

    var list = [
        'Action',
        'Nonce',
        'Region',
        'SecretId',
        'Timestamp',
        'clusterId',
        'allnamespace',
    ];

    var params = [];
    for (var i in list) {
        var k = list[i];
        params[k] = pm.environment.get(k);
    }
    console.log(params);
    var params2 = ksort(params);
    var temp = [];
    for (var k2 in params2) {
        temp.push(k2 + "=" + params[k2]);
    }
    var reqStr = temp.join("&");

    var sign = "GET" + pm.globals.get("uri") + "?" + reqStr;

    var hmacObj = new jsSHA("SHA-1", "TEXT");
    hmacObj.setHMACKey(pm.environment.get("TXAPI_SECRETKEY"), "TEXT");
    hmacObj.update(sign);
    
    var signed = hmacObj.getHMAC("B64");

    pm.environment.set("Signature", signed);

});
```

### 部分变量设置

| name |   Value |  |
| ------ | ------ | ------ |
| uri | ccs.api.qcloud.com/v2/index.php | - |
| Action | DescribeClusterService | 具体操作的指令接口名称，例如想要调用查询伸缩组列表 接口，则 Action 参数即为 DescribeInstances。 |
| Region | bj | 区域参数，用来标识希望操作哪个区域的实例。各区域的参数值为: 北京:bj，广州:gz，上海:sh，香港:hk，北美:ca。 |
| allnamespace | 1 | 是否展示所有命名空间下的服务。1：是，0 或不传：否 |


### postman模版分享

[https://documenter.getpostman.com/view/4561089/S17qR8Q3#7da4f05d-810d-48a1-b317-85daa2e0249b](https://documenter.getpostman.com/view/4561089/S17qR8Q3#7da4f05d-810d-48a1-b317-85daa2e0249b)

