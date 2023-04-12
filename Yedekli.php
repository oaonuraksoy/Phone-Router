<?php
  $phone = $_GET['tel'];
  $phone = preg_replace("/[^0-9]/", "", $phone); // telefon numarasından tüm olmayan karakterleri temizle
  if(substr($phone, 0, 3) != "90") { // telefon numarası başında +90 varsa, + işaretini kaldırma
    $phone = "+90" . substr($phone, -10); // telefon numarasının son 10 hanesini al ve başına +90 ekle
  }
  $echoTel = '+90 ' . substr($phone, 3, 3) . ' ' . substr($phone, 6, 3) . ' ' . substr($phone, 9, 2) . ' ' . substr($phone, 11, 2);
  echo "<a href='tel:$phone'>$phone</a>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dr. Mehmet AKGÜN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	    p{
	        font-size:16pt;
	    }
	    a{
	        font-size:24pt;
	    }
	    img{
	      width: 70%;
	    }
	    
.footer{
    position: fixed;
    bottom: 0;
    
}
	</style>
</head>
<body style="text-align:center;background-color:#ecf0f1;color:#2c3e50;padding:.5em;margin:.5em;">
    <br><br><br>
	<h1><img src="https://www.drmehmetakgun.com/wp-content/uploads/2017/03/logo-1.png" ></h1>
	<p>Otomatik yönlendirme çalışmaz ise aşağıdaki telefon numarasına tıklayınız <br><br>
    <a id="telLink" style="color:red;text-decoration:none; font-weight: 700;" href='tel:<?php echo $phone; ?>'>
    <?php echo $echoTel; ?>
</a></p>
		
		
		<div class="footer">
		    <marquee behavior="" direction="">Bu alan Dr. Mehmet Akgün Kişisel Web sitedir. Klinik web sitesine ulaşmak için 
        <a href="https://drmehmetakgun.com" target="_blank" style="color:red;text-decoration:none; font-weight: 700;font-size:16pt;">tıklayınız</a> .</marquee>
		</div>
		
		
		<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('telLink').click();
		}, 500);
	</script>
</body>
</html>