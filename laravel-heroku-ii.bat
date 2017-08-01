@echo off
pause
for /f "delims=" %a in ('php artisan key:generate --show') do @set app_key=%a
echo %app_key%>app_key.txt
pause