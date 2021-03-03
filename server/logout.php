<?php
/**
 * Code will allow user to log out of the site
 * I, Rhagavy Rakulan, 000802106 certify that this material is my original work.  
 * No other person's work has been used without due acknowledgement. 

* Name: Rhagavy Rakulan, Student#: 000802106
* Date created: Sunday, December 6, 2020
*/
session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();