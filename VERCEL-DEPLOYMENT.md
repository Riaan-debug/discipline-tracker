# Vercel Free Deployment Guide

## Step 1: Sign up for Vercel
1. Go to [vercel.com](https://vercel.com)
2. Click "Sign Up"
3. Choose "Continue with GitHub" (since your code is on GitHub)
4. **No credit card required!**

## Step 2: Import Your Repository
1. After signing up, click "New Project"
2. Select "Import Git Repository"
3. Choose your `discipline-tracker` repository
4. Vercel will automatically detect it's a PHP app

## Step 3: Configure Project Settings
1. **Project Name**: `discipline-tracker` (or your preferred name)
2. **Framework Preset**: Vercel will auto-detect PHP
3. **Root Directory**: Leave as `/` (default)
4. **Build Command**: Leave empty (Vercel handles this)
5. **Output Directory**: Leave empty (Vercel handles this)

## Step 4: Add Environment Variables
1. Click "Environment Variables"
2. Add these variables:
   ```
   APP_KEY=base64:your-generated-key
   DB_HOST=your-postgres-host
   DB_PORT=5432
   DB_DATABASE=your-database-name
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   MAIL_USERNAME=your-gmail-username
   MAIL_PASSWORD=your-gmail-app-password
   ```

## Step 5: Deploy
1. Click "Deploy"
2. Vercel will automatically:
   - Install dependencies
   - Build your app
   - Deploy to a live URL

## Step 6: Add PostgreSQL Database
Since Vercel doesn't provide databases, you'll need to add one:
1. **Option A**: Use [Supabase](https://supabase.com) (free tier)
2. **Option B**: Use [PlanetScale](https://planetscale.com) (free tier)
3. **Option C**: Use [Railway](https://railway.app) just for the database (free tier)

## Step 7: Configure Database Connection
1. Get your database connection details
2. Update the environment variables in Vercel dashboard
3. Redeploy your app

## Step 8: Setup Database
1. Go to your Vercel app URL
2. You'll see a setup page
3. Run these commands in Vercel's terminal:
   ```bash
   php artisan migrate
   php artisan db:seed --class=ProductionSeeder
   ```

## Vercel Free Tier Benefits:
- ✅ **Completely free** (no credit card required)
- ✅ **Unlimited deployments**
- ✅ **Custom domains**
- ✅ **SSL certificates**
- ✅ **Global CDN**
- ✅ **Automatic deployments from GitHub**

## Limitations:
- No built-in database (need external service)
- No queue workers (emails might be delayed)
- Serverless functions (not ideal for long-running tasks)

## Perfect for:
- School applications
- Low-traffic apps
- Static content
- API endpoints

## Cost: $0/month! 🎉

## Next Steps:
1. Deploy to Vercel
2. Add a free PostgreSQL database
3. Configure environment variables
4. Test your app
