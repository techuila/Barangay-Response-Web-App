## Barangay Response Web App

The Barangay Response Web App is a comprehensive solution designed to streamline and enhance the management of local community responses in the Philippines. This application facilitates efficient communication, incident reporting, and resource allocation within barangays (the smallest administrative division in the Philippines).

### Features

- Incident reporting and tracking

### Requirements

- Docker
- Docker Compose

### Development Setup

To run the Barangay Response Web App in development mode using Docker, follow these steps:

1. Clone the repository:
   ```
   git clone https://github.com/techuila/Barangay-Response-Web-App.git
   cd Barangay-Response-Web-App
   ```

2. Create a `.env` file in the project root and add necessary environment variables:
   ```
   DB_CONNECTION=mysql
   DB_HOST=host.docker.internal
   DB_PORT=3306
   DB_DATABASE=article
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Install PHP dependencies using Composer:
   ```
   docker run --rm -v $(pwd):/app composer install
   ```

4. Build and run the Docker containers:
   ```
   docker-compose up -d --build
   ```

4. Access the application at `http://localhost:8000`

To stop the application, press `Ctrl+C` in the terminal where Docker is running

```
### System Architecture

The Barangay Response Web App is part of a larger system that includes:

1. **Web Application**: This main interface for barangay officials to manage responses and view data.

2. **Server Mobile App**: A separate mobile application that acts as an SMS gateway. It receives all SMS messages from clients and forwards them to the web application for processing.

3. **Client Mobile App**: A mobile application for residents that allows them to send emergency SMS messages with their location when they click an emergency button.

This architecture enables the system to work in areas with limited internet connectivity by leveraging SMS technology for critical communications.

### Related Applications

- **SMS Gateway Server App**: [Link to repository]
- **Emergency Client App**: [Link to repository]

Please refer to the documentation of these related applications for their specific setup and usage instructions.
