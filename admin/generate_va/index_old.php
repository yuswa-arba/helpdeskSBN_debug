<?php
require_once("insert.php");

echo'
<form action="" method="post" enctype="multipart/form-data">
   <label for="file">Filename:</label> <input type="file" name="file" id="file"/>
<input type="submit" name="Submit" value="Submit">
</form>';

?>