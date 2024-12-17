# Dockerfile for application
FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/application

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/application

# Set environment variables for user
ARG USER_ID=1000
ARG GROUP_ID=1000

# Create a user with the specified UID and GID
RUN groupadd -g ${GROUP_ID} appgroup && \
    useradd -u ${USER_ID} -g appgroup -m appuser

# Fix permissions
RUN chown -R appuser:appgroup /var/www/application \
    && chmod -R 775 /var/www/application

# Switch to the new user for running the application
USER appuser

# Set default command
CMD ["php-fpm"]
