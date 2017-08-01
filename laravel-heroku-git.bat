@echo off
pause
echo #################################
echo ## DO upload project to Heroku ##
echo #################################
git add .
git commit -am "%app_name%"
git push heroku master