import '../../css/fabia-portfolio/style.css';
import { initializeFabiaPortfolio } from '../fabia-portfolio/main.js';

const portfolio = document.querySelector('.fabia-portfolio');

if (!(portfolio instanceof HTMLElement)) {
    throw new Error('The Fabia portfolio element could not be initialized.');
}

initializeFabiaPortfolio(portfolio);
