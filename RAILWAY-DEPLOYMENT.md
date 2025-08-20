# Railway Deployment Guide (Better for Laravel)

## Why Railway over Vercel?
- ✅ **Better Laravel support**
- ✅ **Built-in PostgreSQL database**
- ✅ **Queue workers work properly**
- ✅ **No configuration issues**
- ✅ **Free tier available**

## Step 1: Sign up for Railway
1. Go to [railway.app](https://railway.app)
2. Sign up with your GitHub account
3. **Free tier includes $5 credit monthly**

## Step 2: Deploy from GitHub
1. Click "New Project"
2. Select "Deploy from GitHub repo"
3. Choose your `discipline-tracker` repository
4. Railway will automatically detect it's a Laravel app

## Step 3: Add PostgreSQL Database
1. In your project dashboard, click "New"
2. Select "Database" → "PostgreSQL"
3. Railway will automatically link it to your app

## Step 4: Configure Environment Variables
1. Go to your app's "Variables" tab
2. Add these variables:
   ```
   APP_KEY=base64:your-generated-key
   MAIL_USERNAME=your-gmail-username
   MAIL_PASSWORD=your-gmail-app-password
   ```

## Step 5: Deploy and Setup Database
1. Railway will automatically deploy
2. Once deployed, go to your app's "Deployments" tab
3. Click on the latest deployment
4. Open the terminal and run:
   ```bash
   php artisan migrate
   php artisan db:seed --class=ProductionSeeder
   ```

## Step 6: Start Queue Worker
1. In your project dashboard, click "New"
2. Select "Service" → "GitHub Repo"
3. Choose the same repository
4. Set the start command to: `php artisan queue:work --sleep=3 --tries=3 --max-time=3600`

## Step 7: Test Your App
1. Visit your Railway app URL
2. Login with: `admin@school.edu` / `admin123`
3. Test creating incidents and positive reports
4. Verify email notifications work

## Railway Advantages:
- ✅ **Perfect for Laravel**
- ✅ **Automatic PHP detection**
- ✅ **Built-in database**
- ✅ **Queue workers work**
- ✅ **No configuration issues**

## Cost:
- Free tier: $5 credit monthly
- Perfect for school apps
- You'll likely never exceed the free tier

## Let's try Railway instead! 🚀
