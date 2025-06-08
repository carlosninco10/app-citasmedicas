pipeline {
    agent any

    environment {
        COMPOSE_FILE = 'docker-compose.yml'
    }

    stages {
        stage('Clone repository') {
            steps {
                git branch: 'main', url: 'https://github.com/carlosninco10/app-citasmedicas.git'
            }
        }

        stage('Stop containers') {
            steps {
                sh 'docker-compose -f $COMPOSE_FILE stop mysql_service php_service'
            }
        }

        stage('Build containers') {
            steps {
                sh 'docker-compose -f $COMPOSE_FILE up -d --build --force-recreate mysql_service php_service'
            }
        }

        stage('Wait for PHP container') {
            steps {
                script {
                    sh '''
                    echo "Esperando que el contenedor PHP esté listo..."
                    for i in {1..10}; do
                        docker-compose -f $COMPOSE_FILE exec -T php_service curl -s http://localhost:9000 > /dev/null && break
                        echo "Esperando 3 segundos..."
                        sleep 3
                    done
                    '''
                }
            }
        }

        stage('Wait for MySQL') {
            steps {
                sh '''
                echo "Esperando que MySQL esté listo..."
                for i in {1..10}; do
                    docker-compose -f $COMPOSE_FILE exec -T mysql_service mysqladmin ping -h"localhost" --silent && break
                    echo "Esperando 3 segundos..."
                    sleep 3
                done
                '''
            }
        }

        stage('Generate key') {
            steps {
                sh 'docker-compose -f $COMPOSE_FILE exec -T php_service php artisan key:generate'
            }
        }

        stage('Run migrations') {
            steps {
                sh 'docker-compose -f $COMPOSE_FILE exec -T php_service php artisan migrate --force'
            }
        }

        stage('Run tests') {
            steps {
                sh 'docker-compose -f $COMPOSE_FILE exec -T php_service php artisan test'
            }
        }
    }
}
