#!/bin/bash

npm run dev &
sleep 3
php artisan octane:start --watch
trap "kill 0" EXIT
