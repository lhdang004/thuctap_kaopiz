<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang chủ</title>
	<style>
		body {
			margin: 0;
			font-family: Arial, sans-serif;
			color: #333;
			background: #f4f6f8;
		}
		header {
			padding: 16px 8%;
			color: white;
			background: #2563eb;
		}
		main {
			max-width: 700px;
			margin: 60px auto;
			padding: 36px 24px;
			text-align: center;
			background: white;
			border-radius: 10px;
		}
		h1 { color: #2563eb; }
		footer {
			padding: 16px;
			text-align: center;
			color: #666;
		}
	</style>
</head>
<body>
	<header><strong>Website của tôi</strong></header>
	<main>
		<h1>Chào mừng bạn!</h1>
		<p>Đây là trang chủ đơn giản.</p>
	</main>
	<footer>&copy; <?= date('Y') ?> Website của tôi</footer>
</body>
</html>
