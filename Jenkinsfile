pipeline {
    agent any
    stages {
        stage("Build") {

            steps {
                git 'https://github.com/alexandru1985/task_invoices.git'
                sh 'composer install'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
                sh 'php artisan migrate'
            }
        }
        stage("Unit test") {
            steps {
               sh './vendor/bin/phpunit'
            }
        }
    }
}