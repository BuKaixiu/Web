<?php  
	// 通过 HTTP 响应头告诉客户端我们给你的内容是 JavaScript 代码
	header('Content-Type: applcation/javascript;');
?>
document.write("你好");