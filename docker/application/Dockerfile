# Dockerfile for application
FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/application

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl && \
    docker-php-ext-install pdo pdo_pgsql

# Set environment variables for user
ARG USER_ID=1000
ARG GROUP_ID=1000

# Create a user with the same UID and GID as the host
RUN groupadd -g ${GROUP_ID} appgroup && \
    useradd -u ${USER_ID} -g appgroup -m appuser && \
    chown -R appuser:appgroup /var/www/application

# Switch to the new user
USER appuser

# Copy application files
COPY . /var/www/application

# Set default command
CMD ["php-fpm"]