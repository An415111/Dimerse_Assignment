@echo off
title Bombay Chai & Roast Co. - Development Server

echo ========================================================
echo   Bombay Chai & Roast Co. - Local Server
echo ========================================================
echo.

:: Check if php is in PATH, otherwise use the full installation path
where php >nul 2>nul
if %errorlevel% equ 0 (
    set "PHP_CMD=php"
) else (
    set "PHP_CMD=C:\Users\Ankit gupta\AppData\Roaming\Local\lightning-services\php-8.2.27+1\bin\win64\php.exe"
)

echo Starting PHP built-in web server at http://localhost:8000 ...
echo Press Ctrl+C to stop the server.
echo.

"%PHP_CMD%" -S localhost:8000 router.php
pause
