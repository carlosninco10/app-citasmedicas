pipeline {
    agent any

    environment {
        COMPOSE_PATH = '/app/docker-compose.yml'
    }

    stages {
        stage('Clone repository') {
            steps {
                git branch: 'main', url: 'https://github.com/carlosninco10/app-citasmedicas.git'
            }
        }

        stage('Build containers') {
            steps {
                sh 'docker-compose up -d --build --force-recreate'
            }
        }

        stage('Generate key') {
            steps {
                sh 'docker exec app-citasmedicas-php_service-1 php artisan key:generate'
            }
        }

        stage('Run migrations') {
            steps {
                sh 'docker exec app-citasmedicas-php_service-1 php artisan migrate --force'
            }
        }

        stage('Run tests') {
            steps {
                sh 'docker exec app-citasmedicas-php_service-1 php artisan test'
            }
        }
    }
}
