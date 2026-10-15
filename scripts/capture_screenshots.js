const puppeteer = require('puppeteer-core');
const path = require('path');
const fs = require('fs');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';

  const browser = await puppeteer.launch({
    executablePath: chromePath,
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const page = await browser.newPage();

  // 1. Capture Lighthouse Report Screenshot
  const reportPath = path.resolve(__dirname, '../lighthouse-report.report.html');
  const fileUrl = 'file:///' + reportPath.replace(/\\/g, '/');
  console.log('Loading Lighthouse report:', fileUrl);
  await page.setViewport({ width: 1280, height: 950, deviceScaleFactor: 2 });
  await page.goto(fileUrl, { waitUntil: 'networkidle0' });
  await new Promise(r => setTimeout(r, 1500));
  await page.screenshot({ path: path.resolve(__dirname, '../lighthouse-home-audit.png'), fullPage: false });
  console.log('Saved lighthouse-home-audit.png');

  // 2. Capture Homepage Desktop Screenshot
  console.log('Loading Homepage (Desktop)...');
  await page.setViewport({ width: 1440, height: 900, deviceScaleFactor: 2 });
  await page.goto('http://127.0.0.1:8000/', { waitUntil: 'networkidle0' });
  await new Promise(r => setTimeout(r, 1000));
  await page.screenshot({ path: path.resolve(__dirname, '../homepage-desktop.png'), fullPage: false });
  console.log('Saved homepage-desktop.png');

  // 3. Capture Homepage Mobile Screenshot
  console.log('Loading Homepage (Mobile)...');
  await page.setViewport({ width: 390, height: 844, isMobile: true, hasTouch: true, deviceScaleFactor: 3 });
  await page.goto('http://127.0.0.1:8000/', { waitUntil: 'networkidle0' });
  await new Promise(r => setTimeout(r, 1000));
  await page.screenshot({ path: path.resolve(__dirname, '../homepage-mobile.png'), fullPage: false });
  console.log('Saved homepage-mobile.png');

  await browser.close();
  console.log('All screenshots captured successfully!');
}

main().catch(err => {
  console.error('Error:', err);
  process.exit(1);
});
