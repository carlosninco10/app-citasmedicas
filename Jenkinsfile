pipeline {
    agent any

    stages {
        stage('Clone repository') {
            steps {
                git branch: 'main', url: 'https://github.com/carlosninco10/app-citasmedicas.git'
            }
        }

        stage('Stop containers') {
            steps {
                sh 'docker compose  stop mysql_service php_service'
            }
        }

        stage('Build containers') {
            steps {
                sh 'docker compose  up -d --build --force-recreate mysql_service php_service'
            }
        }


        stage('Generate key') {
            steps {
                sh 'docker compose exec php_service php artisan key:generate'
            }
        }

        stage('Run migrations') {
            steps {
                sh 'docker compose  exec  php_service php artisan migrate --force'
            }
        }

        stage('Run tests') {
            steps {
                sh 'docker compose  exec  php_service php artisan test'
            }
        }
    }
}
