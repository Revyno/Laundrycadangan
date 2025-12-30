# Laundrycadangan - Laundry Management System

A comprehensive web-based laundry management system built with Laravel and Filament, designed to streamline shoe cleaning and laundry service operations.

## 🚀 Features

### Admin Panel
- **Dashboard Analytics**: Real-time statistics and insights
- **Customer Management**: Complete customer database with profiles
- **Order Management**: Track orders from creation to delivery
- **Service Management**: Manage different laundry services and pricing
- **Payment Processing**: Handle payments and generate invoices
- **Reporting**: Generate detailed laundry reports
- **User Management**: Admin and customer role management

### Customer Panel
- **Order Placement**: Easy online order booking
- **Order Tracking**: Real-time order status updates
- **Payment Integration**: Secure online payments
- **Invoice Generation**: Automatic invoice creation and email delivery
- **Profile Management**: Customer account management

### Core Features
- **Multi-Service Support**: Various laundry services (shoes, clothes, etc.)
- **Order Status Tracking**: Complete workflow from pending to delivered
- **Automated Notifications**: Email notifications for order updates
- **PDF Generation**: Invoice and report generation
- **Photo Upload**: Before/after service photos
- **Delivery Options**: Drop-off, pickup, and delivery services

## 🛠️ Technology Stack

- **Backend**: Laravel 12.41
- **Admin Interface**: Filament 3.3
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL/SQLite
- **JavaScript**: Vite, Livewire
- **PDF Generation**: DomPDF
- **File Storage**: AWS S3/Local
- **Icons**: Heroicons
- **Authentication**: Laravel Socialite

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite database

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Revyno/Laundrycadangan.git
   cd Laundrycadangan
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   - Configure your database settings in `.env`
   - Run migrations and seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Start the Application**
   ```bash
   php artisan serve
   ```

   Or use the convenient dev script:
   ```bash
   composer run dev
   ```

## 🔧 Configuration

### Environment Variables

Key configuration options in `.env`:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundrycadangan
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password

# AWS S3 (Optional)
AWS_ACCESS_KEY_ID=your_key
AWS_SECRET_ACCESS_KEY=your_secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_bucket
```

### Admin Setup

Create an admin user:
```bash
php artisan make:filament-user
```

## 📖 Usage

### Admin Panel Access
- Navigate to `/admin` to access the admin panel
- Use Filament's authentication system

### Customer Panel Access
- Navigate to `/customer` for customer-specific features
- Customers can register and manage their orders

### Order Workflow
1. Customer places order (drop-off/pickup/delivery)
2. Admin processes the order
3. Service completion with photo documentation
4. Payment processing
5. Delivery/notification to customer

## 🗂️ Project Structure

```
app/
├── Filament/           # Admin and customer panels
├── Http/Controllers/   # Web controllers
├── Mail/              # Email templates
├── Models/            # Eloquent models
├── Notifications/     # Notification classes
└── Providers/         # Service providers

database/
├── migrations/        # Database migrations
└── seeders/          # Database seeders

resources/
├── css/              # Stylesheets
├── js/               # JavaScript files
└── views/            # Blade templates

public/
├── css/              # Compiled styles
├── js/               # Compiled scripts
└── images/           # Static images
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📊 Available Commands

- `composer run setup`: Complete project setup
- `composer run dev`: Start development servers
- `composer run test`: Run test suite
- `npm run dev`: Start Vite dev server
- `npm run build`: Build production assets

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [Filament](https://filamentphp.com/) - Admin panel framework
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Heroicons](https://heroicons.com/) - Beautiful hand-crafted SVG icons

## 📞 Support

For support, email support@laundrycadangan.com or create an issue in this repository.

---

**Made with Revel ❤️ for efficient laundry management system**
