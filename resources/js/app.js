import * as anime from 'animejs';
import Alpine from 'alpinejs';

import '@fontsource-variable/asta-sans';

import './components/background.js';
import GlassEffect from './components/glassmorphism.js';
import loadingScreen from './components/loading.js';

window.anime = anime.default || anime;

// Loading Screen
Alpine.data('loadingScreen', loadingScreen);

// Disable zoom
document.addEventListener('DOMContentLoaded', function () {
    let lastTouchEnd = 0;
    document.addEventListener('touchend', function (e) {
        const now = Date.now();
        if (now - lastTouchEnd <= 300) {
            e.preventDefault();
        }
        lastTouchEnd = now;
    }, false);

    document.addEventListener('gesturestart', function (e) {
        e.preventDefault();
    });

    document.addEventListener('wheel', function (e) {
        if (e.ctrlKey || e.metaKey) {
            e.preventDefault();
        }
    }, { passive: false });

    document.addEventListener('keydown', function (e) {
        if (e.ctrlKey || e.metaKey) {
            if (e.key === '+' || e.key === '-' || e.key === '0' ||
                e.key === '=' || e.key === '_') {
                e.preventDefault();
            }
        }
    });
});

// Glassmorphism effect
let glass = null;
function initGlass() {
    if (glass) glass.destroy();
    glass = new GlassEffect({ 
        selector: '.glass'
    }).mount();
}

document.addEventListener('DOMContentLoaded', initGlass);
document.addEventListener('livewire:navigated', initGlass);

if (!window.Alpine?.started) {
    Alpine.start();
}