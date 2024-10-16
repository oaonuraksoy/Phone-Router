<?php
if(isset($_GET["tel"])){
  $phone = preg_replace("/[^0-9]/", "", $_GET['tel']); 
  $phone = substr($phone, 0, 2) == "90" ? "+".$phone : "+90".substr($phone, -10); 
  $echoTel = '+90 ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 3) . ' ' . substr($phone, 9, 2) . ' ' . substr($phone, 11, 2);
//  echo "<a href='tel:$phone'>$echoTel</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Phone Router</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body style="text-align:center;background-color:#ecf0f1;color:#2c3e50;padding:.5em;margin:.5em;">

    <br><br><br>
	<h1><img src="image.url/image" style="width: 70%;"></h1>
	<p style="font-size: 16pt;">Otomatik yönlendirme çalışmaz ise aşağıdaki telefon numarasına tıklayınız <br><br>
    <a id="telLink" style="color: red;text-decoration: none;font-weight: 700;font-size: 24pt;" href="tel:<?php echo @$phone; ?>">
    <?php echo @$echoTel; ?>
</a></p>
		
		

		
		
		<script type="text/javascript">

	</script>
  <script src="js.js"></script>
</body>
</html>
