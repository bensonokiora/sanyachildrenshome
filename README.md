# Sanya Children's Home Website

This is a WordPress-based website for Sanya Children's Home. The project is containerized with Docker and can be deployed on Kubernetes.

## Project Structure

```
├── wordpress/          # Current WordPress installation
├── WordPress-new/      # New WordPress installation
├── kubernetes/         # Kubernetes deployment files
├── Dockerfile         # Docker build configuration
├── docker-entrypoint.sh # Docker entrypoint script
└── start.sh           # SSH service startup script
```

## Prerequisites

- Docker
- Docker Compose (optional)
- PHP 8.2+ with Apache (for local development)
- MySQL/MariaDB database
- MAMP/XAMPP/WAMP (for local development)

## Local Development Setup

### Option 1: MAMP/XAMPP Setup

1. **Install MAMP/XAMPP** on your system

2. **Clone the repository** to your MAMP/XAMPP htdocs directory:
   ```bash
   cd /Applications/MAMP/htdocs/  # MacOS MAMP path
   # or C:\xampp\htdocs\           # Windows XAMPP path
   git clone <repository-url> sanyachildrenshome
   ```

3. **Start MAMP/XAMPP** services (Apache and MySQL)

4. **Create the database**:
   - Open phpMyAdmin (usually at http://localhost/phpMyAdmin)
   - Create a new database named `sanyachildrenshome`

5. **Configure WordPress**:
   - Navigate to `http://localhost/sanyachildrenshome/wordpress/`
   - The site should load with existing configuration

### Option 2: Docker Development

1. **Build the Docker image**:
   ```bash
   docker build -t sanyachildrenshome .
   ```

2. **Run with Docker Compose** (recommended):
   ```bash
   # Create docker-compose.yml first (see Docker Compose section below)
   docker-compose up -d
   ```

3. **Or run with Docker directly**:
   ```bash
   docker run -d \
     --name sanyachildrenshome \
     -p 8080:80 \
     -v $(pwd)/wordpress/wp-content:/var/www/html/wp-content \
     sanyachildrenshome
   ```

## Docker Compose Setup

Create a `docker-compose.yml` file:

```yaml
version: '3.8'

services:
  wordpress:
    build: .
    ports:
      - "8080:80"
    volumes:
      - ./wordpress/wp-content:/var/www/html/wp-content
    environment:
      - APACHE_RUN_USER=www-data
      - APACHE_RUN_GROUP=www-data
    depends_on:
      - mysql

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: sanyachildrenshome
      MYSQL_USER: wpuser
      MYSQL_PASSWORD: wppassword
    volumes:
      - mysql_data:/var/lib/mysql
    ports:
      - "3306:3306"

volumes:
  mysql_data:
```

Run with:
```bash
docker-compose up -d
```

## Kubernetes Deployment

The project includes Kubernetes deployment files in the `kubernetes/` directory.

### Prerequisites for Kubernetes:
- Kubernetes cluster
- kubectl configured
- Container registry access
- Persistent Volume Claim (PVC) for wp-content

### Deploy to Kubernetes:

1. **Build and push the Docker image** to your registry:
   ```bash
   docker build -t your-registry/sanyachildrenshome:latest .
   docker push your-registry/sanyachildrenshome:latest
   ```

2. **Update the deployment.yaml**:
   - Replace `__DOCKER_REPOSITORY__`, `__IMAGE_NAME__`, and `__IMAGE_TAG__` with your values
   - Line 39: `image: registry.gitlab.com/your-repo/your-image:your-tag`

3. **Create the PVC** (adjust storage class as needed):
   ```bash
   kubectl apply -f - <<EOF
   apiVersion: v1
   kind: PersistentVolumeClaim
   metadata:
     name: sanyachildrenshome-pvc
   spec:
     accessModes:
       - ReadWriteOnce
     resources:
       requests:
         storage: 10Gi
   EOF
   ```

4. **Deploy the application**:
   ```bash
   kubectl apply -f kubernetes/deployment.yaml
   kubectl apply -f kubernetes/service.yaml
   ```

5. **Access the application**:
   ```bash
   kubectl get services
   # Use the external IP or create an ingress
   ```

## Database Configuration

The WordPress configuration is set up for local development with these default settings:

- **Database Name**: `sanyachildrenshome`
- **Username**: `root`
- **Password**: `root`
- **Host**: `localhost`

For production, update the `wp-config.php` or use environment variables.

## WordPress Administration

- **Admin URL**: `http://your-domain/wp-admin/`
- **Frontend URL**: `http://your-domain/`

## File Permissions

The Docker setup automatically handles file permissions. For local development:

```bash
# Make wp-content writable
chmod -R 755 wordpress/wp-content/
chmod -R 777 wordpress/wp-content/uploads/
```

## Development Notes

- The project contains two WordPress directories (`wordpress/` and `WordPress-new/`)
- The Dockerfile copies from `WordPress-new/` directory
- wp-content is mounted as a volume to persist uploads, plugins, and themes
- The entrypoint script handles wp-config.php setup and permissions

## Troubleshooting

### Permission Issues
```bash
# Fix file ownership (if running locally)
sudo chown -R www-data:www-data wordpress/
```

### Database Connection Issues
1. Verify database credentials in `wp-config.php`
2. Ensure database server is running
3. Check database exists and user has proper permissions

### Docker Issues
```bash
# Check container logs
docker logs sanyachildrenshome

# Access container shell
docker exec -it sanyachildrenshome bash
```

## Production Considerations

1. **Security**: Update WordPress salts and keys in `wp-config.php`
2. **Database**: Use a separate database server with proper credentials
3. **SSL/HTTPS**: Configure SSL certificates and force HTTPS
4. **Backups**: Set up regular database and file backups
5. **Updates**: Keep WordPress core, themes, and plugins updated
6. **Monitoring**: Implement logging and monitoring solutions

## Support

For issues or questions, please refer to:
- WordPress Documentation: https://wordpress.org/documentation/
- Docker Documentation: https://docs.docker.com/
- Kubernetes Documentation: https://kubernetes.io/docs/