<?php

// login regis
route('/','get', function () { return view('registrasi'); });
route('login','get', function () { return view('login'); });
route('registrasi','get', function () { return view('registrasi'); });


// regist
route('registrasi','post', 'dashboardController::regist');


// auth login
route('login','post', 'dashboardController::login');
route('dashboard','get', 'dashboardController::index');


// edit film
route('editFilm','get', 'dashboardController::editFilm');
route('editFilm','post', 'dashboardController::editFilm');


// tambah film
route('tambahFilm','get', function () { return view('crudViews/tambah'); });
route('tambahFilm','post', 'dashboardController::tambahFilm');


// Delete FIlm
route('deleteFilm','get', 'dashboardController::deleteFilm');