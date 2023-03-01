<?php

?>
Welcome to the Bubble CMS Install Script.<br>
You are executing this script from:- <br><br> <?php
	print $_GET['LocalServer'];
?><br><br>
Downloaded Bubble CMS Distributed Install Zip.<br><br>
<?php print $app_data['asset-sever']; ?>downloads/Latest-BCMS_Distributed.zip<br><br>
<a href="/install.php?uri=<?php
	print urlencode('/step-2/');
?>">Unzip Install File</a>
<br><br>
{{message}}