@echo off
setlocal
title Bombay Chai ^& Roast Co. - Development Server

echo ========================================================
echo   Bombay Chai ^& Roast Co. - Local Server
echo ========================================================
echo.

:: Locate PHP executable
where php >nul 2>nul
if %errorlevel% equ 0 (
    set "PHP_CMD=php"
) else (
    set "PHP_CMD=C:\Users\Ankit gupta\AppData\Roaming\Local\lightning-services\php-8.2.27+1\bin\win64\php.exe"
)

:: Locate MySQL executable & data directory
set "MYSQLD_CMD=C:\Users\Ankit gupta\AppData\Roaming\Local\lightning-services\mysql-8.0.35+4\bin\win64\bin\mysqld.exe"
set "DATA_DIR=C:\Users\Ankit gupta\AppData\Roaming\Local\run\v58Bu25Lq\mysql\data"

:: Check if MySQL is already running on port 3306
netstat -ano | findstr /R /C:":3306 " >nul 2>nul
if %errorlevel% neq 0 (
    echo [1/2] Starting MySQL Server on port 3306 in background...
    if exist "%MYSQLD_CMD%" (
        start "" /B "%MYSQLD_CMD%" --no-defaults --datadir="%DATA_DIR%" --port=3306
        timeout /t 2 /nobreak >nul
    ) else (
        echo MySQL binary not found, using seeded SQLite fallback.
    )
) else (
    echo [1/2] MySQL is already running on port 3306.
)

echo [2/2] Starting PHP server at http://localhost:8000 ...
echo.
echo ========================================================
echo   Server is running! Open your browser at:
echo   http://localhost:8000/
echo   Press Ctrl+C anytime to stop.
echo ========================================================
echo.

:: Automatically launch browser
start http://localhost:8000/

:: Start PHP Server
"%PHP_CMD%" -S localhost:8000 router.php

pause
