<?php

declare(strict_types=1);

use Livewire\Volt\Volt;

Volt::route('/', 'pages.home')->name('home');
Volt::route('/operating-systems', 'pages.operating-systems')->name('operating-systems');
Volt::route('/websites', 'pages.websites')->name('websites');
Volt::route('/how-we-work', 'pages.how-we-work')->name('how-we-work');
Volt::route('/about', 'pages.about')->name('about');
Volt::route('/faq', 'pages.faq')->name('faq');
Volt::route('/contact', 'pages.contact')->name('contact');
Volt::route('/privacy', 'pages.privacy')->name('privacy');
Volt::route('/terms', 'pages.terms')->name('terms');
