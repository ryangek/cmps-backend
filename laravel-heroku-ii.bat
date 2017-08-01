@echo off
echo #############################
echo ## Generate key for Heroku ##
echo #############################
pause
for /f "delims=" %a in ('php artisan key:generate --show') do @set app_key=%a
echo %app_key%>app_key.txt
pause