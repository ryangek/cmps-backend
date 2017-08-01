@echo off
echo #############################
echo ## Generate key for Heroku ##
echo #############################
pause
for /f "delims=" %%a in ('php artisan key:generate --show') do @echo %%a>app_key.txt
pause