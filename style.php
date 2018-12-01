<?php 
	// PHP 中 header 函数专门用于设置响应头
	// 通过 HTTP 响应头告诉客户端我们给你的内容是 CSS 代码
	header('Content-Type: text/css; charset=UTF-8'); // 设置响应文件类型与编码格式
?>
body {
	background-color: hotpink;
}