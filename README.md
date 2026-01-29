# 🚕 Ride Booking System – Laravel 12

A simple backend system built with Laravel 12 that exposes APIs for a mobile
ride-booking application and a Blade-based admin panel.

---

## 📌 Features

### Passenger APIs
- Create ride request (pickup & destination coordinates)
- Approve a driver
- Mark ride as completed

### Driver APIs
- Update live location
- Fetch nearby pending rides
- Request/claim a ride
- Mark ride as completed

### Ride Completion Logic
- Ride is completed **only when both passenger & driver confirm completion**

### Admin Panel (Blade)
- View all rides
- View ride details (passenger, driver, coordinates, status, timestamps)

---

## 🛠 Tech Stack
- Laravel 12
- PHP 8.2+
- MySQL
- Blade Templates
- REST APIs (JSON)

---

## 🚀 Installation Steps

```bash
git clone https://github.com/your-username/ride-booking.git
cd ride-booking
composer install
cp .env.example .env
php artisan key:generate


Recommended Testing Order For Testing API (IMPORTANT)

1.Create Ride (Passenger)
2.Update Driver Location
3.Fetch Nearby Rides
4.Driver Requests Ride
5.Passenger Approves Driver
6.Passenger Completes Ride
7.Driver Completes Ride


