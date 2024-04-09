# ThoughtPad
The single player micro-blog.

This is a micro-blogging application, similar to X and Mastodon but focused on individual users.
Where other micro-blogging platforms are focused on social interaction, ThoughtPad is focused on the individual user and their thoughts.
As of Version 1, the application allows users to create, edit, and delete posts and all posts are private to the user.

## Tech Stack
- Laravel (Inertia / Vite)
- Vue
- Tailwind CSS
- Node

## Dependencies
- PHP (8.3.3)
- Composer (2.7.2)
- Node (21.7.1)
- NPM (10.5.0)

## Optional Dependencies
- MailPit (For development email testing)

## Installation
- Clone the repository to your local machine
- Run `composer install` to install the PHP dependencies
- Run `npm install` to install the JavaScript dependencies
- Clone the `.env.example` file to `.env` and fill in the necessary information
- Run `php artisan key:generate` to generate a new application key
- Run `php artisan migrate` to create the database tables
- Run `php artisan serve` to start the development server
  - This will be use to run the Laravel part of the stack. It is recommended to run this in a separate terminal window
- Run `npm run dev` to compile the assets and to start the vite server
  - This is used to run the Vite part of the stack. It is recommended to run this in a separate terminal window
- You can now access the application at the URL provided by ether command

### Optional Installation: MailPit
MailPit is a development mail server that allows you to view emails sent by your application.
To use MailPit please install it on your machine and follow the usage instructions on the [MailPit GitHub Page](https://github.com/axllent/mailpit).

If you are using MacOS and Homebrew, you can use the `npm run mail` and `npm run mail-stop` commands to start and stop the MailPit server.

To configgure mailpit to work with Thoughtpad, edit the `MAIL_MAILER` in the `.env` file to `mailpit` and fill in the necessary information.

```.env
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Usage
The package.json has a number of NPM Run scripts to help running the application easier.
- `npm run dev` - Compiles the assets
- `npm run serve` - Starts the development server (same as `php artisan serve`)
- `npm run mail` - Starts the MailPit server (Uses Brew Command, please install MailPit first and do not use this command if you do not use homebrew)
- `npm run mail-stop` - Stops the MailPit server (Uses Brew Command)

To run the application, you will need to run `npm run dev` and `npm run serve` (and / or their php equivlants) in separate terminal windows.

## Credits and Acknowledgements
The whole nine yards: Craig A. McLeod
- This project is based on the Laravel Bootcamp course provided on the [Laravel Website](https://bootcamp.laravel.com).
