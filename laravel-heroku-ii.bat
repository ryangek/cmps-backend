@echo off
pause
for /f "delims=" %i in ('php artisan --no-ansi key:generate --show') do 
echo %i > app_key.txt
pause