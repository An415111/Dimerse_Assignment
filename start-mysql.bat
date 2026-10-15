@echo off
title Bombay Chai & Roast Co. - MySQL Server

echo ========================================================
echo   Starting MySQL Server on Port 3306...
echo ========================================================
echo.

set "MYSQLD_CMD=C:\Users\Ankit gupta\AppData\Roaming\Local\lightning-services\mysql-8.0.35+4\bin\win64\bin\mysqld.exe"
set "DATA_DIR=C:\Users\Ankit gupta\AppData\Roaming\Local\run\v58Bu25Lq\mysql\data"

"%MYSQLD_CMD%" --no-defaults --datadir="%DATA_DIR%" --port=3306 --console
pause
