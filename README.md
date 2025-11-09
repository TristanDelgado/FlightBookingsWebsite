# Flight Booking Website

## Purpose
Produce a full-fledged website with real-time airline flight information and search capabilities.

## Features
- Create and sign into a user account
- Search for real-time flights
- Save flights for later retrieval

## Tech Stack
- HTML
- CSS
- JavaScript
- PHP
- XAMPP
  - Apache
  - SQL
- SQL Workbench
- Visual Studio Code
- Google Maps API

## Notes
Created for CS-4443-TSAA: Web Development, Troy University, Spring 2024.

## Video Demo
Click [HERE](https://youtu.be/S8lbMAEBwTU) to view the final demo of the working website.

## Walkthrough
The flight booking website functions as a basic copy of common flight booking websites. It allows users to create accounts, log in, search for real-time flights, and save flights to their account to view later.

### Home Screen & Searching
The initial home screen presented to the user.

![Home-Screen](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Home-Screen.png)

Scrolling to the bottom reveals the flight search bar. The 'From?' and 'To?' fields use the Google Maps API to autopopulate city names.

![Home-Screen-Empty](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Home-Screen-Empty.png)

Users can type into the search bar to get real-time flights.

![Searching-for-flights](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Searching-for-flights.png)

After searching, real-time flight results are displayed. If signed in, the user can click the 'Save' button to save the flight to their account.

![Returned-searched-flights](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Returned-searched-flights.png)

### User Accounts
From the top-left corner of the home screen, users can log in or create a new account.

![Home-Screen](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Home-Screen.png)

Clicking 'Login' leads to the sign-in page.

![Sign-In](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Sign-In.png)

New users can select the 'Sign Up' button to navigate to the account creation screen.

![Sign-Up](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Sign-Up.png)

### Saved Flights
Once signed in, users can view their saved flights by clicking the 'View Saved' button on the home screen.

![Home-Screen-Signed-In](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Home-Screen-Signed-In.png)

This displays all flights the user has previously saved.

![Saved-Flights](https://github.com/TristanDelgado/FlightBookingsWebsite/blob/main/Readme-Images/Saved-Flights.png)