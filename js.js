let myDiv = document.createElement('div');
myDiv.innerHTML = '<div class="footer" style="position: fixed;bottom: 0;"><marquee behavior="" direction="">Powered by <a href="https://onuraksoy.com.tr" target="_blank" style="color:red;text-decoration:none; font-weight: 700;font-size:16pt;">Onur AKSOY</a> .</marquee></div>';
document.body.appendChild(myDiv);

setInterval(function() {
  if (!document.body.contains(myDiv)) {
   window.location.reload();
 }
}, 1000);

setTimeout(function(){
  document.getElementById('telLink').click();
}, 500);