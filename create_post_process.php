<?php
$servername = "localhost"; // 数据库服务器
$username = "root";         // 数据库用户名
$password = "";             // 数据库密码
$dbname = "blog_database";  // 数据库名称

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 检查是否是 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    // 假设用户 ID 为 1，实际代码中应根据登录用户动态获取
    $user_id = 1; 

    // 准备和绑定
    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);

    // 执行语句并检查结果
    if ($stmt->execute()) {
        echo "新文章发布成功！";
        echo '<br><a href="index.html">返回首页</a>';
    } else {
        echo "错误: " . $stmt->error;
    }

    // 关闭语句
    $stmt->close();
}

// 关闭连接
$conn->close();
?>
