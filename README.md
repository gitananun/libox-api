<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Libox
---
Libox is own startup. Platform to take courses online. For each course we have a full information about the reviews, views, instructors, length, certification and other stuff.

For the authentication, you can sign in via Social Platforms (e.g. Gmail, Github), or use the sign up with credentials option.

User can manage own the courses, and personal information. Can change the password after the email verification. Can add new courses or delete them.

User can get the notifications related to course creation with pending status for example, account creation and delete, password change and etc..

## Two examples of Models

### User
- name - `required|string|max:255`
- lastname - `required|string|max:255`
- roles - ADMIN, BASIC, STUDENT - `in_array($value, User::ROLES)`
- email - `required|email|max:255|unique:users`
- password - `required|string|min:6`
- date_of_birth - `nullable|date`
- email_verified_at
- created_at
- updated_at

### Course
- title - `required|string|max:255|unique:courses,title`
- rating - `nullable|numeric|between:0.0,5.0`
- price - `nullable|numeric|between:0.0,999.0`
- length - `nullable|numeric|between:0.0,999.0`
- language - `in_array($value, resourcebundle_locales(''))`
- likes - `numeric|min:0`
- description - `required|min:20`
- lessons - `nullable|int|min:0|max:999`
- certification - `nullable|boolean`
- last_updated
- created_at
- updated_at
- last_updated
- published_at

### Relations

##### User
- Has many courses
- Has many providers
- Balongs to many courses

##### Course
- Balongs to many categories
- Balongs to badge
- Belongs to many instructors
- has one statistic


    



