# Amadeus Flight Booking API Integration - Laravel Project

This project integrates the Amadeus Flight Booking API into a Laravel application. It includes the following functionalities:

1. **Flight Offer Search** - Search for available flights based on various criteria (origin, destination, dates, etc.).
2. **Validate Flight Price** - Validate the price of a flight offer before proceeding with the booking.
3. **Flight Booking** - Finalize the flight booking process using validated flight offers.

## Prerequisites

Before you get started, ensure you have the following:

- PHP >= 8.0
- Composer
- Laravel 8 or higher
- An Amadeus Developer Account (sign up at [Amadeus for Developers](https://developers.amadeus.com/))
- Amadeus API credentials (API Key & API Secret)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/amadeus-flight-booking.git
   cd amadeus-flight-booking

2. **Install dependencies:**

   ```bash
   composer install

3. **Set up environment variable:**

   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

3. **Run the Application:**

   ```bash
    php artisan serve


## Usage

Authorization
Amadeus API requires authorization via an OAuth 2.0 token. You need to retrieve and use the token in all API requests.

To generate an access token:

Use your API Key and API Secret to request a token from Amadeus.
The token should be included in the Authorization header in the format Bearer {access_token} for each API call.

# Features

-  Flight Offer Search
Use this endpoint to search for flight offers.

- Validate Flight Price
Before booking, you must validate the flight price.

- Flight Booking
Once the flight price is validated, you can proceed with the booking.