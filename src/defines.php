<?php

//Define status for book status
define("RD_ST_TO_READ", "toread");		//想读
define("RD_ST_READING", "reading"); 	//在读
define("RD_ST_READ", "read");  			//已读

//Defien status for plan
define("PLAN_ST_NEW", "new");
define("PLAN_ST_ONGOING", "ongoing");
define("PLAN_ST_DONE", "finished");
define("PLAN_ST_RESTARTED", "restarted");

//Define status for task
define("TASK_ST_NEW", "new");
define("TASK_ST_ONGOING", "ongoing");
define("TASK_ST_DONE", "finished");
define("TASK_ST_RESTARTED", "restarted");


//Define status for timer
define("TIMER_ST_NEW", "new");
define("TIMER_ST_ONGOING", "ongoing");
define("TIMER_ST_DONE", "finished");
define("TIMER_ST_INTERRUPTED", "interrupted");

//Define the time length of pomodoro timer
define("TIMER_LEN", 25*60);			//25分钟