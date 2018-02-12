<?php

/*
 |--------------------------------------------------------------------------
 | Test Macros
 |--------------------------------------------------------------------------
 */

    // Macros
    Route::name('dev.macros')->get('macros', function () {
        return view('common.macros');
    });

/*
 |--------------------------------------------------------------------------
 | Test Error Pages
 |--------------------------------------------------------------------------
 */

    Route::prefix('force')->group(function () {

        Route::middleware('web')->group(function () {
            // Force Errors
            Route::name('dev.error400')->get('error400', function () {
                abort(400);
            });
            Route::name('dev.error403')->get('error403', function () {
                abort(403);
            });
            Route::name('dev.error404')->get('error404', function () {
                abort(404);
            });
            Route::name('dev.error408')->get('error408', function () {
                abort(408);
            });
            Route::name('dev.error500')->get('error500', function () {
                abort(500);
            });
            Route::name('dev.error503')->get('error503', function () {
                abort(503);
            });
        });
    });

/*
 |--------------------------------------------------------------------------
 | Show Routes  http://localhost/routes
 |--------------------------------------------------------------------------
 */

    // Show Routes
    Route::name('dev.routes')->get('routes', function () {
        $routeCollection = Route::getRoutes();

        echo "<table style='width:100%'>";
        echo "<tr>";
            echo "<td width='10%'><h4>HTTP Method</h4></td>";
            echo "<td width='20%'><h4>Route</h4></td>";
            echo "<td width='20%'><h4>Path</h4></td>";
            echo "<td width='50%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
                echo "<td>" . $value->methods()[0] . "</td>";
                echo "<td>" . $value->getName() . "</td>";
            if ($value->methods()[0] == 'GET') {
                echo "<td><a href='/". $value->uri() ."'>" . $value->uri() . "</a></td>";
            } else {
                echo "<td>" . $value->uri() . "</td>";
            }
                echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    });
