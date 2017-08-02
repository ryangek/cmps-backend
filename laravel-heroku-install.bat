@echo off
echo ####################################
echo ## Add addon Postgresql on Heroku ##
echo ####################################
echo .
pause
set /p app_name=<app_name.txt
heroku apps:create %app_name%
heroku addons:create heroku-postgresql:hobby-dev --app %app_name%
heroku git:remote --app $app_name%
echo Add addon Postgresql on Heroku complete ..
echo .
echo .
echo #############################
echo ## Generate key for Heroku ##
echo #############################
echo .
pause
for /f "delims=" %%a in ('php artisan key:generate --show') do @echo %%a>app_key.txt
echo Generate key for Heroku complete ..
echo .
echo .
echo #############################
echo ## Configure key to Heroku ##
echo #############################
echo .
pause
set /p app_key=<app_key.txt
heroku config:set APP_KEY=%app_key%
heroku config:set APP_LOG=errorlog
heroku config:set APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
echo Configure key to Heroku complete ..
echo .
echo .
echo #################################
echo ## DO upload project to Heroku ##
echo #################################
echo .
pause
set /p app_name=<app_name.txt
git add .
git commit -am "%app_name%"
git push heroku master
pause
heroku open
exit