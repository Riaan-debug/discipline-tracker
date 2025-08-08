# Heroku Free Deployment Guide

## Step 1: Sign up for Heroku
1. Go to [heroku.com](https://heroku.com)
2. Sign up for a free account
3. **No credit card required** for basic free tier

## Step 2: Install Heroku CLI (Optional)
1. Download from [devcenter.heroku.com/articles/heroku-cli](https://devcenter.heroku.com/articles/heroku-cli)
2. Or use the web interface (no CLI needed)

## Step 3: Deploy via GitHub (Easiest Method)
1. Go to [dashboard.heroku.com](https://dashboard.heroku.com)
2. Click "New" → "Create new app"
3. Choose a unique app name (e.g., `your-school-discipline`)
4. Select your region
5. Click "Create app"

## Step 4: Connect GitHub Repository
1. In your app dashboard, go to "Deploy" tab
2. Under "Deployment method", select "GitHub"
3. Connect your GitHub account
4. Select your `discipline-tracker` repository
5. Click "Connect"

## Step 5: Add PostgreSQL Database
1. In your app dashboard, go to "Resources" tab
2. Click "Find more add-ons"
3. Search for "PostgreSQL"
4. Select "Heroku Postgres" (free tier: Mini)
5. Click "Submit Order Form"

## Step 6: Configure Environment Variables
1. Go to "Settings" tab
2. Click "Reveal Config Vars"
3. Add these variables:
   ```
   MAIL_USERNAME=your-gmail-username
   MAIL_PASSWORD=your-gmail-app-password
   ```

## Step 7: Deploy Your App
1. Go back to "Deploy" tab
2. Under "Manual deploy", click "Deploy Branch"
3. Heroku will automatically:
   - Install dependencies
   - Run migrations
   - Seed the database
   - Start your app

## Step 8: Start Queue Worker
1. In your app dashboard, go to "Resources" tab
2. Click "Edit" on your dyno formation
3. Add a worker dyno with command: `php artisan queue:work --sleep=3 --tries=3 --max-time=3600`
4. Click "Confirm"

## Step 9: Test Your App
1. Visit your Heroku app URL (e.g., `https://your-school-discipline.herokuapp.com`)
2. Login with: `admin@school.edu` / `admin123`
3. Test creating incidents and positive reports
4. Verify email notifications work

## Heroku Free Tier Benefits:
- ✅ **Completely free** (no credit card required)
- ✅ **PostgreSQL database included**
- ✅ **SSL certificate included**
- ✅ **Custom domain support**
- ✅ **Automatic deployments**
- ✅ **Queue worker support**

## Limitations (Free Tier):
- App sleeps after 30 minutes of inactivity
- Limited dyno hours per month
- Database has row limits

## Perfect for:
- School applications
- Low-traffic apps
- Development/testing
- Small organizations

## Cost: $0/month! 🎉
