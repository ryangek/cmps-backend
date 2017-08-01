@echo off
echo #################################
echo ## DO upload project to Heroku ##
echo #################################
pause
set /p app_name=<app_name.txt
git add .
git commit -am "%app_name%"
git push heroku master
pause
heroku open
exit