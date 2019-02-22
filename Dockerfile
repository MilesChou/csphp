FROM php:7.3-alpine

RUN mkdir -p /source
WORKDIR /source
COPY ./csphp.phar .

ENTRYPOINT ["php", "csphp.phar"]
CMD ["--"]
