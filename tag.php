<?php

	require('config.php');
	
	$url=GETPOST('url');
	var_dump($_REQUEST);
	
?><html>
	<head></head>
	<body>
		
		<form name="formtag" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		
			<input type="text" name="title" value="" />
			<input type="text" name="tags" value="" />
		
		
		
		</form>
	</body>
</html>
