# 🚀 Free Production Deployment Guide

## **Option 1: Heroku (Recommended - Easiest)**

### **Step 1: Create Heroku Account**
1. Go to [heroku.com](https://heroku.com)
2. Sign up for free account
3. Install Heroku CLI: [devcenter.heroku.com/articles/heroku-cli](https://devcenter.heroku.com/articles/heroku-cli)

### **Step 2: Deploy to Heroku**
```bash
# Login to Heroku
heroku login

# Create new app
heroku create your-discipline-tracker

# Add PostgreSQL database (free)
heroku addons:create heroku-postgresql:mini

# Set environment variables
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_NAME="Willow Tree Academy Discipline System"
heroku config:set QUEUE_CONNECTION=database
heroku config:set SESSION_DRIVER=database
heroku config:set CACHE_DRIVER=database

# Set up email (Mailgun - free)
heroku addons:create mailgun:starter
# Or use your existing Gmail setup:
heroku config:set MAIL_MAILER=smtp
heroku config:set MAIL_HOST=smtp.gmail.com
heroku config:set MAIL_PORT=587
heroku config:set MAIL_USERNAME=test.discipline23@gmail.com
heroku config:set MAIL_PASSWORD="your-app-password"
heroku config:set MAIL_ENCRYPTION=tls
heroku config:set MAIL_FROM_ADDRESS=test.discipline23@gmail.com
heroku config:set MAIL_FROM_NAME="Willow Tree Academy Discipline System"

# Deploy
git add .
git commit -m "Production ready"
git push heroku main

# Run migrations and seed
heroku run php artisan migrate --force
heroku run php artisan db:seed --force

# Scale workers (for email processing)
heroku ps:scale worker=1
```

### **Step 3: Test Your App**
- Visit: `https://your-discipline-tracker.herokuapp.com`
- Create admin user
- Test email functionality

---

## **Option 2: Railway (Alternative)**

### **Step 1: Create Railway Account**
1. Go to [railway.app](https://railway.app)
2. Sign up with GitHub
3. Get $5 free credit monthly

### **Step 2: Deploy**
1. Connect your GitHub repository
2. Railway will auto-detect Laravel
3. Add PostgreSQL database
4. Set environment variables
5. Deploy automatically

---

## **Option 3: Render (Alternative)**

### **Step 1: Create Render Account**
1. Go to [render.com](https://render.com)
2. Sign up for free account

### **Step 2: Deploy**
1. Connect GitHub repository
2. Choose "Web Service"
3. Add PostgreSQL database
4. Set environment variables
5. Deploy

---

## **🔧 Environment Variables to Set:**

```bash
APP_ENV=production
APP_DEBUG=false
APP_NAME="Willow Tree Academy Discipline System"
APP_URL=https://your-app-url.com

DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

QUEUE_CONNECTION=database
SESSION_DRIVER=database
CACHE_DRIVER=database

# Email (choose one):
# Option A: Mailgun (free)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your-mailgun-user
MAIL_PASSWORD=your-mailgun-password
MAIL_ENCRYPTION=tls

# Option B: Gmail (your current setup)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=test.discipline23@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

## **🎯 Quick Start (Choose One):**

### **Heroku (Recommended)**
```bash
# 1. Install Heroku CLI
# 2. Run these commands:
heroku login
heroku create your-discipline-tracker
heroku addons:create heroku-postgresql:mini
git push heroku main
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
heroku ps:scale worker=1
```

### **Railway**
1. Connect GitHub repo
2. Add PostgreSQL
3. Set environment variables
4. Deploy automatically

### **Render**
1. Connect GitHub repo
2. Add PostgreSQL
3. Set environment variables
4. Deploy automatically

## **✅ What You Get:**
- ✅ **Free hosting** (forever)
- ✅ **Free database** (PostgreSQL)
- ✅ **Free SSL certificate** (HTTPS)
- ✅ **Free email service** (Mailgun/Gmail)
- ✅ **Automatic queue worker** (email processing)
- ✅ **Custom domain** (optional)

## **💰 Total Cost: $0**

Your app will be completely free to run and maintain! 🎉
