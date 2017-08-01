@echo off
echo ####################################
echo ## Add addon Postgresql on Heroku ##
echo ####################################
pause
set /p app_name=<app_name.txt
heroku apps:create %app_name%
heroku addons:create heroku-postgresql:hobby-dev --app %app_name%
heroku git:remote --app $app_name%
pause