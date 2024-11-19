const puppeteer = require('puppeteer');

(async () => {
    const url = process.argv[2];
    const baseDomain = new URL(url).hostname;
    const browser = await puppeteer.launch(
        {
            headless: 'new',
            args: ['--no-sandbox', '--disable-setuid-sandbox'],
            executablePath: '/var/www/carbon/chrome/chrome'
        }
    );

    const page = await browser.newPage();

    await page.goto(url, { waitUntil: 'networkidle0' });

    const resources = await page.evaluate((baseDomain) => {
        return performance.getEntriesByType('resource')
            .map(resource => ({
                name: resource.name,
                type: resource.initiatorType,
                size: resource.transferSize,
                duration: resource.duration,
            }));
    }, baseDomain);

    await browser.close();
    console.log(JSON.stringify(resources));
})();