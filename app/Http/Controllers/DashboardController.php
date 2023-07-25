<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index() {

        $chart = new DashboardChart;

        $dataUsers = collect([]);
        $dataMovies = collect([]);
        $dataComments = collect([]);

        for ($days_backwards = 2; $days_backwards >= 0; $days_backwards--) {

            $dataUsers->push(User::whereDate('created_at', today()->subDays($days_backwards))->count());
            $dataMovies->push(User::whereDate('created_at', today()->subDays($days_backwards))->count());
            $dataComments->push(User::whereDate('created_at', today()->subDays($days_backwards))->count());
        }

        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Users', 'line', $dataUsers);
        $chart->dataset('Movies', 'line', $dataMovies);
        $chart->dataset('Movies', 'line', $dataComments);
        



        return view("dashboard.index", [
            "chart" => $chart,
            "movies" => Movie::all(),
            "comments" => Comment::all(),
            "users" => User::all(),
        ]);
    }
}
