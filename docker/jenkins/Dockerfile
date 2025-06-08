FROM jenkins/jenkins:lts

USER root

# Instalar Docker CLI
RUN apt-get update && \
    apt-get install -y docker.io docker-compose && \
    apt-get clean

# Docker group config (opcional)
RUN usermod -aG docker jenkins
