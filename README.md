Drop fleet control master
=========================

Fleet control Rest Api to control a fleet of RaspberryPi robots.


## Install

Requires:

- git, docker, docker-compose

Fetch this repo:

``` bash
git clone git@github.com:alcalyn/drop-fleetcontrol-master.git
cd drop-fleetcontrol-master/
```

Configure your environment in a created `.env` file:

```
# Your RabbitMq host and exchange name
RABBITMQ_HOST=rabbitmq
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASS=guest

RABBITMQ_EXCHANGE=orders
```

Install and run the service:

``` bash
make
```
