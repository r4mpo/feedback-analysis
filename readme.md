Requisitos:
- PHP 8.3


Instalation:
- git clone https://github.com/r4mpo/feedback-analysis.git
- cd feedback-analysis/docker

- docker-compose down --remove-orphans
docker image prune -f
docker-compose build --no-cache
docker-compose up

Acesse:
http://localhost:8000/