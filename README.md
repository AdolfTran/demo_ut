

[![Travis](https://travis-ci.org/AdolfTran/demo_ut.svg?branch=master)](https://travis-ci.org/AdolfTran/demo_ut.svg?branch=master)

## Installation
1. Run `touch .env`
2. Run `cp .env.example .env`
3. Change info database in file .env
4. Run `php artisan key:generation`
5. Run `php artisan migrate`
6. Run `php artisan db:seed`# demo_ut


## Run testcase
1. Run all test: `phpunit`
2. Run one file test: `phpunit --filter LoginFunctionTest`
