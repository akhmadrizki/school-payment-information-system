# School Payment Information System
> Develop based on [Laravel v9](https://laravel.com/docs/9.x)

## Table of contents

- [Prerequisites](#prerequisites)
- [Setup](#setup)
- [Running the app](#running-the-app)
- [Database setup](#database-setup)

## Prerequisites

- PHP (8)

Please install these extensions on your code editor :

- laravel intellisense

## Setup

1. Fork this Repository:
2. Clone this Repository
```sh
$ git clone https://github.com/{your-username}/school-payment-information-system.git
```
3. Add upstream to the clone results
```sh
$ git remote add upstream https://github.com/akhmadrizki/school-payment-information-system.git
```
4. Copy file `.env.example` to `.env`:
5. Install all package
```sh
$ composer install
$ npm install
```

## Running the app

```sh
$ php artisan serve
```

## Database setup

```sh
...
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=
...
```

- Run this command:
```sh
$ php artisan key:generate
$ composer dump-autoload
$ php artisan migrate:fresh --seed
$ php artisan storage:link
```

### Following are the steps that must be taken in the contribution process
1. Always pull upstream whenever you want to start developing
```sh
$ git pull upstream development
```
2. Create a new branch for each developed feature. Example:
```sh
$ git branch feature/add-login // Contoh saat membuat branch untuk fitur baru
$ git branch bug/fix-menu // Contoh saat membuat branch untuk fix bug
```
3. If your work already done, push to the repo of your fork
```sh
$ git push origin {nama-branch}
```
4. When ready to be taken to the main repository. Make a Pull Request from your branch to the `development` branch. Before the pull request, make sure the branch is clean. If there is a conflict, please fix the conflict. Make sure to make a good title and description so it's easy to understand!
5. Ganbatte!!!
