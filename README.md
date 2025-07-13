# 🏭 Food Processing Plant Management System

A comprehensive Laravel-based web application for managing food processing operations, quality control, maintenance, and research & development activities.

## ✨ Features

### 🏢 **Core Modules**
- **Production Management** - Track batches, monitor equipment, manage manufacturing processes
- **Quality Control** - Conduct inspections, review test results, ensure compliance
- **Maintenance** - Schedule repairs, monitor equipment performance, preventive maintenance
- **Sanitation** - Track cleaning schedules, maintain hygiene standards
- **Research & Development** - Manage innovation projects, product development
- **Supply Chain** - Monitor logistics, manage suppliers, track inventory
- **Analytics** - Comprehensive reporting and data insights

### 👥 **User Roles**
- **Production Operator** - Manage production batches and equipment
- **Quality Inspector** - Conduct quality control and compliance checks
- **Maintenance Technician** - Handle equipment maintenance and repairs
- **Research & Development** - Lead innovation and product development

### 🎨 **Modern UI/UX**
- **Responsive Design** - Works perfectly on mobile, tablet, and desktop
- **Modern Interface** - Clean, professional design with smooth animations
- **Role-based Access** - Different dashboards for different user types
- **Quick Login System** - One-click login for different user roles

## 🚀 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL/PostgreSQL database

### Step 1: Clone the Repository
```bash
git clone https://github.com/Pedurabo/Food-Processing-plant.git
cd Food-Processing-plant
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Configuration
```bash
# Update .env file with your database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=food_processing_firm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Database Migration and Seeding
```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

# Run analytics seeder for test data
php artisan db:seed --class=AnalyticsSeeder
```

### Step 6: Build Assets
```bash
# Build CSS and JavaScript assets
npm run build
```

### Step 7: Start the Application
```bash
# Start Laravel development server
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 👤 Test Accounts

The system comes with pre-configured test accounts for different user roles:

### Production Operator
- **Email**: `operator@foodprocessing.com`
- **Password**: `password123`
- **Access**: Production management, equipment monitoring

### Quality Inspector
- **Email**: `inspector@foodprocessing.com`
- **Password**: `password123`
- **Access**: Quality control, compliance checks

### Maintenance Technician
- **Email**: `technician@foodprocessing.com`
- **Password**: `password123`
- **Access**: Equipment maintenance, repair scheduling

### Research & Development
- **Email**: `researcher@foodprocessing.com`
- **Password**: `password123`
- **Access**: Innovation projects, product development

## 📊 Database Schema

### Core Tables
- `users` - User accounts and authentication
- `production_batches` - Manufacturing batch tracking
- `quality_control_records` - Inspection and testing results
- `maintenance_records` - Equipment maintenance history
- `sanitation_records` - Cleaning and hygiene tracking
- `research_and_development_projects` - R&D project management
- `supply_chain_logistics` - Supplier and inventory management

## 🛠️ Technology Stack

### Backend
- **Laravel 10** - PHP framework
- **MySQL/PostgreSQL** - Database
- **Eloquent ORM** - Database abstraction
- **Laravel Jetstream** - Authentication and team management

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Vite** - Build tool and development server

### Development Tools
- **Laravel Mix** - Asset compilation
- **PHPUnit** - Testing framework
- **Laravel Telescope** - Debugging and monitoring

## 🎯 Key Features

### Production Management
- Batch tracking and monitoring
- Equipment status monitoring
- Production scheduling
- Real-time process tracking

### Quality Control
- Inspection scheduling
- Test result recording
- Compliance monitoring
- Quality metrics dashboard

### Maintenance System
- Preventive maintenance scheduling
- Equipment performance tracking
- Repair history management
- Maintenance cost analysis

### Analytics & Reporting
- Real-time dashboards
- Performance metrics
- Trend analysis
- Custom report generation

## 🔧 Customization

### Adding New Modules
1. Create new migration files
2. Add models in `app/Models/`
3. Create controllers in `app/Http/Controllers/`
4. Add routes in `routes/web.php`
5. Create views in `resources/views/`

### Styling Customization
- Modify `resources/css/app.css`
- Update Tailwind configuration in `tailwind.config.js`
- Customize component styles in `resources/views/components/`

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Run `php artisan config:cache`
4. Set up web server (Apache/Nginx)
5. Configure SSL certificate

### Environment Variables
```env
APP_NAME="Food Processing Firm"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 🎉 Acknowledgments

- Laravel team for the amazing framework
- Tailwind CSS for the utility-first CSS framework
- All contributors and testers

---

**Built with ❤️ for Food Processing Industry**
