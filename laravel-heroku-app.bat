@echo off
pause
echo ##################################################
echo ## Set "APP_KEY","APP_LOG","APP_ENV" to project ##
echo ##################################################
for /f "delims=" %i in ('php artisan --no-ansi key:generate --show') do set app_key=%i
heroku config:set APP_KEY=%app_key%
heroku config:set APP_LOG=errorlog
heroku config:set APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
start call laravel-heroku-git.bat app_name %app_name%
exit