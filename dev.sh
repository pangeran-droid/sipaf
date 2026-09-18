#!/bin/bash

npm run dev &
sleep 2
php artisan octane:start --watch
trap "kill 0" EXIT
