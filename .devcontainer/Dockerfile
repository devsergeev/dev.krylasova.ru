# See here for image contents: https://github.com/microsoft/vscode-dev-containers/tree/v0.163.1/containers/php/.devcontainer/base.Dockerfile

# [Choice] PHP version: 8, 8.0, 7, 7.4, 7.3
ARG VARIANT
FROM mcr.microsoft.com/vscode/devcontainers/php:0-${VARIANT}

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

# Change document root for Apache
RUN sed -i -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# [Option] Install Node.js
ARG INSTALL_NODE
ARG NODE_VERSION
RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "umask 0002 && . /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1