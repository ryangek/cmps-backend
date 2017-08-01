@echo off
echo ##########################
echo ## Config key to Heroku ##
echo ##########################
pause
set /p app_key=<app_key.txt
heroku config:set APP_KEY=%app_key%
heroku config:set APP_LOG=errorlog
heroku config:set APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
pause