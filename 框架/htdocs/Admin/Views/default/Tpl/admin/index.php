<html>
<head>
<script type="text/javascript" src="../Public/jquery/jquery.js"></script>
</head>
    <script type="text/javascript">
		   $(document).ready(function(){
			     var subject=10;
			     var data={subject:subject};
				 setInterval(function() { Push(data); },6000);
		   });
		/*请求函数的ajax*/
		function Push(data) {
				$.ajax({
				    type : "POST",
				    data :data ,
				    dataType:'json',
				    url  : "/admin.php?s=e775YipV%2FEHC6bmKW8nMqv7%2BC4A0eHZ7Z3x8u1RukPgWUEkNSaq6RUk",
				    success:function(response,textStatus,jqHXR){
				    	console.log(132);
				    	alert(123);
				      }
				   });	
		}
		
    </script>
<body>
</body>
</html>