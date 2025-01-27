<?php

Schedule::command('ratelimit:reset-limits')->everyMinute()->sendOutputTo('/tmp/ratelimit-reset.log');
