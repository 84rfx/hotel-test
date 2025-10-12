# StayEasy Hotel Laravel Conversion

This project is a Laravel 10 conversion of the original static HTML/CSS/JS StayEasy Hotel booking website.

## Features

- Laravel 10 framework with Blade templating.
- User and Admin sections.
- Frontend display converted from static HTML.
- Assets managed in public/assets.
- LocalStorage-based data handling (no database integration yet).
- Bootstrap 5 for styling.

## Setup

1. Install dependencies:
   ```
   composer install
   npm install
   ```

2. Run the development server:
   ```
   php artisan serve
   ```

3. Access the site at `http://localhost:8000`.

## Notes

- Authentication and data storage still use localStorage in the browser.
- Admin pages are under `/admin` prefix.
- Blade templates are used for layouts and views.

## Next Steps

- Implement backend authentication and database integration.
- Add API endpoints for data management.
- Enhance admin panel with real data.
