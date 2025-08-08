# Install Laravel Queue Worker as Windows Service
# Run this script as Administrator

param(
    [string]$ServiceName = "DisciplineTrackerWorker",
    [string]$DisplayName = "Discipline Tracker Queue Worker",
    [string]$Description = "Laravel Queue Worker for Discipline Tracker Application"
)

# Check if running as Administrator
if (-NOT ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole] "Administrator")) {
    Write-Host "This script must be run as Administrator!" -ForegroundColor Red
    exit 1
}

$projectPath = Split-Path -Parent $MyInvocation.MyCommand.Path
$phpPath = (Get-Command php -ErrorAction SilentlyContinue).Source

if (-not $phpPath) {
    Write-Host "PHP not found in PATH. Please ensure PHP is installed and in your PATH." -ForegroundColor Red
    exit 1
}

$artisanPath = Join-Path $projectPath "artisan"

if (-not (Test-Path $artisanPath)) {
    Write-Host "Laravel artisan file not found at: $artisanPath" -ForegroundColor Red
    exit 1
}

# Create the service
$binPath = "`"$phpPath`" `"$artisanPath`" queue:work --sleep=3 --tries=3 --max-time=3600"

Write-Host "Installing Windows Service..." -ForegroundColor Green
Write-Host "Service Name: $ServiceName" -ForegroundColor Yellow
Write-Host "Display Name: $DisplayName" -ForegroundColor Yellow
Write-Host "Working Directory: $projectPath" -ForegroundColor Yellow

# Check if service already exists
$existingService = Get-Service -Name $ServiceName -ErrorAction SilentlyContinue
if ($existingService) {
    Write-Host "Service '$ServiceName' already exists. Stopping and removing..." -ForegroundColor Yellow
    Stop-Service -Name $ServiceName -Force -ErrorAction SilentlyContinue
    sc.exe delete $ServiceName
}

# Create the service
$result = sc.exe create $ServiceName binPath= "$binPath" start= auto DisplayName= "$DisplayName"

if ($result -eq 0) {
    # Set the description
    sc.exe description $ServiceName "$Description"
    
    # Set the working directory
    $service = Get-WmiObject -Class Win32_Service -Filter "Name='$ServiceName'"
    $service.Change($null, $null, $null, $null, $null, $null, $null, $projectPath, $null, $null, $null)
    
    Write-Host "Service installed successfully!" -ForegroundColor Green
    Write-Host "To start the service, run: Start-Service -Name '$ServiceName'" -ForegroundColor Yellow
    Write-Host "To stop the service, run: Stop-Service -Name '$ServiceName'" -ForegroundColor Yellow
    Write-Host "To remove the service, run: sc.exe delete '$ServiceName'" -ForegroundColor Yellow
} else {
    Write-Host "Failed to install service. Error code: $result" -ForegroundColor Red
    exit 1
}
