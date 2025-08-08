# Render Deployment Guide

## 🚀 Deploy to Render (Free Hosting)

### **Step 1: Prepare Your Repository**

1. **Clean Demo Data** (if you have any):
   ```bash
   php artisan db:clean --force
   ```

2. **Commit all changes**:
   ```bash
   git add .
   git commit -m "Ready for production deployment"
   git push origin main
   ```

### **Step 2: Deploy on Render**

1. **Go to [Render Dashboard](https://dashboard.render.com/)**
2. **Click "New +" → "Blueprint"**
3. **Connect your GitHub repository**
4. **Select your discipline-tracker repository**
5. **Render will automatically detect the `render.yaml` file**

### **Step 3: Configure Environment Variables**

After deployment, go to your service settings and add these environment variables:

#### **Database (Auto-configured by Render)**
- `DB_HOST` - Auto-set by Render
- `DB_PORT` - Auto-set by Render  
- `DB_DATABASE` - Auto-set by Render
- `DB_USERNAME` - Auto-set by Render
- `DB_PASSWORD` - Auto-set by Render

#### **Email Configuration (Required)**
```
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
```

#### **Optional: Custom Domain**
```
APP_URL=https://your-custom-domain.com
```

### **Step 4: Run Database Setup**

1. **Go to your web service on Render**
2. **Click "Shell"**
3. **Run these commands**:
   ```bash
   php artisan migrate
   php artisan db:seed --class=ProductionSeeder
   ```

### **Step 5: Access Your App**

- **URL**: `https://your-app-name.onrender.com`
- **Admin Login**: `admin@school.edu` / `admin123`
- **⚠️ Change the admin password immediately!**

## 🔧 **Post-Deployment Setup**

### **1. Change Admin Password**
1. Log in with `admin@school.edu` / `admin123`
2. Go to User Management
3. Edit the admin user and set a new password

### **2. Configure Email**
1. Update email settings in User Management
2. Test email notifications

### **3. Add School Staff**
1. Create accounts for teachers, principals, counselors
2. Assign appropriate roles and departments

### **4. Customize Categories**
1. Add your school's specific incident types
2. Add your school's achievement categories

## 🎯 **Production Features**

✅ **Free Hosting** - No cost to run  
✅ **Automatic Deployments** - Updates when you push to GitHub  
✅ **SSL Certificate** - Secure HTTPS  
✅ **Database Included** - PostgreSQL database  
✅ **Queue Worker** - Email notifications work  
✅ **Custom Domain** - Optional (you can add your own domain)  

## 🆘 **Troubleshooting**

### **If emails don't work:**
1. Check your Gmail app password
2. Verify MAIL_USERNAME and MAIL_PASSWORD are set
3. Check the worker service is running

### **If database errors occur:**
1. Run `php artisan migrate:fresh` in the shell
2. Run `php artisan db:seed --class=ProductionSeeder`

### **If the app is slow:**
1. This is normal for free tier
2. Consider upgrading to paid plan for better performance

## 🎉 **You're Live!**

Your discipline tracker is now running on Render and ready for your school to use!
