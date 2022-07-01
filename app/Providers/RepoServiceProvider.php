<?php

namespace App\Providers;

use App\Repositery\QuestionRepositeryInterface;
use App\Repositery\StudentGraduatedRepositeryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositeryInterface',
            'App\Repository\TeacherRepositery');

        $this->app->bind(
            'App\Repository\StudentRepositeryInterface',
            'App\Repository\StudentRepositery');


        $this->app->bind(
            'App\Repository\StudentPromotionRepositeryInterface',
            'App\Repository\StudentPromotionRepositery');


        $this->app->bind(
            'App\Repository\StudentGraduatedRepositeryInterface',
            'App\Repository\StudentGraduatedRepositery');


        $this->app->bind(
            'App\Repository\StudentFeesRepositeryInterface',
            'App\Repository\StudentFeesRepositery');

        $this->app->bind(
            'App\Repository\FeesInvoicesRepositeryInterface',
            'App\Repository\FeesInvoicesRepositery');

        $this->app->bind(
            'App\Repository\AttandenceRepositeryInterface',
            'App\Repository\AttandenceRepositery');

        $this->app->bind(
            'App\Repository\SubjectRepositeryInterface',
            'App\Repository\SubjectRepositery');

        $this->app->bind(
            'App\Repository\QuizRepositeryInterface',
            'App\Repository\QuizRepositery');

        $this->app->bind(
            'App\Repository\QuestionRepositeryInterface',
            'App\Repository\QuestionRepositery');


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
