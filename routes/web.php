<?php


Route::get('', function () {
    return redirect('en');
});
/*
|--------------------------------------------------------------------------------------------------------------------------
| Web frontend
|--------------------------------------------------------------------------------------------------------------------------
*/
require_once('web-frontend.php');

/*
|--------------------------------------------------------------------------------------------------------------------------
| Web backend
|--------------------------------------------------------------------------------------------------------------------------
*/
require_once('web-backend.php');

