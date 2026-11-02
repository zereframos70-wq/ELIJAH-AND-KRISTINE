import '../../css/portfolio/styles.css';
import '../../css/portfolio/motion.css';
import '../../css/portfolio/fx.css';
import { initializePortfolioEffects } from '../portfolio/fx.js';
import { initializePortfolioNavigation } from '../portfolio/main.js';
import { initializePortfolioMotion } from '../portfolio/motion.js';

function initializePortfolio() {
    return [
        initializePortfolioNavigation(),
        initializePortfolioMotion(),
        initializePortfolioEffects(),
    ].filter((cleanup) => typeof cleanup === 'function');
}

function cleanupPortfolio() {
    cleanups.reverse().forEach((cleanup) => cleanup());
    cleanups = [];
}

let cleanups = initializePortfolio();

window.addEventListener('pagehide', cleanupPortfolio);
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        cleanups = initializePortfolio();
    }
});
