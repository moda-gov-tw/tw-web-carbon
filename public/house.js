import lighthouse from 'lighthouse';
import * as chromeLauncher from 'chrome-launcher';

const url = process.argv[2];

const chromeFlags = ['--headless', '--disable-cache', '--disable-dev-shm-usage', '--disable-application-cache', '--disable-offline-load-stale-cache', '--disable-translate', '--no-sandbox'];
const chrome = await chromeLauncher.launch({ chromeFlags: chromeFlags, chromePath: "/var/www/carbon/chrome/chrome" });

const options = {
    output: 'json',
    onlyCategories: ['performance'],
    port: chrome.port,
};
const config = {
    extends: 'lighthouse:default',
    preset: 'desktop',
    quiet: true,
    settings: {
        formFactor: 'desktop',
        screenEmulation: {
            width: 1920,
            height: 1080,
            deviceScaleFactor: 1,
            mobile: false
        },
    },
}
const runnerResult = await lighthouse(url, options, config);

console.log(runnerResult.report);
chrome.kill();