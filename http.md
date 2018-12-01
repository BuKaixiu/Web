# HTTP



## 1. 概要



### 1.1. 定义

HTTP（Hyper Text Transfer Protocol，超文本传输协议）最早就是计算机与计算机之间沟通的一种标准协议，这种协议限制了通讯**内容格式**以及各项**内容的含义**。

主动被动问题

![](Web/img/HTTP传输.png)

随着时代的发展，技术的变迁，这种协议现在广泛的应用在各种领域，也不仅仅局限于计算机与计算机之间，手机，电视等各种智能设备很多时候都在使用这个协议通讯，所以一般现在称 **HTTP 为端与端之间的通讯协议**。

Web 属于B/S 架构的应用软件，在 B/S 架构中，浏览器与服务器沟通的协议就是 HTTP 协议，作为一个合格的 Web 开发者，了解 HTTP 协议中约定的内容是一门必修课。

> 应用软件架构一般分为两类：
>
> + B/S 架构：Browser（浏览器）←→ server（服务器），这种软件是通过浏览器访问一个网站使用，服务器提供数据储存等服务。
> + C/S 架构：Client（客户端）←→ server（服务器），这种软件通过安装一个软件到电脑，然后使用，服务器提供数据存储等服务。

### 1.2. 约定内容

+ 请求 / 响应报文格式
+ 请求方法 —— GET / POST / etc....
+ 响应状态 —— 200（一切OK） / 404（找不到） / 302（跳转） / 304（服务端的文件没有修改） / ect...
+ 预设的请求 / 响应头



### 1.3. 约定形式

1. 客户端通过随机端口与服务端某个固定端口（一般为80,https为443）**建立连接 **三次握手（确保连接是 可靠的）
2. 客户端通过连接 **发送请求**到服务端（这里请求是名词）
3. 服务端监听端口得到的客户端发过来的请求
4. 服务端通过连接响应给客户端状态和内容 

> 每次打开一个页面都脑部这个画面，默认流程。

## 2. 核心概念

### 2.1. 报文

#### 2.1.1. 请求报文

![ ](Web\img\请求报文.png)

![](Web\img\请求报文格式.png)

请求行

`GET /demo.php HTTP/1.1`

请求方式 + 空格 + 请求路径 + 空格 + HTTP 协议版本

请求头

客户端想要告诉服务端给一些额外的信息，一下为常见的请求头：

| 键              | 值                                       |
| --------------- | ---------------------------------------- |
| Host            | 请求主机                                 |
| Cache-Contorl   | 控制缓存（例如： max-age=60 缓存 60 秒） |
| Accept          | 客户端想要接收的文档类型，逗号分离       |
| User-Agent      | bioassay什么客户端帮你发送的这次请求     |
| Referer         | 这次请求的来源                           |
| Accept-Encoding | 可以接受的压缩编码                       |
| Cookie          | 客户端本地的小票地址                     |

请求体

这次请求客户端想要发送给服务端的数据正文，一般在GET中很少用到，因为GET请求主观上都是去“拿东西”。

#### 2.1.2. 响应报文

![](D:\GitHub\Web\img\响应报文.png)

状态行

`HTTP 1.1 200 OK `

HTTP 协议版本+状态码+空格+状态描述

响应头

服务器想告诉客户端的一些额外信息，常见的有一下：

| 键             | 值               |
| -------------- | ---------------- |
| Data           | 响应时间         |
| Server         | 服务器信息       |
| Content-Type   | 响应体的内容类型 |
| Content-Length | 响应的内容大小   |
| Set-Cookle     | 让客户端         |

如果需要在程序中设置自定义响应头（不是预设的），建议用x-<Property-Name>规则

响应体

这次请求服务器想要返回给客户端的数据正文，一般返回的都是HTML，也可以返回JavaScript或者css（需要修改响应头中的响应数据类型）。

#### 2.1.3 应用场景

+ 设置响应文件类型
  + header('Content-Type： text/css');

  + 常见的HTTP MIME type: `text/css` `text/html ` `text/plan` `applcation/javascript`

    html 代码

    ```html
    <!DOCTYPE>
    <html>
        <head len="en">
            <meta charset="UTF-8">
            <link rel="stylesheet" href="style.php">
            <link rel="stylesheet" href="script.php">
        </head>
    </html>
    ```

    php+css 代码

    ```php
    <?php
    	header('Content-Type: text/css; charset="utf-8"');
    ?>
    body {
    	background-color: hotpink;
    }
    ```

    php+javascript

    ```php
    <?php
    	header("Content-Type: applcation/javascript");
    ?>
    document.write("Hello World");
    ```

+ 重定向（跳转到其他网页）

  + header(’Location: https://www.baidu.com‘);

+ 下载文件

  ```php
  // 让文件下载
  header('Content-Type: application/octet-stream');
  // 设置默认下载文件名
  header('Content-Disposition: attachment; filename=demo.txt');
  ```

+ 图片防盗链

  + 通过判断请求来源`Referer`是否为本网站从而区分是否是合法请求



### 2.2. 请求方式

根据 HTTP标准，HTTP 请求可以使用多种请求方法。

HTTP1.0定义了三种请求方法：`GET` `POST` `HEAD`

HTTP1.1新增了五种请求方法：`options` `put` `delete` `trace` `connect`

| 序号 | 方法    | 描述                                                         |
| ---- | ------- | ------------------------------------------------------------ |
| 1    | GET     | 请求指定页面的信息，并返回实体主体                           |
| 2    | HEAD    | 类型与GET请求，只不过返回的响应中没有具体的内容，用于获取报头 |
| 3    | POST    | 向指定资源提交数据进行处理请求（例如提交表单或者上传文件）。数据被包含在请求体中。POST请求可能会导致新的资源的建立和/或已有资源的修改。 |
| 4    | PUT     | 从客户端向服务器传送的数据取代指定的文档的内容。             |
| 5    | DELETE  | 请求服务器删除指定的页面                                     |
| 6    | CONNECT | HTTP/1.1 协议中预留给能够将连接改为管道方式的代理服务器      |
| 7    | OPTIONS | 允许客户端查看服务器的性能                                   |
| 8    | TRACE   | 回显服务器收到的请求，主要用于测试和诊断                     |



>http://www.runoob.com/http/http-methods.html
